<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<!-- <h3 class="">&nbsp;</h3> -->
		<div class="container">
	        <div class="row">
	        	<div class="col-lg-12">
	        		<div class="sub-navigation">
	        			<router-link :to="{ name: 'soccer_expert.show', params: { id: soccer_expert.id } }" class="active show" id="play-component">
		                    {{ trans('strings.play_on_the') }} {{ soccer_expert.nome }}
		                </router-link>
		                <router-link :to="{ name: 'soccer_expert.results', params: { id: soccer_expert.id } }" class="show" id="result-component">
		                    Resultado 
		               	</router-link>
	        		</div>
	        	</div>
	        </div>	
		</div>
		<div class="row">
        	<div class="col-lg-12">
        		<h4 class="page-header" style="margin-top: 0;">{{ soccer_expert.nome }}</h4>
        	</div>
        </div>
        <form @submit.prevent="addToCart">
	        <div class="row container-tickets" style="overflow: auto; flex-wrap: nowrap;">
	        	<div class="col-lg-5 col-10 col-md-5 col-sm-5" v-for="(round, column) in soccer_expert.rounds">
	        		<div :class="'ticket'+column+' tickets '+completeOrNo(round)">
	        			<!-- <div class="tickets-header">
							<strong>{{ column }}</strong>
							<div class="tools">
								<a class="" href="#" @click.prevent="">
									<i class="fa fa-random"></i>
								</a>
								<a class="" href="#" @click.prevent="">
									<i class="fa fa-close"></i>
								</a>
							</div>
						</div> -->
						<div class="tickets-content well">
							<!-- <div class="row vcenter text-center">
								<div class="col-lg-12 col-12 col-sm-12 col-md-12">
									<h3>{{ column + 'ª '+ trans('strings.round') }}</h3>
								</div>	
							</div> -->
							<div class="row vcenter-end text-center" style="margin-bottom: 10px;" v-for="(game, line) in round.games">
								<div class="col-xs-5 col-md-5 col-lg-3 no-padding">
									
									<label class="club">{{ game.house_club.nome }}</label>		
									<img v-if="game.house_club.shields != undefined && game.house_club.shields.length > 0" width="30" height="30" :src="game.house_club.shields[0].dimensao">

									<img v-else width="30" height="30" :src="'https://s.glbimg.com/es/sde/f/equipes/2014/04/14/'+game.house_club.nome.toLowerCase()+'_60x60.png'">
									
								</div>
								<div class="col-lg-2 no-padding">
									<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(column, line, $event)" type="number" class="form-control">
								</div>

								<div class="col-2 col-md-2 col-sm-2 col-lg-1" style="text-align: center">
				                    x
				                </div>

				                <div class="col-lg-2 no-padding">
									<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(column, line, $event)" type="number" class="form-control" name="">
								</div>

				                <div class="col-xs-5 col-md-5 col-lg-3 no-padding">
									
									<label class="club">{{ game.out_club.nome }}</label>
									<img v-if="game.out_club.shields != undefined && game.out_club.shields.length > 0" width="30" height="30" :src="game.out_club.shields[0].dimensao">

									<img v-else width="30" height="30" :src="'https://s.glbimg.com/es/sde/f/equipes/2014/04/14/'+game.out_club.nome.toLowerCase()+'_60x60.png'">

								</div>
								
								<!-- <input type="text" class="form-control" name="">
								
								<div class="col-lg-2">
									X
								</div>
								<div class="col-lg-1">
									<input type="text" class="form-control" name="">
								</div>
								<div class="col-xs-5 col-md-5 col-lg-5">
									<span class="club">{{ game.out_club.nome }}</span>
									<img height="30" width="30" v-if="game.out_club.shields != undefined && game.out_club.shields.length > 0" :src="game.out_club.shields[0].dimensao">
									<img v-else :src="'https://s.glbimg.com/es/sde/f/equipes/2014/04/14/'+game.out_club.nome.toLowerCase()+'_60x60.png'">
								</div> -->
							</div>
						</div>
						<!-- <div class="tickets-extras">
							<span class="fields">
								<button @click.prevent="" class="btn btn-xs btn-default-darking">
									
								</button>
							</span>
						</div>
						<div class="tickets-footer">
							
						</div> -->
	        		</div>
	        		
	        	</div>
	        	<!-- <div class="col-lg-1 vcenter" style="justify-content: center;" id="btn-add-ticket">
					<a href="#" @click.prevent="addBet($event)" class="fa fa-plus" style="font-size: 60px;"></a>
					<a v-if="rounds.length > 1" href="#" @click.prevent="removeBet($event)" class="fa fa-minus" style="font-size: 60px;"></a>
				</div> -->
	        </div>
			<hr>
			<div class="row">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<button type="submit" class="btn btn-md btn-success pull-right">
						{{ trans('strings.add_to_cart') }}
					</button>
					<span class="pull-right price">
						$ <span class="value" v-if="total > 0">
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
	import LoadComponent from '../Load'
	import {mapState, mapGetters} from 'vuex'
	export default {
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
        data: function() {
        	return {
        		loading: {
					component: true
				},
				soccer_expert: {},
				id: '',
				rounds: [0],
				total: 0.00,
				item: {
					hash: null,
					id: null,
					value: null,
					name: '',
					rounds: []
				},


				/*rounds: [
			 		{
			 			id: null,
			 			hash: null,
			 			column: 0,
			 			house_club: null,
			 			house_club_result: '',
			 			out_club: null,
			 			out_club_result: '',
				 		complete: false,
				 		games: []
				 	},
				]*/
        	}
        },
        methods: {
        	completeOrNo(round) {
				return round.complete ? 'complete' : ''
			},
        	showRequest() {
        		const showRequest = axios.create();
				this.id = this.$route.params.id;
				
				showRequest.interceptors.request.use(config => {
		        	this.loading.component = true
				  	return config;
				});
				showRequest.get(routes.soccer_expert.show.replace('{id}', this.id), {}, {}).then(response => {
					if(response.status === 200){
						this.soccer_expert = response.data
						this.loading.component = false
						this.item.id = this.id;
						this.item.soccer_expert = this.soccer_expert;
						this.item.hash = this.makeid();
						this.item.value = parseFloat(this.soccer_expert.value);
						this.item.name = this.soccer_expert.nome;
						this.item.rounds = this.soccer_expert.rounds;
					}
				}).catch((error) => {
					
				});
        	},
        	showSoccerExpert() {
				var item = this.purchase.soccer_expert.items.filter((val) => {
					return this.$route.params.hash == val.hash;
				})

				if(item.length > 0) {
					item = item[0]

					this.soccer_expert = item.soccer_expert;
					this.loading.component = false
					this.item.id = item.id;
					this.item.soccer_expert = item.soccer_expert;
					this.item.hash = item.hash;
					this.item.value = parseFloat(item.soccer_expert.value);
					this.item.name = item.soccer_expert.nome;
					this.item.rounds = item.soccer_expert.rounds;
					this.total = parseFloat(item.total);
				} else {

				}
			},
			//Funão executada ao carregar
			init: function() {
				if(this.$route.params.hash != undefined) {
					this.showSoccerExpert();
				}else if(this.$route.params.id != undefined) {
					this.showRequest();
				}
			},
			//Pegando todas as apostas concluídas
			getRoundsFinished: function() {
				const vm = this
				//Pegando todas as apostas feitas
				var rounds_completed = this.item.rounds.filter(function(val) {
					//Verificando se dezenas extras está habilitado
					if(val.complete == true) {
						return true;
					}else { 
						return false;
					}
				});
				return rounds_completed;
			},
			//Column = rodada disponível no array
			//Line = jogo da roda disponível no array
			houseClubResult: function(column, line, event) {
				//Pegando o valor informado pelo usuário
				var input = $(event.currentTarget);

				if(input.val() < 0)
					input.val(input.val() * -1)

				//Atribuindo o resultado informado para o time da casa
				this.item.rounds[column].games[line].result_house_club = input.val();

				//Serve para controlar se a rodada foi complemente preenchida
				var complete = true

				//Serve para controlar se a rodada está completamente vazia
				var empty = true;

				//Verificando se encontrou algum dado vazio na rodada, se estiver, complete passa a ser falso, ou seja,
				//Não foi concluído o preenchimento na rodada
				this.item.rounds[column].games = this.item.rounds[column].games.filter((val) => {
					
					if((val.result_out_club == '' || val.result_out_club == undefined) 
						|| (val.result_house_club == '' || val.result_house_club == undefined)) {
						complete = false
						
					}
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club != '' || val.result_out_club == undefined) 
						|| (val.result_house_club != '' || val.result_house_club == undefined)) {
						empty = false;
					}

					return true;
				});

				//Se foi completado o preenchimento na rodada
				if(complete == true) {
					this.item.rounds[column].complete = true;
					$('.ticket'+column).addClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				} else {
					this.item.rounds[column].complete = false;
					$('.ticket'+column).addClass('incomplete');
					$('.ticket'+column).removeClass('complete');
				}

				//Se a rodada está vazia
				if(empty) {
					$('.ticket'+column).removeClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				}

				//Pegando todas as rodadas finalizadas
				var rounds = this.getRoundsFinished();
				//Atualizando o total
				this.total =this.item.value * rounds.length; 
			},
			//Column = rodada disponível no array
			//Line = jogo da roda disponível no array
			outClubResult: function(column, line, event) {
				var input = $(event.currentTarget);
				
				if(input.val() < 0)
					input.val(input.val() * -1)

				this.item.rounds[column].games[line].result_out_club = input.val();

				//Serve para controlar se a rodada foi complemente preenchida
				var complete = true

				//Serve para controlar se a rodada está completamente vazia
				var empty = true;

				//Verificando se encontrou algum dado vazio na rodada, se estiver, complete passa a ser falso, ou seja,
				//Não foi concluído o preenchimento na rodada
				this.item.rounds[column].games = this.item.rounds[column].games.filter((val) => {
					
					if((val.result_out_club == '' || val.result_out_club == undefined) 
						|| (val.result_house_club == '' || val.result_house_club == undefined)) {
						complete = false
					}

					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club != '' || val.result_out_club == undefined) 
						|| (val.result_house_club != '' || val.result_house_club == undefined)) {
						empty = false;
					}

					return true;
				});

				//Se foi completado o preenchimento na rodada
				if(complete == true) {
					this.item.rounds[column].complete = true;
					$('.ticket'+column).addClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				} else {
					this.item.rounds[column].complete = false;
					$('.ticket'+column).addClass('incomplete');
					$('.ticket'+column).removeClass('complete');
				}

				//Se a rodada está vazia
				if(empty) {
					$('.ticket'+column).removeClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				}

				//Pegando todas as rodadas finalizadas
				var rounds = this.getRoundsFinished();
				//Atualizando o total
				this.total = this.item.value * rounds.length; 
			},
			addToCart: function() {
				//Pegando todas as rodadas finalizadas
				var rounds = this.getRoundsFinished();

				var item = {
					id: this.id,
					hash: this.item.hash,
					soccer_expert: this.soccer_expert,
					value: this.item.value,
					rounds: rounds,
					total: this.item.value * rounds.length
				};

				//Se não completou nenhuma rodada
				if(rounds.length == 0) {
					this.$store.dispatch('removeItemSoccerExpert', item);
					alert('Faça pelo menos um jogo');
				} else {
					
					this.$store.dispatch('setItemSoccerExpert', item);

					let addSoccerExpertRequest = axios.create();

					addSoccerExpertRequest.post(routes.carts.add_soccer_experts, {
						purchase: item, 
						auth: this.auth,
						hash: item.hash
						
					}).then(response => {
			            if(response.status === 200) {
			            	
						}
			        }).catch((error) => {
			        	
			        })		

					this.$router.push({
						name: 'cart.index'
					})
				}
			}
		},
		mounted: function() {
			this.init();
		},
		components: {
			LoadComponent
		},
		computed: {
			...mapGetters([
                'purchase', 'auth'
            ]),
			totalFormated: {
            	// getter
            	get: function () {
            		return this.total.format(2, true);
		    	},
			    // setter
			    set: function (newValue) {
			      	
			    }
            }
		}
	}
</script>

<style scoped>
	.price {
		margin-right: 15px;
	}

	.tickets-content {
		padding: 15px;
	}

	.club {
		display: block;
	}

	.no-padding {
	    margin-left: 2px;
    	margin-right: 2px;
	}

	.input-group-addon {
		border-color: transparent;					
	    background-color: transparent;
	    color: inherit;
	    opacity: 0.7;
	    padding: 0;
	    justify-content: center;
	}

	.complete {
		border: 3px solid #67be13 !important;
	}

	.incomplete {
	    border: 3px solid #BF390F !important;
	}

</style>