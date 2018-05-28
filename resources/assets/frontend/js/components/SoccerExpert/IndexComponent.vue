<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		
		<div class="row page-header">
        	<div class="col-lg-12 col-12 col-md-12 col-sm-12">
        		<h1 style="display: inline">{{ trans('strings.soccer_expert') }}</h1>
        		<router-link :to="{ name: 'how_to_play_soccer_expert' }" class="btn btn-md btn-primary pull-right">
					{{ trans('strings.how_to_play') }} {{ trans('strings.soccer_expert') }}
				</router-link>
        	</div>
        </div>

		
		<div class="row">
			<div class="col-12 col-md-6 col-sm-6 col-lg-4" v-for="(soccer_expert, index) in soccer_experts">
				<div class="soccer-expert">
					<header class="soccer-expert-header">
						<div class="extras" v-if="soccer_expert.new == 1">
							<img :src="app.basePath+'img/new.png'" alt="new" class="game-badge">
						</div>
						<img class="header-image img-fluid" :alt="soccer_expert.nome" :src="src(soccer_expert.imagem_capa)">
						<div class="descript">
	                        <h2 class="ng-binding">{{ soccer_expert.nome }}</h2>
	                        <p class="ng-binding">{{ soccer_expert.descricao }}</p>
	                    </div>
					</header>

					<div class="soccer-expert-body">
						<div class="amount">
							{{ soccer_expert.nome }}
						</div>
						<div class="jackpot-table">
							<div class="row vcenter">
								<div class="col-lg-8 col-12 col-md-8 col-sm-12">
									<a href="#" @click.prevent="handleJackpotTable(index, $event)" class="btn description">
										<i class="fa fa-money" aria-hidden="true"></i>
										&nbsp;
										Tabela de Premios
									</a>
								</div>
								<!-- <div class="col-lg-4 col-12 col-md-4 col-sm-12">
									<a @click.prevent="handleDemo($event)" :data-id="soccer_expert.id" href="#" class="btn btn-md demo">
										Demo
									</a>
								</div> -->
							</div>
						</div>
					</div>

					<footer class="soccer-expert-footer">
						<div class="row vcenter" style="margin-top: 15px; background: none;">
							<div class="col-12 col-md-12 col-xs-12 col-sm-12 text-center">
								<router-link class="btn btn-primary btn-md play" :to="{ name: 'soccer_expert.show', params: { id: soccer_expert.id } }">
									{{ trans('strings.play_now') }}
								</router-link>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 col-sm-6 col-lg-4 no-mobile">
			</div>
			<div class="col-12 col-md-6 col-sm-6 col-lg-4">
				<router-link :to="{ name: 'create_your_league' }" class="btn create_your_league btn-md btn-warning" @click.prevent="">
					{{ trans('strings.create_your_own_league') }}
				</router-link>
			</div>
			<div class="col-12 col-md-6 col-sm-6 col-lg-4 no-mobile">
				
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
			      	<div class="modal-header" style="border-bottom: none;" v-if="soccer_experts[indexClicked]">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
						<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="backgroundDemo(soccer_experts[indexClicked].imagem_capa)+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-12 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<router-link :to="{ name: 'soccer_expert.show', params: {id: soccer_experts[indexClicked].id} }" style="display: block" class="btn btn-md btn-primary">
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
		        		<table class="table table-striped text-center">
		        			<thead>
		        				<tr>
		        					<th>{{ trans('strings.position') }}</th>
		        					<th>{{ trans('strings.percentage') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        				<tr>
		        					<td>1º</td>
		        					<td>50%</td>
		        				</tr>
		        				<tr>
		        					<td>2º</td>
		        					<td>10%</td>
		        				</tr>
		        				<tr>
		        					<td>3º</td>
		        					<td>5%</td>
		        				</tr>
		        				<tr>
		        					<td>4º ao 10º</td>
		        					<td>1% ({{ trans('strings.each_one') }})</td>
		        				</tr>
		        				<tr>
		        					<td>11º ao 20º</td>
		        					<td>0.5% ({{ trans('strings.each_one') }})</td>
		        				</tr>
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
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	export default {
		created: function() {

		},
		activated: function() {
			
		},
		methods: {
			backgroundDemo(background) {
				return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
			},
			handleJackpotTable: function(index, el) {
				this.indexClicked = index;
				$('.modal-jackpot-table').off('hidden.bs.modal');
				$('.modal-jackpot-table').on('hidden.bs.modal', () => {
					this.loading.modalJackpotTable = true;
				});
				$('.modal-jackpot-table').modal('toggle');
				this.loading.modalJackpotTable = false;
			},
		},
		data: function() {
			return {
				loading: {
					component: true,
					modalJackpotTable: false,
				},
				soccer_experts: [],
				indexClicked: null
			}
		},
		mounted: function() {
			window.document.title = this.trans('strings.soccer_expert');
			/*$(this.$el).find('.scratchpad').each(function () {
				$(this).wScratchPad({
					bg: '/img/raspadinha/0.01.png',
					fg: '/files/RaspadinhasTemas/PIRATAS/capa.png',
                    scratchMove: function (e, percent) {
                    	console.log(percent)
                    }
				});
			});*/

			const soccerExpertRequest = axios.create();
			soccerExpertRequest.interceptors.request.use(config => {
				return config;
			});
			soccerExpertRequest.get(routes.soccer_experts.index, {}).then(response => {
	            if(response.status === 200) {
	            	this.loading.component = false
	            	this.soccer_experts = response.data
				}
	        }).catch((error) => {
	        	if(error.response.data.msg) {
					toastr.error(error.response.data.msg);
	        	}
	        });		
		},
		computed: {

		},
		watch: {

		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	.btn-warning {
		background-color: #ffe066; 
		border: none; 
		width: 100%;
		font-size: 20px; 
		font-weight: bold;
	}
	
	.btn-warning:hover {
	    color: #212529;
	    background-color: #e0a800;
	    border-color: #d39e00;
	}

	.remaining-tickets {
	    background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;
	    border-color: #baa359;
	    color: #f2d472;
	    text-align: left;
	    line-height: 48px;
	    padding: 0 15px;
	    width: 100%;
	}

	.info-text {
		color: #fff;
    	font-size: 15px;
	    margin: 0;
	    padding: 0 8px;
	    line-height: 22px;
	    text-shadow: 0 2px 3px rgba(0,0,0,.8);
	}

	.ticket-number {
	    color: #fff;
	    font-family: courier;
	}

	.btn-result {
		border-color: #baa359;
	    line-height: 36px;
	    font-weight: bold;
	    text-align: center;
        color: #f2d472;
        border-color: #baa359;
	    background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;
	    font-size: 21px;
	    width: 100%;
	}

	.btn-game:not([disabled]):not(.disabled):active {
		background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #c3dc41 0px, #97bd00 100%) repeat scroll 0 0 !important;
	}

	.btn-game {
		background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #c3dc41 0px, #97bd00 100%) repeat scroll 0 0;
	    border: 0 none;
	    width: 100%;
	    border-radius: 5px;
	    box-shadow: 0 -4px 0 -2px #708f00 inset;
	    box-sizing: border-box;
	    color: #fff;
	    cursor: pointer;
	    font-family: "kievit",arial,sans-serif;
	    font-size: 24px;
	    font-weight: 700;
	    line-height: 48px;
	    padding: 0 15px;
	    text-align: center;
	    text-decoration: none;
	    text-shadow: 1px 1px 2px #586e00;
	    vertical-align: bottom;
	}
	
	.soccer-expert {
		background: #efefef;
	    border-radius: 5px;
	    padding: 15px;
	    margin-bottom: 30px;
	    position: relative;
	}
	
	.extras img {
		position: absolute;
		top: -15px;
	    left: -5px;
	    z-index: 4;
	}

	input[type=radio] {
		margin: 0;
    	margin-right: 10px;
	}

	.soccer-expert-footer label {
		padding: 13px 10px;
	    margin: 0;
	    width: 100%;
	    cursor: pointer;
	}

	.soccer-expert-footer form .row {
		color: #666;
	    background: rgba(255,255,255,.3);
	    border-bottom: 1px solid #eee;
	    font-size: 15px;
	    cursor: pointer;
	}

	.soccer-expert-body .amount {
		background: linear-gradient(87.71deg, #1DB2E0 0%, #6AD1ED 50.77%, #1DB2E0 100%);
	    height: 46px;
	    color: #FFFFFF;
	    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	    font-size: 15px;
	    font-weight: bold;
	    line-height: 46px;
	    text-align: center;
	    box-shadow: 0px -6px 5px -3px rgba(0,0,0,0.3);
	    position: relative;
	}

	.soccer-expert-body .jackpot-table {
		background: #0f546d;
	    color: #fff;
	    padding: 10px;
	    font-size: 13px;
	    font-weight: 700;
	}
	.soccer-expert-body .jackpot-table a.demo {
		display: block;
	    border: 2px solid rgba(255,255,255,.2);
	    border-radius: 5px;
	    color: #fff;
	    font-weight: 700;
	    -webkit-transition: border .3s ease-in-out;
	    transition: border .3s ease-in-out;
	    font-size: 13px;
    	margin: 10px 0 10px 0;
	}

	.soccer-expert-body .jackpot-table a.description {
		cursor: pointer;
    	color: #fff;
    	margin: 10px 0 10px 0;
	}
	.soccer-expert-body .jackpot-table a.demo:hover {
		border: 2px solid #fff;
	}

	.soccer-expert-body .btn {
		padding: 0
	}

	.soccer-expert-header {
		position: relative;
	}

	.soccer-expert-header .header-image { 
		width: 100%;
	}

	.soccer-expert-header:hover .descript {
	    opacity: 1;
	}

	.soccer-expert-header .descript {
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    background-color: rgba(239,239,239,.95);
	    z-index: 2;
	    opacity: 0;
	    -webkit-transition: opacity .3s ease-in-out;
	    transition: opacity .3s ease-in-out;
	    padding: 20px;
	    text-align: center;
	    color: #666;
	}
	
</style>