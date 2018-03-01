<template>
	<div class="container">
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
			      	<div class="modal-header">
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
			        				<a class="btn btn-md btn-demo" href="#" @click.prevent="">
				        				Demo
				        			</a>
			        			</div>
			        		</div>
			        		<div class="row">
			        			<div class="col-lg-12">
			        				<p class="text-center number-of-cards">Número de cartões 15000000</p>
			        			</div>
			        		</div>
			        	</div>
			        	</div>
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<!-- Modal body -->
			      	<div class="modal-body">
		        		<table class="table table-striped">
		        			<thead>
		        				<tr>
		        					<th>{{ trans('strings.level') }}</th>
		        					<th>{{ trans('strings.level') }}</th>
		        					<th>{{ trans('strings.level') }}</th>
		        				</tr>
		        			</thead>
		        		</table>
			      	</div>

			      	<!-- Modal footer -->
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>
				</div>
		  	</div>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import ModalFormComponent from '../ModalFormComponent'
	export default {
		props: [],
		created: function() {

		},
		activated: function() {
			
		},
		methods: {
			demo: function() {

			},
			submit: function (){

			},
			handleJackpotTable: function(el) {
				console.log(el)
				$('.modal-jackpot-table').modal('toggle');
			}
		},
		data: function() {
			return {
				scratch_card_themes: [],
				method: "GET",
				action: null,
			}
		},
		mounted: function() {
			axios.get(routes.scratch_card_themes.index, {}).then(response => {
	            if(response.status === 200){
	            	this.scratch_card_themes = response.data
	            }
	        }).catch((error) => {
	            
	        })
		},
		computed: {

		},
		watch: {

		},
		components: {
			ModalFormComponent
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
</style>