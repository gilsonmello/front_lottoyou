<template>	
	<div class="tickets">
		<header class="tickets-header">	
            <span class="text-center tickets-name">
            	{{ ticket.nome }} - ${{ value }}
            </span>   
			<span class="countdown">
				<span v-if="days > 1">
					{{ days }} {{ trans('strings.days') }} e
				</span>
				<span v-else-if="days == 1">
					{{ days }} {{ trans('strings.day') }} e
				</span>				
				{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
			</span>
			<span class="text-center tickets-limit" v-if="ticket.limite == null">
				Ilimitado
            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
            </span>        	
			<span class="text-center tickets-limit" v-else>				
				{{ ticket.group.count }} / {{ ticket.limite }}
            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
            </span> 
		    <span class="ticket-categories">
            	{{ category.nome }}
            </span>     
        </header>
		<div class="tickets-content" @click.prevent="openModal" :style="backgroundTicket(ticket.imagem_capa)">
			<div class="row">
				<div :class="verifyCol(ticket.games)" v-for="(game, index) in ticket.games">
					<game-component :game="game" :ticket="ticket" v-on:updateTicket="updateTicket" :index="index"></game-component>
					<!-- <br v-if="(ticket.games.length - 1) != index"> -->
				</div>
			</div>
			
			<div class="row" style="margin-top: 5px;">
				<div class="col-lg-12">
					<button class="btn btn-primary btn-md" @click.prevent="openModal">
						{{ trans('strings.to_play') }}
					</button>
					<!-- <button class="btn btn-danger btn-md" @click.prevent="openModal">
						{{ trans('strings.to_update') }}
					</button> -->
				</div>
			</div>
		</div> 		
		<footer class="tickets-footer">
			<div class="row">
				<div class="col-lg-12">
					<em class="text-caption">Termina em: {{ ticket.data_termino }}</em>
				</div>
			</div>
		</footer>	
	</div>		
</template>

<script>
	
	import GameComponent from './GameComponent'
	export default {
		props: ['ticket', 'index', 'type', 'category'],
		data: function() {
        	return {
    			value: 0.00,
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: '',
    			valid: true,

        	}
        },
        methods: {
        	verifyCol(game) {
        		if(game.length > 1) {
        			return 'col-lg-12 col-sm-12 col-md-12 col-12'
        		}
        		return 'col-lg-12 col-sm-12 col-md-12 col-12'
        	},
        	openModal() {
        		this.$eventBus.$emit('openModal', this.ticket);	
		    },
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        	updateTicket() {
        		//Atribuindo o resultado informado para o time da casa
				//Serve para controlar se a rodada foi complemente preenchida
				var complete = true

				//Serve para controlar se a rodada está completamente vazia
				var empty = true;

				//Verificando se encontrou algum dado vazio na rodada, se estiver, complete passa a ser falso, ou seja,
				//Não foi concluído o preenchimento na rodada
				this.ticket.games_left.filter((val) => {
					
					if((val.result_out_club === '' || val.result_out_club === null) 
						|| (val.result_house_club === '' || val.result_house_club === null)) {
						complete = false
						
					}
					
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club !== '' && val.result_out_club !== null) 
						|| (val.result_house_club !== '' && val.result_house_club !== null)) {
						empty = false;
					}

					return true;
				});

				this.ticket.games_right.filter((val) => {
					
					if((val.result_out_club === '' || val.result_out_club === null) 
						|| (val.result_house_club === '' || val.result_house_club === null)) {
						complete = false
						
					}
					
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club !== '' && val.result_out_club !== null) 
						|| (val.result_house_club !== '' && val.result_house_club !== null)) {
						empty = false;
					}

					return true;
				});

				if(this.ticket.choseGoldBall == false) {
					complete = false;
				}
				
				//Se foi completado o preenchimento na rodada
				if(complete === true) {
					this.ticket.complete = true;
					$(this.$el).addClass('complete');
					$(this.$el).removeClass('incomplete');
				} else {
					this.ticket.complete = false;
					$(this.$el).addClass('incomplete');
					$(this.$el).removeClass('complete');
				}

				//Se a rodada está vazia
				if(empty) {
					$(this.$el).removeClass('complete');
					$(this.$el).removeClass('incomplete');
				}
				
				let value = parseFloat(this.ticket.valor);
            	this.value = value.format(2, true);

				this.$emit('updateSoccerExpert');
			},
			setCountdown(date, timeOut) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.days = d;
					this.hours = h;
					this.minutes = m;
					this.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
						this.valid = false
					}
	            });
			},
			init() {
				var date = this.formatDate(this.ticket.data_termino);				
				var timeOut = setInterval(() => {
    				this.setCountdown(date, timeOut);
    			}, 1000);
    			this.setCountdown(date, timeOut);
			}
        },
        mounted: function() {
        	this.init();

        	//Escutando o close do modal, para atualizar os tickets na tela do usuário
            this.$eventBus.$on('closeModal', () => {
            	this.updateTicket();
            });
    	
    		if(this.ticket.choseGoldBall == undefined) {
            	this.$set(this.ticket, 'choseGoldBall', false);
    		}
            
            if(!this.ticket.gold_ball_game_id) {
            	this.$set(this.ticket, 'gold_ball_game_id', null);	
            }
            
            let games = this.divideInTwo(this.ticket.games);
            this.$set(this.ticket, 'games_left', games[0])
            this.$set(this.ticket, 'games_right', games[1])


	        this.updateTicket();
			let value = parseFloat(this.ticket.valor);
            this.value = value.format(2, true);
        },
		components: {
			GameComponent
		},
		computed: {
		},
		watch: {
			'ticket.choseGoldBall': function(newValue, oldValue) {
				this.updateTicket();
			}
		}
	}
</script>

<style scoped>

	.tickets-content {
		background-color: initial;
	    text-align: center;
	    padding-bottom: 20px;
	    padding-top: 20px;
	}

	.tickets {
		/*padding: 10px 20px 10px 20px;*/
		color: #000;
    	border: 1px solid #00000054;
    	box-shadow: none;
	}

	.tickets-header {
		padding: 5px 0 0 0;
		color: #000;
		background-color: initial;
	}

	.tickets-header .ticket-categories {
		font-weight: bold;
		text-align: center;
		background-color: #fad7d4;
	    border-color: #f7bec3;
	    color: #a94442;
        border: 1px solid transparent;
	    border-radius: 2px;
	    display: block;
	    text-transform: uppercase;
	}

	.tickets-header .tickets-limit {
		display: block;
	}

	.tickets-header .tickets-name {
	    display: block;
	    vertical-align: middle;
	    line-height: 17px;
	    font-size: 20px;
	    color: #000
	}

	.countdown {
		display: block;
		text-transform: lowercase;
		text-align: center;
	}
</style>