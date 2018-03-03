<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<h1 class="page-header">{{ trans('strings.scratch_cards') }}</h1>
		<div class="row">
			<div class="col-12 col-md-6 col-sm-6 col-lg-4" v-for="scratch_card_theme in scratch_card_themes">
				<div class="scratch-card">
					<header class="scratch-card-header">
						<div class="extras">
							<img src="https://www.grandesloterias.com/images/badges/new-badge_pt.png" alt="Novo" class="game-badge">
						</div>
						<img class="header-image img-fluid" alt="Halloween" :src="'/'+scratch_card_theme.img_background_url">
						<div class="descript">
                            <h2 class="ng-binding">{{ scratch_card_theme.nome }}</h2>
                            <p class="ng-binding">{{ scratch_card_theme.texto_raspadinha }}</p>
                        </div>
					</header>
					<div class="scratch-card-body">
						<div class="amount">
							{{ scratch_card_theme.texto_index }}
						</div>
						<div class="jackpot-table">
							<div class="row vcenter">
								<div class="col-lg-8 col-12 col-md-8 col-sm-12">
									<a :data-id="scratch_card_theme.id" href="#" @click.prevent="handleJackpotTable($event)" class="btn description">
										<i class="fa fa-money" aria-hidden="true"></i>
										&nbsp;
										Tabela de Premios
									</a>
								</div>
								<div class="col-lg-4 col-12 col-md-4 col-sm-12">
									<a @click.prevent="handleDemo($event)" :data-id="scratch_card_theme.id" href="#" class="btn btn-md demo">
										Demo
									</a>
								</div>
							</div>
						</div>
					</div>

					<footer class="scratch-card-footer">
						<form>
							<div class="row vcenter">
								<div class="col-lg-9 col-9 col-md-9 col-sm-9">
									<label class="">
										<input type="radio" name="game_1_option">
										<span>1 Jogo</span>
									</label>
								</div>
								<div class="col-lg-3 col-3 col-md-3 col-sm-3">
									<span>$ 1.50</span>
								</div>
							</div>
							<div class="row vcenter">
								<div class="col-lg-9 col-9 col-md-9 col-sm-9">
									<label>
										<input type="radio" name="game_1_option">
										<span>2 Jogo</span>
									</label>
								</div>
								<div class="col-lg-3 col-3 col-md-3 col-sm-3">
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
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-header">
		  				
		  			</div>
		  			<div class="modal-body">
		  				<load-component></load-component>
		  			</div>
		  		</div>
			    <div class="modal-content" v-else>
					<!-- Modal Header -->
			      	<div class="modal-header" style="border-bottom: none;">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
			        	<div class="container-actions vcenter no-padding" style="width: 100%;">
				        	<div class="col-lg-4" style="padding-left: 0;">
				        		<img class="img-fluid" v-if="scratch_card_jackpot_available.theme" :src="'/'+scratch_card_jackpot_available.theme.img_card_url">
				        	</div>
				        	<div class="col-lg-7">
				        		<div class="row">
				        			<div class="col-lg-6">
				        				<a class="btn btn-md btn-success" href="#" @click.prevent="">
				        					{{ trans('strings.play_now') }}
				        				</a>
				        			</div>			        			
				        			<div class="col-lg-6">
				        				<a class="btn btn-md btn-demo" href="#" @click.prevent="handleDemo($event)">
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
		  	<div class="modal-dialog modal-xl">
		  		<div class="modal-content" v-if="loading.modalDemo == true">
		  			<div class="modal-header">
		  				
		  			</div>
		  			<div class="modal-body">
		  				<load-component></load-component>
		  			</div>
		  		</div>
			    <div class="modal-content" v-else>
					<!-- Modal Header -->
			      	<div class="modal-header">
			      		<div class="col-lg-6">
				        	<h4 class="modal-title">Demo de Raspadinhas sem prêmios</h4> 
				        </div>
			        	<div class="col-lg-5">
			        		<a href="javascript: void(0);" class="btn btn-success btn-md pull-right">
				        		{{ trans('strings.play_truth') }}
				        	</a>  
			        	</div> 	
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<!-- Modal body -->
			      	<div class="modal-body">
			      		<div class="col-lg-12 col-12 col-md-12 col-sm-12" v-if="scratch_card_demo.theme" :style="'background-image: url('+scratch_card_demo.theme.img_background_url+'); background-size: 100% 100%;'">
		      				<div class="row" style="padding: 20px 20px 0 20px;">
		      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
		      						<div class="row" style="height: 100%;">
		      							<div class="col-lg-12 col-12 col-md-12 col-sm-12">
		      								<span class="ticket-number">ID do Bilhete: #++++DEMO++++</span>
		      							</div>
		      							<div class="col-lg-12 col-12 col-md-12 col-sm-12 vcenter-end">
		      								<p :style="'color: '+scratch_card_demo.theme.cor_texto_raspadinha+' '" class="text-center info-text">
		      									{{ scratch_card_demo.theme.texto_index }}
		      								</p>
		      							</div>
		      							<div class="col-lg-12 col-12 col-md-12 col-sm-12 vcenter-end">
		      								<a href="javascript: void(0);" class="btn btn-result invisible">
				      							{{ trans('strings.result') }}
				      						</a>
		      							</div>
		      						</div>
		      					</div>
		      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
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
		      				<div class="row" style="padding: 10px 20px 10px 20px;">
		      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
		      						<a href="javascript: void(0);" class="btn remaining-tickets">Raspadinhas restantes: </a>
		      					</div>
		      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
		      						<a @click.prevent="handlePlay($event)" href="javascript: void(0);" class="btn btn-game btn-play">
		      							{{ trans('strings.play_scratch_card') }}
		      						</a>
		      						<a @click.prevent="handleLoading($event)" href="javascript: void(0);" class="btn hide btn-game btn-loading">
		      							{{ trans('strings.loading') + ' ...' }}
		      						</a>
		      						<a @click.prevent="handleReveal($event)" href="javascript: void(0);" class="btn hide btn-game btn-reveal-all">
		      							{{ trans('strings.reveal_all') }}
		      						</a>
		      						<a @click.prevent="handlePlayAgain($event)" href="javascript: void(0);" class="btn hide btn-game btn-play-again">
		      							{{ trans('strings.play_again') }}
		      						</a>
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
			handlePlayAgain: function (el) {
				$('.modal-demo').off('hide.bs.modal');
				const instance = axios.create();
				instance.interceptors.request.use(config => {
					$('.btn-result').addClass('invisible');
					this.loading.modalDemo = true;
					return config;
				});
				instance.get(routes.scratch_card_themes.demo.replace('{theme_id}', this.id), {}).then(response => {
		            if(response.status === 200) {
		            	this.scratch_card_demo = response.data
						this.loading.modalDemo = false;
						$(el.target).addClass('hide');
						$('.btn-play').removeClass('hide');
						this.handleScratchPad();
					}
		        }).catch((error) => {
		        	$('.modal-demo').on('hide.bs.modal', function (e) {
		        		if(error.response.data.msg) {
							toastr.error(error.response.data.msg);
			        	}
		        	});
		        	setTimeout(() => {
						$('.modal-demo').modal('hide');
		        	}, 500);
		        })			
			},
			handlePlay: function (el){
				$(el.target).addClass('hide');
				$('.btn-reveal-all').removeClass('hide');
				$('.scratchpad').wScratchPad('enable', true);
			},
			handleReveal: function(el) {
				const vm = this;
				var time = setTimeout(() => {
					$('.scratchpad').wScratchPad('clear');
					if(this.scratch_card_demo.premio > 0) {
						$('.btn-result').text('Parabéns, você ganhou: $ '+this.scratch_card_demo.premio);
					}else {
						$('.btn-result').text(vm.trans('strings.good_luck_to_the_next'));
					}
					$(el.target).addClass('hide');
					$('.btn-result').removeClass('invisible');
                	$('.btn-play-again').removeClass('hide');
				}, 200);
			},
			handleScratchPad: function() {
				const vm = this;
				var dataScratchCard = this.scratch_card_demo;
				var count = 1;
        		var time = setTimeout(() => {
					$('.scratchpad').wScratchPad('destroy');
					var i = 0;
					$('.scratchpad').each(function () {
						var verifica = 0;
						var scratchpad = $(this);
						$(this).css({
							width: $(this).parent().width()
						});
						$(this).wScratchPad({
	                        bg: 'img/raspadinha/'+ dataScratchCard['valor'+count] +'.png',
	                        fg: dataScratchCard.theme.img_capa_url,
	                        'cursor': '../img/raspadinha/coin.png") 5 5, coin',
	                        scratchMove: function (e, percent) {
	                            if (percent > 39) {
	                            	i++;
	                            	scratchpad.wScratchPad('clear');
	                            	scratchpad.wScratchPad('enable', false);
	                            }

	                            if(i == 9) {
	                            	if(dataScratchCard.premio > 0) {
	                            		$('.btn-result').removeClass('invisible');
										$('.btn-result').text('Parabéns, você ganhou: $ '+dataScratchCard.premio);
	                            	}else{
	                            		$('.btn-result').removeClass('invisible');
										$('.btn-result').text(vm.trans('strings.good_luck_to_the_next'));
	                            	}
	                            	$('.btn-reveal-all').addClass('hide');
	                            	$('.btn-play-again').removeClass('hide');
	                            }
	                        }
	                    });
                        count++;
					});
					$('.scratchpad').wScratchPad('enable', false);
					if($('.scratchpad')[0].length > 0){
						clearInterval(time);
					}
				});
			},
			handleDemo: function(el) {
				this.id = el.target.getAttribute('data-id');
				$('.modal-demo').modal('toggle');
				$('.modal-demo').off('hide.bs.modal');
				const instance = axios.create();
				instance.interceptors.request.use(config => {
					this.loading.modalDemo = true;
					return config;
				});
				instance.get(routes.scratch_card_themes.demo.replace('{theme_id}', this.id), {}).then(response => {
		            if(response.status === 200) {
		            	this.scratch_card_demo = response.data
						this.loading.modalDemo = false;
						this.handleScratchPad();
					}
		        }).catch((error) => {
		        	$('.modal-demo').on('hide.bs.modal', function (e) {
		        		if(error.response.data.msg) {
							toastr.error(error.response.data.msg);
			        	}
		        	});
		        	setTimeout(() => {
						$('.modal-demo').modal('hide');
		        	}, 500);
		        })				
			},
			submit: function (){

			},
			handleJackpotTable: function(el) {
				var id = el.target.getAttribute('data-id');
				$('.modal-jackpot-table').modal('toggle');
				const instance = axios.create();
				instance.interceptors.request.use(config => {
					this.loading.modalJackpotTable = true;
					return config;
				});
				instance.get(routes.scratch_card_themes.jackpot_available.replace('{id}', id), {}).then(response => {
		            if(response.status === 200){
		            	this.scratch_card_jackpot_available = response.data
	            		this.loading.modalJackpotTable = false;
		            }
		        }).catch((error) => {
		            
		        })
			}
		},
		data: function() {
			return {
				scratch_card_themes: [],
				scratch_card_jackpot_available: {},
				method: "GET",
				action: null,
				loading: {
					modalDemo: false,
					modalJackpotTable: false,
					component: true
				},
				id: null,
				scratch_card_demo: {}
			}
		},
		mounted: function() {
			axios.interceptors.request.use(config => {
				this.loading.component = true;
				return config;
			});
			axios.get(routes.scratch_card_themes.index, {}).then(response => {
	            if(response.status === 200){
	            	this.scratch_card_themes = response.data
	            	this.loading.component = false
	            }
	        }).catch((error) => {
	            
	        })
		},
		computed: {

		},
		watch: {
			'loading.modalDemo': function(newValue, oldValue) {}
		},
		components: {
			ModalFormComponent,
			LoadComponent
		}
	}
</script>

<style scoped>
	
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
	    font-size: 21px !important;
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

	.scratch-card-header .header-image { 
		width: 100%;
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