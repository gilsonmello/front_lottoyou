<template>
    <load v-if="loading.component == true"></load>
	<div class="container" v-else>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<!-- <router-link :to="{ name: 'cartola.play', params: { slug: item.lottery.slug } }" class="active show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ item.lottery.nome }}
	                </router-link> -->
	                <!-- <router-link :to="{ name: 'cartola.results', params: { slug: item.lottery.slug } }" class="show" id="result-component">
	                    {{ trans('strings.results') }}
	               	</router-link> -->
        		</div>
        	</div>
        </div>

        <div class="row">
            <vc-card v-for="(league, index) in leagues" :key="index" :league="league" :index="index" />
        </div>
        
        <div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-body">
		  				<load></load>
		  			</div>
		  		</div>
		  		<div class="modal-content" v-else>
		  			
					<!-- Modal Header -->
			      	<div class="modal-header" style="border-bottom: none;" v-if="leagues[indexClicked]">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
						<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="bgImage()+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-12 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<router-link :to="{ name: 'cartola.play', params: {slug: leagues[indexClicked].slug} }" style="display: block" class="btn btn-md btn-primary">
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

			      	<!-- Modal body -->
			      	<div class="modal-body" style="padding-top: 0;">
						<span v-if="awards.length == 0">
							{{ trans('strings.loading') }}...
						</span>
		        		<table class="table table-striped text-center" v-else>
		        			<thead>
		        				<tr>
		        					<th>{{ trans('strings.position') }}</th>
		        					<th>{{ trans('strings.value') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        				<tr v-for="(award, index) in awards" :key="index">
		        					<td>{{award.position}}</td>
		        					<td>${{award.value}}</td>
		        				</tr>
		        			</tbody>
		        		</table>
			      	</div>
				</div>
		  	</div>
		</div>
	</div>
</template>

<script>
import {routes} from '../../api_routes'
import {mapState, mapGetters} from 'vuex'
import VcCard from './VcCard'
export default {
    metaInfo () {
        return {
            title: this.trans('strings.lotteries'),
            meta: this.metas
        }
    },
    data() {
        return {
            loading: {
                component: true,
                modalJackpotTable: false,
            },
            leagues: [],
            indexClicked: null,
            metas: [],
            awards: [],
            modal: null,
        } 
    },
    methods: {
        setModal () {
            let time = setInterval(() => {
                let modal = $(this.$el).find('.modal-jackpot-table');
                if(modal.length > 0) {
                    this.modal = modal;
                    clearInterval(time);
                }
            }, 0);
        },
        bgImage() {
            let background = this.leagues[this.indexClicked].bg_image_domain + '/'+ this.leagues[this.indexClicked].bg_image
            return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
        }
    },
    beforeDestroy() {
        this.$eventBus.$off('handleJackpotTable');
    },
    mounted () {
        this.getLeagues()
            .then((response) => {
                this.leagues = response.data;
                this.loading.component = false;
            })
            .catch((error) => {
                this.loading.component = false;
            })
        
        this.setModal();
        this.$eventBus.$on('handleJackpotTable', (indexClicked) => {
            let slug = this.leagues[indexClicked].slug;
            this.indexClicked = indexClicked;
            this.getLeagueAwards(slug)
                .then((response) => {
                    this.awards = response.data;
                })
                .catch((error) => {
                    
                })
            this.modal.modal('toggle');            
        });
    },
    components: {
        VcCard
    }
}
</script>


<style scoped>

</style>

