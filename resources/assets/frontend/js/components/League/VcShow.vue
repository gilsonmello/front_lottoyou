<template>
    <load v-if="loading.component"></load>
    <div class="container" v-else-if="!loading.component && league.name">
        <br>
        <div class="row">
            <div class="col-lg-5 vcenter" style="justify-content: flex-end">
                <div :style="getStyleImage()">

                </div>
            </div>
            <div class="col-lg-5">

                <div class="row">

                    <div class="col-lg-12 col-12 col-md-12 col-sm-12">
                        <small class="league modality">
                            <strong>{{ league.modality }}</strong>
                        </small>
                    </div>            
                        
                    <div class="col-lg-12 col-12 col-md-12 col-sm-12">
                        <h1 class="league name">
                            {{ league.name }}
                        </h1>
                    </div>

                    <div class="col-lg-12 col-12 col-md-12 col-sm-12">
                        <h4 class="league small-description">
                            {{ league.small_description }}
                        </h4>
                    </div>

                    <div class="col-lg-3 col-12 col-md-12 col-sm-12 no-padding">
                        <div class="text-center">
                            <p class="league quantity-teams">
                                <strong>{{ league.quantity_teams }}</strong>
                            </p>
                            <h5 class="league participants">
                                {{ trans('strings.participants') }}
                            </h5>
                        </div>
                    </div>

                </div>


            </div>
            <!-- <div class="col-lg-6 col-6 col-md-6 col-sm-6">
                <router-link :to="{ name: 'cartoleando.index' }" class="btn btn-md btn-back btn-primary">
                    <i class="fa fa-arrow-left"></i>
                    {{ trans('strings.back') }}
                </router-link>
            </div> -->
        </div>

        <br>
        <vc-cup v-if="league.context === 'cup'" :league="league" />
        <vc-classic v-else-if="league.context === 'classic'" :league="league" :slug="league.slug" />

    </div>
    <div class="container" v-else>
        <br>
        <div class="row">
            <h1><a :href="$route.fullPath">Erro ao carregar a liga, tente novamente</a></h1>
        </div>
    </div>
</template>

<script>
import {routes} from '../../api_routes';
import {mapState, mapGetters} from 'vuex';
import VcCup from './Cup/VcCup';
import VcClassic from './Classic/VcClassic';
export default {
    methods: {
        getStyleImage () {
            let background = 'background-image: url('+this.league.bg_image_domain+'/'+this.league.bg_image+')';
            return 'width: 270px; height: 270px; '
            + 'background-repeat: no-repeat; background-position: center; '
            + 'background-size: cover; '+ background;
        },
        leagueRequest (slug) {            
            return new Promise(function(resolve, reject) {       
                let request = axios.create();
                let url = routes.leagues.show.replace('{slug}', slug);
                request.get(url)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error)
                    });
            });
        },
        init () {
            if(this.$route.params.slug != undefined) {
                //Setando novas configurações para o modal de login
                this.$store.dispatch('setLoginOptions', {
                    redirectToHome: false, 
                    redirectToHomeOnLogout: false
                });
                let slug = this.$route.params.slug;
                this.loading.component = true;
                this.leagueRequest(slug)
                    .then(response => {
                        this.loading.component = false;
                        this.league = response.data;
                    })
                    .catch(error => {
                        this.loading.component = false;
                    });
            }
        }
    },
    metaInfo () {
        return {
            title: this.trans('strings.lottoyou'),
            meta: this.meta
        }
    },
    data () {
        return {
            form: null,
            loading: {
                component: true,
                paying: false,
                leagues: false,
                adding: false,
            },
            league: {
                
            },
            indexClicked: null,
            meta: [],
            awards: [],
            step: 0,
        } 
    },
    mounted () {
        this.init();
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
        ])
    },
    components: {
        VcCup,
        VcClassic
    }
}
</script>

<style scoped>

    .league.quantity-teams {
        margin: 0; 
        line-height: 1;
    }
    
    .league.modality {
        text-transform: uppercase;
    }

    .league.participants {
        margin: 0; 
        line-height: 1;
    }

    .league.name {
        margin: 0; 
        text-transform: uppercase;
    }

    .league.small-description {
        margin: 60px 0;
    }

    .card .help-image {
        height: 167px;
        overflow: hidden;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-image: url(https://cartolafc.globo.com/dist/3.18.11/img/tempo.svg)
    }

    .card .card-header {
        padding: 0;
    }
</style>
