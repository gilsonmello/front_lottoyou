<template>	
	<div class="tickets">
		<header class="tickets-header">			
            <span class="text-center tickets-name">{{ ticket.nome }} - ${{ value }}</span>
            <span class="countdown">
				<span v-if="days > 1">
					{{ days }} {{ trans('strings.days') }} e
				</span>
				<span v-else-if="days == 1">
					{{ days }} {{ trans('strings.day') }} e
				</span>				
				{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
			</span>
            <span class="text-center tickets-limit">
				{{ ticket.limite == null ? 'Ilimitado' : ticket.limite }}
            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
            </span>       
            <span class="ticket-categories">
            	{{ category.nome }}
            </span>     
		</header>
		<div class="tickets-content" :style="backgroundTicket(ticket.imagem_capa)">
			<div class="row">
				<div :class="verifyCol(ticket.games)" v-for="(game, index) in ticket.games">
					<game-component :game="game" :ticket="ticket" v-on:updateTicket="updateTicket" :index="index"></game-component>
					<div class="separator" v-if="index % 2 == 0 && ticket.games.length > 1">
						
					</div>
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
		props: ['ticket', 'index', 'type', 'category', 'item'],
		data: function() {
        	return {
    			value: 0.00,
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: ''
        	}
        },
        methods: {
        	verifyCol(game) {
        		if(game.length > 1) {
        			return 'col-lg-6 col-sm-6 col-md-6 col-12'
        		}
        		return 'col-lg-12 col-sm-6 col-md-6 col-12'
        	},
        	openModal() {
        		this.$emit('openModal', this.index, this.type);       		
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
				this.ticket.games.filter((val) => {

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

				//Se foi completado o preenchimento na rodada
				if(complete == true) {
					this.ticket.complete = true;
					$(this.$el).addClass('complete');
					$(this.$el).removeClass('incomplete');
					this.item.tickets.unshift(this.ticket);
				} else {
					this.ticket.complete = false;
					$(this.$el).addClass('incomplete');
					$(this.$el).removeClass('complete');
					this.item.tickets = this.item.tickets.filter((val) => {
						return this.ticket.id != val.id
					});
				}

				//Se a rodada está vazia
				if(empty) {
					$(this.$el).removeClass('complete');
					$(this.$el).removeClass('incomplete');
				}
				
				this.$emit('updateSoccerExpert');
			},
			setCountdown(date) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.days = d;
					this.hours = h;
					this.minutes = m;
					this.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
					}
	            });
			},
			init() {
				var date = this.formatDate(this.ticket.data_termino);				
				this.setCountdown(date);
    			var timeOut = setInterval(() => {
    				this.setCountdown(date);
    			}, 1000);
			}
        },
        mounted: function() {
        	//Callback executado ao abrir modal para atualizar o ticket do modal
			$(".modal-ticket")
				.on('shown.bs.modal', (event) => {
					this.init();
					this.updateTicket();
				})			

			let value = parseFloat(this.ticket.valor);
            this.value = value.format(2, true);
		},
		components: {
			GameComponent
		},
		computed: {
			
		}
	}
</script>

<style scoped>

	.tickets-content {
		background-color: initial;
		text-align: center;
	    padding-bottom: 20px;
	    padding-top: 20px;
	    cursor: default;
	}

	.tickets {
		
		padding: 5px;
	}

	.separator {
		position: absolute;
	    top: 0;
	    right: -8px;
	    width: 20px;
	    height: 100%;
	}

	.separator:after {
		width: 100%;
	    content: '|';
    	font-size: 80px;
    	line-height: 1;
    	color: white;
	}

	@media (max-width: 576px) {
		.separator {
			display: none;
		}
	}

	.tickets-header {
		padding: 5px 0 0 0;
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