<template>
    <load v-if="loading.component == true"></load>
	<div class="container" v-else>
        
        <div class="row page-header">
        	<div class="col-lg-12 col-12 col-md-12 col-sm-12">
        		<h1 style="display: inline">{{ trans('strings.cartoleando') }}</h1>
        		<router-link :to="{ name: 'how_to_play_easy_money' }" class="btn btn-md btn-primary pull-right">
					{{ trans('strings.how_to_play') }} {{ trans('strings.cartoleando') }}
				</router-link>
        	</div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-4 col-12" v-for="(leaguePackage, index) in leaguePackages" :key="index" :index="index">
                <div class="card">
                    <img class="card-img-top" :src="leaguePackage.bg_image_domain+'/'+leaguePackage.bg_image" :alt="leaguePackage.description">
                    <div class="card-body">
                        <h5 class="card-title">{{ leaguePackage.name }}</h5>
                        <p class="card-text">{{ leaguePackage.description }}</p>
                        <div class="jackpot-table">
                            <div class="row vcenter">
                                <div class="col-lg-8 col-12 col-md-8 col-sm-12">
                                    <a href="#" @click.prevent="handleJackpotTable(index)" class="btn description">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        &nbsp;
                                        Tabela de Premios
                                    </a>
                                </div>
                            </div>
                        </div>
                        <router-link :to="{ name: 'cartoleando.play', params: { slug: leaguePackage.slug } }" class="btn btn-md btn-primary">
                            {{ trans('strings.play_now') }}
                        </router-link>
                    </div>
                </div>
                <br>
            </div>
            <!-- <vc-card v-for="(leaguePackage, index) in leaguePackages" :key="index" :leaguePackage="leaguePackage" :index="index" /> -->
        </div>

        <portal to="cartoleando-index-modal">
            <div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" v-if="loading.modalJackpotTable == true">
                        <div class="modal-body">
                            <load></load>
                        </div>
                    </div>
                    <div class="modal-content" v-else>
                        
                        
                        <div class="modal-header" style="border-bottom: none;" v-if="leaguePackages[indexClicked]">
                            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="bgImage()+' padding-right: 0; padding-left: 0; min-height: 106px;'">
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-12 items-center display-flex container-actions">
                                        <router-link :to="{ name: 'cartoleando.play', params: {slug: leaguePackages[indexClicked].slug} }" style="display: block" class="btn btn-lg btn-primary">
                                            {{ trans('strings.play_now') }}
                                        </router-link>
                                    </div>
                                </div>
                            </div>		        	
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" style="padding-top: 0;">
                            <span v-if="leagues.length == 0">
                                {{ trans('strings.loading') }}...
                            </span>
                            <div id="accordion" v-else>
                                <div class="card" v-for="(league, index) in leagues" :key="index">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" :data-target="'#league_'+league.id" aria-expanded="true" :aria-controls="'league_'+league.id">
                                                {{ league.name }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div :id="'league_'+league.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            {{ league.description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </portal>
        
        <!-- <div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-body">
		  				<load></load>
		  			</div>
		  		</div>
		  		<div class="modal-content" v-else>
		  			
					
			      	<div class="modal-header" style="border-bottom: none;" v-if="leaguePackages[indexClicked]">
			        	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="bgImage()+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-12 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<router-link :to="{ name: 'cartoleando.play', params: {slug: leaguePackages[indexClicked].slug} }" style="display: block" class="btn btn-md btn-primary">
						        					{{ trans('strings.play_now') }}
						        				</router-link>
						        			</div>
					        			</div>
					        			<div class="row">
						        			<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				
						        			</div>
						        		</div>
					        		</div>					        		
					        	</div>
		        			</div>
		        		</div>		        	
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<div class="modal-body" style="padding-top: 0;">
						<span v-if="leagues.length == 0">
							{{ trans('strings.loading') }}...
						</span>
                        <div id="accordion" v-else>
                            <div class="card" v-for="(league, index) in leagues" :key="index">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" :data-target="'#league_'+league.id" aria-expanded="true" :aria-controls="'league_'+league.id">
                                            {{ league.name }}
                                        </button>
                                    </h5>
                                </div>

                                <div :id="'league_'+league.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        {{ league.description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
	</div>
</template>

<script>
import {routes} from '../../api_routes'
import {mapState, mapGetters} from 'vuex'
import VcCard from './VcCard'
export default {
    metaInfo () {
        return {
            title: this.trans('strings.cartoleando'),
            meta: this.metas
        }
    },
    data () {
        return {
            loading: {
                component: true,
                modalJackpotTable: false,
            },
            leagues: [],
            leaguePackages: [],
            indexClicked: null,
            metas: [],
            awards: [],
            modal: null,
        } 
    },
    methods: {
        handleJackpotTable(index) {
            let slug = this.leaguePackages[index].slug;
            this.indexClicked = index;
            this.getLeaguesOfPackageBySlug(slug)
                .then((response) => {
                    this.leagues = response.data;
                })
                .catch((error) => {
                    
                }) 
            this.modal.modal('toggle');
        },
        setModal () {
            let time = setInterval(() => {
                let modal = $('.modal-jackpot-table');                    
                if(modal.length > 0) {
                    this.modal = modal;
                    clearInterval(time);
                }
            }, 0);
        },
        bgImage () {
            let background = this.leaguePackages[this.indexClicked].bg_image_domain + '/'+ this.leaguePackages[this.indexClicked].bg_image
            return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
        },
    },
    beforeDestroy () {
        this.$eventBus.$off('handleJackpotTable');
    },
    mounted () {
             
        //Setando o modal para a variável modal
        this.setModal();

        //Ajax para buscar todos pacotes que contém ligas
        this.getLeaguePackages()
            .then((response) => {
                this.leaguePackages = response.data;
                this.loading.component = false;
                this.leaguePackages.forEach(element => {
                    this.metas.push({
                        name: 'description',
                        content: element.name,
                    });
                });
            })
            .catch((error) => {
                this.loading.component = false;
            })
    },
    components: {
        VcCard
    }
}
</script>


<style scoped>
    .card-img-top {
        width: initial;
        max-width: 100%;
    }
</style>

