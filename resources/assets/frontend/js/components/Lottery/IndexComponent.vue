<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>

		<div class="row page-header">
        	<div class="col-lg-12 col-12 col-md-12 col-sm-12">
        		<h1 style="display: inline">{{ trans('strings.lotteries') }}</h1>
        		<router-link :to="{ name: 'how_to_play_easy_money' }" class="btn btn-md btn-primary pull-right">
					{{ trans('strings.how_to_play') }} {{ trans('strings.lottery') }}
				</router-link>
        	</div>
        </div>

		<div class="row" v-if="lotteries.length == 0">
			<div class="col-lg-12">
				<h3>Nenhuma loteria disponível no momento</h3>
			</div>				
		</div>

		<div class="row">
			<div class="col-lg-4 col-12 col-md-6 col-sm-6" v-for="(lottery, index) in lotteries" :key="index">				
				<card-component :index="index" :lottery="lottery"></card-component>
			</div>
		</div>


		<div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-body">
		  				<load-component></load-component>
		  			</div>
		  		</div>
		  		<div class="modal-content" v-else>
		  			
					<!-- Modal Header -->
			      	<div class="modal-header" style="border-bottom: none;" v-if="lotteries[indexClicked]">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
						<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="backgroundDemo(lotteries[indexClicked].img_loteria)+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-12 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<router-link :to="{ name: 'lotteries.play', params: {slug: lotteries[indexClicked].slug} }" style="display: block" class="btn btn-md btn-primary">
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
		        					<th>{{ trans('strings.hits') }}</th>
		        					<th>{{ trans('strings.extras') }}</th>
		        					<th>{{ trans('strings.award_for_ticket') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        				<tr v-for="(award, index) in awards" :key="index">
		        					<td>{{award.num_acertos}}</td>
		        					<td>{{award.num_acertos_extras}}</td>
		        					<td>{{getSystemCurrency.data.symbol}}{{award.value}}</td>
		        				</tr>
		        				<!-- <tr>
		        					<td>4</td>
		        					<td>$20</td>
		        				</tr>
		        				<tr>
		        					<td>3</td>
		        					<td>$2</td>
		        				</tr>
		        				<tr>
		        					<td>2</td>
		        					<td>$1</td>
		        				</tr>
		        				<tr>
		        					<td>1</td>
		        					<td>$0.5</td>
		        				</tr> -->
		        			</tbody>
		        		</table>
			      	</div>
			      	<!-- <p>{{ trans('strings.each_one') }}</p> -->
					<!-- Modal footer -->
			      	<!--<div class="modal-footer">
			      		<p>{{ trans('strings.each_one') }}</p>
		        	 	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
			      	</div>-->
				</div>
		  	</div>
		</div>

	</div>
</template>

<script>
	import {routes} from '../../api_routes';
	import LoadComponent from '../Load';
	import CardComponent from './CardComponent';
	import {mapGetters} from 'vuex';
	export default {
		metaInfo () {
			return {
				title: this.trans('strings.lotteries'),
				meta: this.metas
		    }
		},
		data: function() {
			return {
				loading: {
					component: true,
					modalJackpotTable: false
				},
				lotteries: [],
				indexClicked: null,
				metas: [],
				awards: [],
			}
		},
		methods: {
			awardsRequest(lottery) {
				let awardsRequest = axios.create();
				awardsRequest.interceptors.request.use(config => {
					return config;
				});
				let url = routes.lotteries.awards.replace('{id}', lottery.id);
				awardsRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.awards = response.data;
					}
				}).catch((error) => {
					
				});
			},
			handleJackpotTable: function(index) {
				this.indexClicked = index;
				$('.modal-jackpot-table').off('hidden.bs.modal');
				$('.modal-jackpot-table').on('hidden.bs.modal', () => {
					this.loading.modalJackpotTable = true;
					this.indexClicked = null;
				});
				$('.modal-jackpot-table').modal('toggle');
				$('.modal-jackpot-table').on('shown.bs.modal', () => {
					this.loading.modalJackpotTable = false;
				});				
			},
			backgroundDemo(background) {
				return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
			},
		},
		beforeDestroy() {
			this.$eventBus.$off('handleJackpotTable');
		},
		mounted: function() {
			//window.document.title = window.app.title +' | '+ this.trans('strings.lotteries');
			window.document.title = this.trans('strings.lotteries');

			this.$eventBus.$on('handleJackpotTable', (index) => {
				this.awardsRequest(this.lotteries[index]);
				this.handleJackpotTable(index);
			})
			
			var lotteriesRequest = axios.create();
	        lotteriesRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			lotteriesRequest.get(routes.lotteries.index, {}, {}).then(response => {
				if(response.status === 200) {
					this.lotteries = response.data;
					for(var i = 0; i < this.lotteries.length; i++) {
	            		this.metas.push({
	            			name: 'description',
	            			content: this.lotteries[i].nome,
	            		});
	            	}
					this.loading.component = false;
				}
			}).catch((error) => {
				
			});
		},
		components: {
			LoadComponent,
			CardComponent
		},
		watch: {

		},
		computed: {
			...mapGetters([
				'getSystemCurrency'
            ]),
		}
	}
</script>

<style scoped>
	.lottery-card {
		position: relative;
	    padding: 24px;
	    margin-bottom: 15px;
	    background: #ffffff;
	    color: #313534;
	    border-radius: 3px;
	    border: 1px solid rgba(83, 88, 88, 0.15)
	}

	.lottery-card:before {
		content: '';
	    position: absolute;
	    display: block;
	    width: 4px;
	    left: -1px;
	    top: -1px;
	    bottom: -1px;
		background: #2196f3;
	}
</style>