<template>
    <load v-if="loading.component == true"></load>
	<div class="container" v-else>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'fantasy_game.play', params: { slug: item.package.slug } }" class="active show">
	                    {{ trans('strings.play_on_the') }} {{ item.package.name }}
	                </router-link>
	                <!-- <router-link :to="{ name: 'cartola.results', params: { slug: item.lottery.slug } }" class="show" id="result-component">
	                    {{ trans('strings.results') }}
	               	</router-link> -->
        		</div>
        	</div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-6 col-md-6 col-sm-6">
                <h1 class="page-header" style="margin-top: 0; border: none;">{{ item.package.name }}</h1>
            </div>
            <div class="col-lg-6 col-6 col-md-6 col-sm-6">
                <router-link :to="{ name: 'fantasy_game.index' }" class="btn btn-md btn-back pull-right btn-primary">
                    {{ trans('strings.back') }}
                </router-link>
            </div>
        </div>

        <form @submit.prevent="addToCart($el)" id="packages-purchase">

            <div class="row">
                <div class="col-lg-3 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="packages-purchase-name">{{ trans('strings.team_name') }}*</label>
                        <input name="teamName" v-model="item.teamName" type="text" class="form-control" id="packages-purchase-name" aria-describedby="name" :placeholder="trans('strings.team_name')">
                    </div>
                </div>
            </div>

            
            <hr>
			<div class="row">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<button type="submit" class="btn btn-md btn-primary pull-right" v-if="!loading.paying">
						{{ trans('strings.add_to_cart') }}
					</button>
					<button @click="validate($event)" type="button" v-if="loading.paying == false && auth && auth.balance.value >= item.total" class="btn-pay-now pull-right btn btn-primary">
                        {{ trans('strings.pay_now') }}
                    </button>
					<button v-if="loading.paying" @click.prevent="" class="pull-right btn btn-md btn-primary">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
					<span class="pull-right price">
						{{ trans('strings.total_value') }} $<span class="value" v-if="item.total > 0">
							{{ totalFormated }}
						</span>
						<span class="value" v-else>0.00</span>
					</span>
				</div>
			</div>

        </form>

	</div>
    
</template>

<script>
import {routes} from '../../api_routes'
import {mapState, mapGetters} from 'vuex'
export default {
    methods: {
        setForm () {
            let vm = this;
            let time = setInterval(function() {
                vm.form = $('#packages-purchase');
                if(vm.form.length > 0) {
                    clearInterval(time);
                    vm.form.validate({
                        rules: {
                            teamName: {
                                required: true,
                            },
                        },
                        messages: {
                            teamName: {
                                required: vm.trans('strings.field_required'),
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
                        vm.submited = true;
                        var isvalid = vm.form.valid();
                        if (isvalid) {
                            e.preventDefault();
                            //vm.store();
                        }
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
        addToCart (el) {

        },
        init () {
            if(this.$route.query.hash != undefined) {
                this.showLottery();
            } else if(this.$route.params.slug != undefined) {
                this.item.package.name = this.trans('strings.loading');
                this.showRequest();
                this.setForm();
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
                    this.loading.component = false;
                })
                .catch((error) => {
                    this.loading.component = false;
                })
        }
    },
    metaInfo () {
        return {
            title: this.item.package.name + ' | '+this.trans('strings.lottoyou'),
            meta: this.meta
        }
    },
    data() {
        return {
            form: null,
            loading: {
                component: true,
                paying: false
            },
            leagues: [],
            indexClicked: null,
            meta: [],
            awards: [],
            item: {
                hash: '',
                package: {},
                total: 0.00,
                teamName: '',
                teamSlug: '',
            }
        } 
    },
    mounted () {
        this.init();
    },
    beforeRouteUpdate: function(to, from, next) {
        next();
        this.init();
    },
    computed: {
        ...mapGetters([
            'auth', 'purchase'
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
    watch: {
        'item.teamName' (newValue, oldValue) {
            this.item.teamSlug = this.convertSlug(newValue);
        }
    }
}
</script>


<style scoped>

</style>

