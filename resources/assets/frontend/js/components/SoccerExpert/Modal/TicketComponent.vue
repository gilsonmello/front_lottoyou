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
            	{{ ticket.group.count }} / {{ ticket.limite == null ? 'Ilimitado' : ticket.limite }}
				<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
            </span>       
            <span class="ticket-categories">
            	{{ category.nome }}
            </span>     
		</header>
		<div class="tickets-content" :style="backgroundTicket(ticket.imagem_modal)">
			
			<div class="col-lg-6 col-12 col-md-6 col-sm-12">
				<game-component v-for="(game, index) in ticket.games_left" :key="index" :game="game" :ticket="ticket" v-on:updateTicket="updateTicket" :index="index" :position="'left'"></game-component>
			</div>

			
				<div class="separator" v-if="ticket.games_right.length > 0">
					<div class="line">
						
					</div>
				</div>
			

			<div class="col-lg-6 col-12 col-md-6 col-sm-12">
				<game-component v-for="(game, index) in ticket.games_right" :key="index" :game="game" :ticket="ticket" v-on:updateTicket="updateTicket" :index="index" :position="'right'"></game-component>
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
	import {routes} from '../../../api_routes'
	import {mapState, mapGetters} from 'vuex'
	import GameComponent from './GameComponent'
	export default {
		props: ['ticket', 'index', 'type', 'category', 'item'],
		data: function() {
        	return {
    			value: 0.00,
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: '',
    			valid: true,
    			empty: true,
    			allSelected: true
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
				this.empty = true;

				this.allSelected = true;

				//Verificando se encontrou algum dado vazio na rodada, se estiver, complete passa a ser falso, ou seja,
				//Não foi concluído o preenchimento na rodada
				this.ticket.games_left.filter((val) => {

					if((val.result_out_club === '' || val.result_out_club === null) 
						|| (val.result_house_club === '' || val.result_house_club === null)) {
						complete = false
						this.allSelected = false;
						
					}
					
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club !== '' && val.result_out_club !== null) 
						|| (val.result_house_club !== '' && val.result_house_club !== null)) {
						this.empty = false;
					}

					return true;
				});

				this.ticket.games_right.filter((val) => {

					if((val.result_out_club === '' || val.result_out_club === null) 
						|| (val.result_house_club === '' || val.result_house_club === null)) {
						complete = false
						this.allSelected = false;
						
					}
					
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club !== '' && val.result_out_club !== null) 
						|| (val.result_house_club !== '' && val.result_house_club !== null)) {
						this.empty = false;
					}

					return true;
				});

				if(this.ticket.choseGoldBall == false) {
					complete = false;
				}

				//Se foi completado o preenchimento na rodada
				if(complete == true) {
					this.ticket.complete = true;
					$(this.$el).addClass('complete');
					$(this.$el).removeClass('incomplete');

					//Verifico se o item já está incluso na lista de tickets
					var has = false;
					this.item.tickets.filter((val) => {
						if(this.ticket.id == val.id)
							has = true;
					});

					//Caso não esteja, adiciono, se não, não adiciono novamente
					if(!has) {
						this.item.tickets.unshift(this.ticket);
					}

				} else {
					this.ticket.complete = false;
					$(this.$el).addClass('incomplete');
					$(this.$el).removeClass('complete');
					this.item.tickets = this.item.tickets.filter((val) => {
						return this.ticket.id != val.id
					});
				}

				//Se a rodada está vazia
				if(this.empty) {
					$(this.$el).removeClass('complete');
					$(this.$el).removeClass('incomplete');
				}

				//Se a rodada está vazia
				if(this.empty && this.ticket.choseGoldBall) {
					$(this.$el).addClass('incomplete');
					$(this.$el).removeClass('complete');
				}
				
    			this.$eventBus.$emit('updateData');
			},
			setCountdown(date) {
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
				this.setCountdown(date);
    			var timeOut = setInterval(() => {
    				this.setCountdown(date);
    			}, 1000);
			},
			validate(event) {

        		var item = {
					hash: this.item.hash,
					total: this.item.total,
					soccer_expert: this.item.soccer_expert,
					tickets: this.item.tickets,
				};

				//Se não completou nenhuma rodada
				if(this.item.tickets.length == 0) {
					this.$store.dispatch('removeItemSoccerExpert', item);
					alert('Faça pelo menos um jogo');
				} else {
					
					this.$store.dispatch('setItemSoccerExpert', item);
				
					var validateRequest = axios.create();

					validateRequest.interceptors.request.use(config => {
			          	return config;
					});

					validateRequest.post(
						routes.carts.validate, 
						this.purchase, 
						{}
					).then(response => {
						if(response.status === 200) {
							this.fastBuy();
						}
					}).catch((error) => {
						toastr.error(
							error.response.data.msg,
							this.trans('strings.error')
						);

						this.$eventBus.$emit('notificationPayment');
					});		
				}
			},
        	fastBuy(event) {

				var completePurchaseRequest = axios.create();

				completePurchaseRequest.interceptors.request.use(config => {					
		          	return config;
				});

				this.purchase['user_id'] = this.auth.id;

				completePurchaseRequest.post(
					routes.carts.complete_purchase, 
					this.purchase, 
					{}
				).then(response => {
					if(response.status === 200) {
						this.refreshAuthPromise()
							.then((response) => {
								if (response.status === 200) {
									toastr.success(
										this.trans('strings.successful_purchase'),
										this.trans('strings.buy'),
									);
									window.localStorage.setItem('authUser', JSON.stringify(response.data))
									this.$store.dispatch('setUserObject', response.data);
									this.$store.dispatch('clearPurchase');
									this.$router.push({
										name: 'users.transactions'
									});	
								}								
							}).catch((error) => {

							});
						
					}
				}).catch((error) => {
					this.$eventBus.$emit('notificationPayment');
				});		
			},
			hasError() {
				let error = false;
				if(this.ticket.complete == false && this.ticket.choseGoldBall && this.empty == true) {
        			toastr.error('Por favor, informe todos os jogos.', 'Cartela incompleta');
        			 error = true;
        		} else if(this.ticket.choseGoldBall == false && this.allSelected == false) {
        			toastr.error('Por favor, Está faltando algum jogo e a Bola Lottoyou.', 'Cartela incompleta');
        			error = true;
        		} else if(this.ticket.choseGoldBall == false) {
        			toastr.error('Por favor, selecione a Bola Lottoyou.', 'Cartela incompleta');
        			error = true;
        		} else if(this.empty) {
        			toastr.error('Por favor, informe todos os jogos ', 'Cartela vazia');
        			error = true;
        		} else if(this.empty == false && this.ticket.complete == false) {
        			toastr.error('Por favor, Está faltando algum jogo ', 'Cartela incompleta');
        			error = true;
        		}
				return error;
			}
        },
        beforeDestroy() {
        	this.$eventBus.$off('updateData');
        	this.$eventBus.$off('validatePurchase');
        	this.$eventBus.$off('notificationPayment');
        },
        mounted: function() {
        	//Callback executado ao abrir modal para atualizar o ticket do modal
			$(".modal-ticket")
				.on('shown.bs.modal', (event) => {
					this.init();
					this.updateTicket();
				})	

            //Abrindo o modal
            $('.modal-ticket').on('hidden.bs.modal', (event) => {
            	this.hasError();
			});

            this.$eventBus.$on('validatePurchase', () => {
            	if(!this.hasError()) {
            		this.validate();
            	} else {
            		this.$eventBus.$emit('notificationPayment');
            	}
            });

			let value = parseFloat(this.ticket.valor);
            this.value = value.format(2, true);
		},
		components: {
			GameComponent
		},
		computed: {
			...mapGetters([
                'purchase', 'auth'
            ]),
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
	    padding-bottom: 10px;
	    padding-top: 10px;
	    cursor: default;
	    display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		position: relative;
	}

	.tickets {
		margin-bottom: 0;
		padding: 5px;
	}

	.separator {
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    -webkit-transform: translate(-50%, -50%);
	    transform: translate(-50%, -50%);
	    width: 40px;
	    height: 100%;
	    padding: 10px;
	}

	.line {
	    border-right: 3px solid #fff;
	    height: 100%;
	    width: 100%;
	}

	.separator:after {
		
	}

	@media (max-width: 576px) {
		.separator {
			display: none;
		}
	}

	@media (max-width: 747px) {
    	.separator {
			display: none;
		}
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