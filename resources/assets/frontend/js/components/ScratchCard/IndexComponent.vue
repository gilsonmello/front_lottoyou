<template>
	<load-component v-if="loading == true"></load-component>
	<div class="container" v-else>
		<h1 class="page-header">{{ trans('strings.scratch_cards') }}</h1>
		<div class="row">
			<div class="col-12 col-md-4 col-sm-4 col-lg-4" v-for="scratch_card_theme in scratch_card_themes">
				<div class="scratch-card">
					<header class="scratch-card-header">
						<div class="extras">
							<img src="https://www.grandesloterias.com/images/badges/new-badge_pt.png" alt="Novo" class="game-badge">
						</div>
						<img class="header-image img-fluid" alt="Halloween" :src="'/'+scratch_card_theme.img_background_url">
						<div class="descript">
                            <h2 class="ng-binding">Halloween</h2>
                            <p class="ng-binding">Não há nada mais gostoso do que doce de Halloween ou ganhar prêmios em dinheiro!</p>
                        </div>
					</header>
					<div class="scratch-card-body">
						<div class="amount">
							{{ scratch_card_theme.texto_index }}
						</div>
						<div class="jackpot-table">
							<div class="row vcenter">
								<div class="col-lg-8">
									<a :data-id="scratch_card_theme.id" href="#" @click.prevent="handleJackpotTable($event)" class="btn description">
										<i class="fa fa-money" aria-hidden="true"></i>
										&nbsp;
										Tabela de Premios
									</a>
								</div>
								<div class="col-lg-4">
									<a @click.prevent="demo" href="#" class="btn btn-md demo">
										Demo
									</a>
								</div>
							</div>
						</div>
					</div>

					<footer class="scratch-card-footer">
						<form>
							<div class="row vcenter">
								<div class="col-lg-9">
									<label class="">
										<input type="radio" name="game_1_option">
										<span>1 Jogo</span>
									</label>
								</div>
								<div class="col-lg-3">
									<span>$ 1.50</span>
								</div>
							</div>
							<div class="row vcenter">
								<div class="col-lg-9">
									<label>
										<input type="radio" name="game_1_option">
										<span>2 Jogo</span>
									</label>
								</div>
								<div class="col-lg-3">
									<span>$ 1.50</span>
								</div>
							</div>
							<div class="row vcenter">
								<div class="col-12 col-md-12 col-xs-12 col-sm-12 text-center">
									<button type="submit" class="btn btn-md btn-success">
										{{ trans('strings.play_now') }}
									</button>
								</div>
							</div>
						</form>
					</footer>
				</div>
			</div>
			
		</div>
		<div class="modal fade modal-jackpot-table">
		  	<div class="modal-dialog modal-lg">
			    <div class="modal-content">
					<!-- Modal Header -->
			      	<div class="modal-header" style="border-bottom: none;">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
			        	<div class="container-actions vcenter no-padding">
				        	<div class="col-lg-4" style="padding-left: 0;">
				        		<img class="img-fluid" src="https://www.grandesloterias.com/images/gluck/scratchcards/halloween_en.jpg">
				        	</div>
				        	<div class="col-lg-7">
				        		<div class="row">
				        			<div class="col-lg-6">
				        				<a class="btn btn-md btn-success" href="#" @click.prevent="">
				        					{{ trans('strings.play_now') }}
				        				</a>
				        			</div>			        			
				        			<div class="col-lg-6">
				        				<a class="btn btn-md btn-demo" href="#" @click.prevent="demo">
					        				Demo
					        			</a>
				        			</div>
				        		</div>
				        		<div class="row">
				        			<div class="col-lg-12">
				        				<p class="text-center number-of-cards">
				        					{{ trans('strings.number_of_cards') }} 15000000
				        				</p>
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
		        					<th>{{ trans('strings.level') }}</th>
		        					<th>{{ trans('strings.jackpot_available') }}</th>
		        					<th>{{ trans('strings.amount') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        				<tr v-if="scratch_card_jackpot_available != null" v-for="(jackpot_available, key) in scratch_card_jackpot_available.scratch_card_winning">
		        					<td>{{ key + 1 }}</td>
		        					<td>{{ jackpot_available.quantity }}</td>
		        					<td>$ {{ jackpot_available.jackpot }}</td>
		        				</tr>
		        			</tbody>
		        		</table>
			      	</div>
					<!-- Modal footer -->
			      	<div class="modal-footer">
			        	<!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
			      	</div>
				</div>
		  	</div>
		</div>

		<div class="modal fade modal-demo">
		  	<div class="modal-dialog modal-lg">
			    <div class="modal-content">
					<!-- Modal Header -->
			      	<div class="modal-header">
			        	<h4 class="modal-title">Demo de Raspadinhas sem prêmios</h4>    	
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<!-- Modal body -->
			      	<div class="modal-body">
			      		<div class="row">
			      			<div class="col-lg-12 col-12 col-md-12 col-sm-12" style="background-image: url(https://cdn.poweredbygluck.com/ral-puk-100k-client/assets/themes/100K/img/_default/bg.jpg); background-size: 100% 100%;">
			      				<div class="row" style="padding: 20px;">
			      					<div class="col-lg-6 col-6 col-md-6 col-sm-6">
			      						
			      					</div>
			      					<div class="col-lg-6 col-6 col-md-6 col-sm-6">
			      						<div class="row">
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
			      								<div class="scratchpad">
			      									
			      								</div>
			      							</div>
			      						</div>
			      					</div>
			      				</div>
			      				<div class="row">
			      					<div class="col-lg-6">
			      						Raspadinhas restantes: 
			      					</div>
			      					<div class="col-lg-6">
			      						Jogar raspadinha
			      					</div>
			      				</div>
			      			</div>
			      		</div>
		        	</div>
					<!-- Modal footer -->
			      	<!-- <div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>-->
				</div>
		  	</div>
		</div>

	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import ModalFormComponent from '../ModalFormComponent'
	import LoadComponent from '../Load'
	export default {
		props: [],
		created: function() {
			
		},
		activated: function() {
			
		},
		methods: {
			demo: function() {
				$('.modal-demo').modal('toggle');
				$('.scratchpad').wScratchPad('destroy');

				$('.scratchpad').each(function () {
					$(this).wScratchPad({
                        bg: 'img/raspadinha/0.05.png',
                        fg: 'files/RaspadinhasTemas/PIRATAS/capa.png',
                        'cursor': '../img/raspadinha/coin.png") 5 5, coin',
                        scratchMove: function (e, percent) {
                            if (percent > 39) {}
                        }
                    });
				});
				$('.scratchpad').wScratchPad('enable', true);
			},
			submit: function (){

			},
			handleJackpotTable: function(el) {
				var id = el.target.getAttribute('data-id');
				axios.get(routes.scratch_card_themes.jackpot_available.replace('{id}', id), {}).then(response => {
		            if(response.status === 200){
		            	this.scratch_card_jackpot_available = response.data
		            }
		        }).catch((error) => {
		            
		        })
				$('.modal-jackpot-table').modal('toggle');
			}
		},
		data: function() {
			return {
				scratch_card_themes: [],
				scratch_card_jackpot_available: {},
				method: "GET",
				action: null,
				loading: true
			}
		},
		mounted: function() {
			console.log(this.$parent)
			axios.get(routes.scratch_card_themes.index, {}).then(response => {
	            if(response.status === 200){
	            	this.scratch_card_themes = response.data
	            	this.loading = false
	            }
	        }).catch((error) => {
	            
	        })
		},
		computed: {

		},
		watch: {

		},
		components: {
			ModalFormComponent,
			LoadComponent
		}
	}
</script>

<style scoped>
	
	.scratch-card {
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

	.scratch-card-footer label {
		padding: 13px 10px;
	    margin: 0;
	    width: 100%;
	    cursor: pointer;
	}

	.scratch-card-footer form .row {
		color: #666;
	    background: rgba(255,255,255,.3);
	    border-bottom: 1px solid #eee;
	    font-size: 15px;
	    cursor: pointer;
	}

	.scratch-card-body .amount {
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

	.scratch-card-body .jackpot-table {
		background: #0f546d;
	    color: #fff;
	    padding: 10px;
	    font-size: 13px;
	    font-weight: 700;
	}
	.scratch-card-body .jackpot-table a.demo {
		display: block;
	    border: 2px solid rgba(255,255,255,.2);
	    border-radius: 5px;
	    color: #fff;
	    padding: 1px 15px 2px;
	    font-weight: 700;
	    -webkit-transition: border .3s ease-in-out;
	    transition: border .3s ease-in-out;
	    font-size: 13px;
	}

	.scratch-card-body .jackpot-table a.description {
		cursor: pointer;
    	color: #fff;
	}
	.scratch-card-body .jackpot-table a.demo:hover {
		border: 2px solid #fff;
	}

	.scratch-card-body .btn {
		padding: 0
	}

	.scratch-card-header {
		position: relative;
	}

	.scratch-card-header:hover .descript {
	    opacity: 1;
	}

	.scratch-card-header .descript {
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

	.modal-jackpot-table .container-actions {
		background-color: #155C7B;
	    margin-left: 20px;
	    text-align: center;
	}

	.modal-demo .modal-body {
		padding: 20px;
	}

	
</style>