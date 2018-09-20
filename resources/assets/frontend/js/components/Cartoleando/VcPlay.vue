<template>
    <load v-if="loading.component == true"></load>
	<div class="container" v-else>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'cartoleando.play', params: { slug: item.package.slug } }" class="active show">
	                    {{ trans('strings.play_on_the') }} {{ item.package.name }}
	                </router-link>
	                <router-link :to="{ name: 'cartoleando.leagues', params: { slug: item.package.slug } }" class="show" id="result-component">
	                    {{ trans('strings.leagues') }}
	               	</router-link>
        		</div>
        	</div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-12 col-md-12 col-sm-12">
                <h1 class="page-header" style="border: none; margin: 0">
                    {{ item.package.name }}<br>
                    <span style="font-size: 20px;" v-if="auth == null || auth.cartoleando_team == null">
                        Por favor, preencha o formulário para participar do cartoleando
                    </span>
                </h1>
            </div>
            <!-- <div class="col-lg-6 col-6 col-md-6 col-sm-6">
                <router-link :to="{ name: 'cartoleando.index' }" class="btn btn-md btn-back btn-primary">
                    <i class="fa fa-arrow-left"></i>
                    {{ trans('strings.back') }}
                </router-link>
            </div> -->
        </div>

        <!-- Carregamento -->
        <div class="row">
            <div class="col-12">
                <h5></h5>
            </div>
        </div>
        
        <!-- Se o usuário possui time -->
        <form @submit.prevent="" id="packages-purchase" v-if="auth && auth.cartoleando_team && auth.cartoleando_team.time">
            <div class="row no-margin">
                <div class="col-lg-8 no-padding-left">
                    <div class="row">
                        <div class="col-lg-12 vcenter-end">
                            <div class="cartoleando-show-team-header">
                                <img style="width: 200px; height: 200px;" :src="auth.cartoleando_team.time.url_camisa_png" />
                                <img :src="auth.cartoleando_team.time.url_escudo_png" class="shield" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 vcenter-end">
                            <h4>
                                {{ auth.cartoleando_team.time.nome }}
                                <br>
                                <small>
                                    {{ auth.cartoleando_team.time.nome_cartola }}
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 no-padding-right">
                    <div class="card">
                        <div class="card-header">
                            <span class="price">
                                {{ trans('strings.total_value') }} {{getSystemCurrency.data.symbol}}<span class="value" v-if="item.total > 0">{{ totalFormated }}</span>
                                <span class="value" v-else>{{getSystemCurrency.data.symbol}}0.00</span>
                            </span>
                        </div>

                        <div class="card-body">
                            <button @click="addToCart($el)" v-if="!loading.adding" class="btn btn-xl btn-primary" type="button" style="width: 40%;">
                                {{ trans('strings.to_confirm') }}
                            </button>
                            <button @click.prevent="" v-else class="btn-load btn btn-md btn-primary">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Se não aparece o formulário normal -->
        <form id="packages-purchase" v-else>
            <!-- Se está fazendo login -->
            <load v-if="loading.signingIn" />
            <!-- Se não aparece o formulário -->
            <div class="row no-margin" v-else>
                <div class="col-lg-8 no-padding-left">
                    <div class="row">
                        <div class="col-lg-12 col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="packages-purchase-team-name">{{ trans('strings.team_name') }}*</label>
                                <input name="name" v-model="item.name" type="text" class="form-control" id="packages-purchase-team-name" aria-describedby="name" :placeholder="trans('strings.team_name')">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="packages-purchase-cartoleiro">{{ trans('strings.cartoleiro_name') }}*</label>
                                <input name="cartoleiro" v-model="item.cartoleiro" type="text" class="form-control" id="packages-purchase-cartoleiro" aria-describedby="cartoleiro" :placeholder="trans('strings.cartoleiro_name')">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="packages-purchase-email">{{ trans('strings.email') }} cadastrado no site do cartola*</label>
                                <input name="email" v-model="item.email" type="email" class="form-control" id="packages-purchase-email" aria-describedby="email" :placeholder="trans('strings.email')">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 no-padding-right">
                    <div class="card">
                        <div class="card-header">
                            <span class="price">
                                {{ trans('strings.total_value') }} {{getSystemCurrency.data.symbol}}<span class="value" v-if="item.total > 0">{{ totalFormated }}</span>
                                <span class="value" v-else>{{getSystemCurrency.data.symbol}}0.00</span>
                            </span>
                        </div>

                        <div class="card-body">
                            <button type="submit" @click="submitForm($event)" class="btn btn-xl btn-primary">
                                {{ trans('strings.to_confirm') }}
                            </button>

                            <button @click="validatePurchase($event)" type="button" v-if="loading.paying == false && auth && auth.balance.value >= item.total && auth.cartoleando_team" class="btn-pay-now pull-right btn btn-primary">
                                {{ trans('strings.pay_now') }}
                            </button>
                            <button v-if="loading.paying" @click.prevent="" class="pull-right btn btn-md btn-primary">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-md btn-primary pull-right" v-if="!loading.paying">
                        {{ trans('strings.add_to_cart') }}
                    </button>
                    <button @click="validate($event)" type="button" v-if="loading.paying == false && auth && auth.balance.value >= item.total" class="btn-pay-now pull-right btn btn-primary">
                        {{ trans('strings.pay_now') }}
                    </button>
                    <button v-if="loading.paying" @click.prevent="" class="pull-right btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>-->
                </div>
            </div>
        </form>
         
        <hr>
        <div class="row">
            <div class="col-12">
                <h4>{{ trans('strings.league') }}(s)</h4>
                <load v-if="loading.leagues" />
                <div id="accordion" v-else>
                    <div class="card" v-for="(league, index) in item.package.leagues" :key="index">
                        <div class="card-header" data-toggle="collapse" :data-target="'#league_'+league.id">
                            <!-- <h6 data-toggle="collapse" :data-target="'#league_'+league.id" aria-expanded="true" :aria-controls="'league_'+league.id">
                                {{ league.name }}
                            </h6> -->

                            <div class="row vcenter">
                                <div class="col-lg-2">
                                    <img class="img-fluid" :src="league.bg_image_domain+'/'+league.bg_image" :alt="league.name"> 
                                </div>

                                <div class="col-lg-10">
                                    <h3 class="">{{league.name}}</h3>
                                    <span>
                                        {{ trans('strings.league') }} {{ league.modality }} 
                                        <span v-if="league[league.context].max_players > league.quantity_teams">
                                            - {{ league[league.context].max_players - league.quantity_teams }} Vagas restantes
                                        </span>
                                    </span>
                                    <br>
                                    <h5>{{ league.small_description }}</h5>
                                </div>
                            </div>
                        </div>

                        <div :id="'league_'+league.id" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <h5>{{ league.small_description }}</h5>
                                <p>{{ league.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-show-team" data-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" v-if="item.team">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h2>Por favor, confirme seu time</h2>
                    	<button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 vcenter-end">
                                <div class="cartoleando-show-team-header">
                                    <img style="width: 200px; height: 200px;" :src="item.team.time.url_camisa_png" />
                                    <img :src="item.team.time.url_escudo_png" class="shield" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 vcenter-end">
                                <h4>
                                    {{ item.team.time.nome }}
                                    <br>
                                    <small>
                                        {{ item.team.time.nome_cartola }}
                                    </small>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" style="justify-content: center">
                        <button v-if="loading.adding" @click.prevent="" class="pull-right btn btn-md btn-primary">
                            <i class="fa fa-refresh fa-spin"></i>
                        </button>
                    	<button v-else-if="auth" @click="addToCart($el)" class="btn btn-xl btn-primary" type="button" style="width: 40%;">
                            {{ trans('strings.to_confirm') }}
                        </button>
                        <button v-else class="btn btn-primary btn-md" style="width: 40%;" type="button" @click.prevent="showModalLogin($event)">		
                            {{ trans('strings.login') }}
                        </button>
                    </div>
                </div>

                <div class="modal-content" v-else>
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom: none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <load />
                    </div>
                </div>
            </div>
        </div>


    </div>
    
</template>

<script>
import {routes} from '../../api_routes'
import {mapState, mapGetters} from 'vuex'
export default {
    methods: {
        submitForm () {
            let vm = this;
            let isvalid = vm.form.valid();
            if (isvalid) {
                vm.modal.off('shown.bs.modal');
                //Abrindo o modal
                vm.modal.on('shown.bs.modal', (event) => {
                    vm.showTeamRequest();
                }).modal({
                    show: true,
                    backdrop: 'static'
                });  
                vm.modal.modal('toggle');
            }
        },
        validatePurchase () {
            let vm = this;
            let isvalid = vm.form.valid();
            if (isvalid) {
                console.log('ljakl')
            }
        },
        showTeamRequest () {
            let showTeamRequest = axios.create();
            showTeamRequest.interceptors.request.use(config => {	
                this.item.team = null;				
                return config;
            });

            let url = routes.cartola.find_team_by_slug;
            showTeamRequest.post(url, {
                slug: this.item.slug
            }).then(response => {
                this.item.team = response.data;
                if(response.data.time.nome_cartola !== this.item.cartoleiro) {
                    
                    this.modal.modal('hide');

                    swal({
                        title: 'Nome do cartoleiro inválido',
                        showCloseButton: true,
                        imageUrl: '/imgs/logo.png',
                        imageHeight: 50,
                        imageAlt: 'Logo lottoyou',
                        showConfirmButton: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: this.trans('strings.yes'),
                        cancelButtonText: this.trans('strings.cancel')
                    }).then((result) => {
                       
                    });

                } else {
                    this.item.team = response.data;
                }
            }).catch(error => {
                toastr.options = {
                    closeButton: true,
                    positionClass: "toast-top-center",
                };
                toastr.warning(
                    error.response.data.message
                );                
                this.modal.modal('hide');                
            });
        },
        setModalTeam () {
            let vm = this;
            let time = setInterval(function() {
                vm.modal = $('.modal-show-team');
                if(vm.modal.length > 0) {
                    clearInterval(time);
                }
            });
        },
        setForm () {
            let vm = this;
            let time = setInterval(function() {
                vm.form = $('#packages-purchase');
                if(vm.form.length > 0) {
                    clearInterval(time);
                    vm.form.validate({
                        rules: {
                            name: {
                                required: true,
                            },
                            cartoleiro: {
                                required: true,
                            },
                            email: {
                                required: true,
                                email: true,
                            },
                        },
                        messages: {
                            name: {
                                required: vm.trans('strings.field_required'),
                            },
                            cartoleiro: {
                                required: vm.trans('strings.field_required'),
                            },
                            email: {
                                required: vm.trans('strings.field_required'),
                                email: vm.trans('validation.user.create.email.email'),
                            },
                        },
                        highlight: function (input) {
                            $(input).addClass('error');
                            $(input).parents('.form-control').addClass('error');
                        },
                        unhighlight: function (input) {
                            $(input).removeClass('error');
                            $(input).parents('.form-control').removeClass('error');
                        },
                        errorPlacement: function (error, element) {
                            $(element).parents('.input-group').append(error);
                            $(element).parents('.form-group').append(error);
                        }
                    });
                    vm.form.on('submit', function(e) {
                        e.preventDefault();
                    });
                }
            });
        },
        completePurchase (event) {
            let completePurchaseRequest = axios.create();

            completePurchaseRequest.interceptors.request.use(config => {					
                return config;
            });
        },
        validate () {

        },
        addTeamRequest () {
            let addTeamRequest = axios.create();
            addTeamRequest.interceptors.request.use(config => {
                return config;
            });

            addTeamRequest.post(routes.users.add_team, {
                name: this.item.name,
                email: this.item.email,
                cartoleiro: this.item.cartoleiro,
                slug: this.item.slug,
            }, {
                headers: {
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + this.auth.access_token
                }
            }).then(response => {
                if(response.status === 200) {
                    this.$store.dispatch('setTeamUser', response.data);
                }
            }).catch((error) => {
                
            });
        },
        addToCart (el) {
            if(this.auth != null && this.auth.cartoleando_team == null) {
                this.addTeamRequest();
            }
            let vm = this;
            let isvalid = vm.form.valid();
            if (isvalid) {
                let addCartoleandoRequest = axios.create();
                addCartoleandoRequest.interceptors.request.use(config => {
                    this.loading.adding = true;
                    return config;
                });

                addCartoleandoRequest.post(routes.carts.add_cartoleandos, {
                    purchase: this.item,
                    hash: this.item.hash,
                    auth: this.auth,
                }).then(response => {
                    if(response.status === 200) {
                        this.loading.adding = false;    
                        this.$store.dispatch('setItemCartoleando', this.item);
                        this.$router.push({
                            name: 'cart.index'
                        });
                    }
                }).catch((error) => {
                    this.loading.adding = false;
                    toastr.error('Erro ao adicionar item', 'Por favor tente novamente');
                });                 
            }            
        },
        init () {
            if(this.$route.query.hash != undefined) {
                this.showLottery();
            } else if(this.$route.params.slug != undefined) {
                //Setando novas configurações para o modal de login
                this.$store.dispatch('setLoginOptions', {
                    redirectToHome: false, 
                    redirectToHomeOnLogout: false
                });
                this.item.package.name = this.trans('strings.loading');
                this.showRequest();
                this.setForm();
                this.setModalTeam();
                if(this.auth != null 
                    && this.auth.cartoleando_team != null
                    && this.auth.cartoleando_team.time != null
                ) {
                    this.item.cartoleiro = this.auth.cartoleando_team.time.nome_cartola;
                    this.item.name = this.auth.cartoleando_team.time.nome;
                    this.item.slug = this.auth.cartoleando_team.time.slug;
                }
            }
            //window.document.title = this.trans('strings.soccer_expert');
        },
        showRequest () {
            this.item.hash = this.makeid();
            let slug = this.$route.params.slug;
            
            this.getLeaguePackagesBySlug(slug)
                .then((response) => {
                    this.item.package = response.data;
                    this.item.total = parseFloat(response.data.value);
                    this.meta.push({
                        name: 'description',
                        content: this.item.package.name,
                    });                    
                })
                .catch((error) => {
                    
                });

            this.loading.leagues = true;
            this.getLeaguesOfPackageBySlug(slug)
                .then((response) => {
                    this.$set(this.item.package, 'leagues', response.data);
                    this.loading.component = false;
                    this.loading.leagues = false;
                })
                .catch((error) => {
                    this.loading.component = false;
                    this.loading.leagues = false;
                });
        }
    },
    metaInfo () {
        return {
            title: this.item.package.name + ' | '+this.trans('strings.lottoyou'),
            meta: this.meta
        }
    },
    data () {
        return {
            form: null,
            loading: {
                signingIn: false,
                component: true,
                paying: false,
                leagues: false,
                adding: false,
            },
            leagues: [],
            indexClicked: null,
            meta: [],
            awards: [],
            step: 0,
            item: {
                hash: '',
                package: {},
                total: 0.00,
                name: '',
                slug: '',
                email: '',
                cartoleiro: '',
                team: null,
            }
        } 
    },
    mounted () {
        this.init();
        this.$eventBus.$on('signingIn', (value) => {
            this.loading.signingIn = value;
        });
    },
    beforeRouteUpdate (to, from, next) {
        next();
        this.init();
    },
    computed: {
        ...mapGetters([
            'auth', 
            'purchase',
            'loginOptions',
            'getSystemCurrency'
        ]),
        totalFormated: {
            // getter
            get: function () {
                return this.item.total.format(2, true);
            },
            // setter
            set: function (newValue) {
                
            }
        }
    },
    beforeDestroy () {
        this.$eventBus.$off('signingIn');
        this.$store.dispatch('setLoginOptions', {
            redirectToHome: true, 
            redirectToHomeOnLogout: true
        });
    },
    watch: {
        'item.name' (newValue, oldValue) {
            this.item.slug = this.convertSlug(newValue);
        }
    }
}
</script>


<style scoped>
    .card {
        margin-bottom: 10px;
    }

    .cartoleando-show-team-header {
        position: relative;
    }

    .cartoleando-show-team-header .shield {
        position: absolute;
        right: 5%;
        width: 70px;
        height: 70px;
        top: 60%;
    }
</style>

