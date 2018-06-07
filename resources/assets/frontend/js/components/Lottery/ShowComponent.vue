<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<!-- <h3 class="">&nbsp;</h3> -->
		
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="active show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ lottery.nome }}
	                </router-link>
	                <router-link :to="{ name: 'lotteries.results', params: { id: lottery.id } }" class="show" id="result-component">
	                    {{ trans('strings.results') }}
	               	</router-link>
        		</div>
        	</div>
        </div>	
		

		<div class="row" v-if="lottery.sweepstakes.length == 0">
			<div class="col-lg-12">
				<h3>Nenhuma data de sorteio disponível no momento</h3>
			</div>				
		</div>

        <form @submit.prevent="addToCart" v-if="lottery.sweepstakes.length > 0">
        	<div class="row">
	        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
	        		<h4 class="page-header" style="margin-top: 0; border: none;">{{ lottery.nome }}</h4>
	        	</div>
	        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
	        		<button class="btn btn-md btn-back pull-right btn-primary" @click.prevent="back($event)">
	        			{{ trans('strings.back') }}
	        		</button>
	        	</div>
	        </div>
			<div class="row container-tickets" style="overflow: auto; flex-wrap: nowrap;">
				<ticket-component v-for="(ticket, index) in item.tickets" :tickets="tickets" :dickers="dickers" :dickersMaxSel="dickersMaxSel" :dickersExtras="dickersExtras" :item="item" :dickersExtrasSelect="dickersExtrasSelect" :ticket="ticket" :index="index" :key="index" v-on:refreshTickes="refreshTickes" v-on:refreshNumbersChecked="refreshNumbersChecked" v-on:deleteTicket="deleteTicket">
					
				</ticket-component>

				 <div class="col-lg-1 col-4 col-md-2 col-sm-2 vcenter" style="justify-content: center;" id="btn-add-ticket">
					<div>

						<a href="#" @click.prevent="addBet($event)" class="btn btn-primary fa fa-angle-right" style="font-size: 60px;"></a>
						<!--
						<br>
						<a v-if="tickets.length > 5" href="#" @click.prevent="removeBet($event)" class="fa fa-minus" style="font-size: 60px;"></a>-->
					</div>
				</div> 
			</div>

			<div class="row">
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						<label for="date">{{ trans('strings.sweepstake_date') }}</label>
					    <select v-model="lot_jogo_id" class="form-control" id="lot_jogo_id">
					      	<option :value="key" :data-key="key" v-for="(sweepstake, key) in lottery.sweepstakes">
					      		{{ retireHour(sweepstake.data_fim) }}
					      	</option>
					    </select>
				  	</div>
				</div>
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						<label for="date">{{ trans('strings.remaining_time_for_next_sweepstake') }}</label>
						<span class="countdown form-control">
							<span v-if="next_lottery.days > 1">
								{{ next_lottery.days }} {{ trans('strings.days') }} e
							</span>
							<span v-else-if="next_lottery.days == 1">
								{{ next_lottery.days }} {{ trans('strings.day') }} e
							</span>				
							{{ next_lottery.hours }}:{{ next_lottery.minutes }}:{{ next_lottery.seconds }}
						</span>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<button type="submit" class="btn btn-md btn-primary pull-right" v-if="!loading.paying">
						{{ trans('strings.add_to_cart') }}
					</button>
					<button @click="validate($event)" type="button" v-if="loading.paying == false && auth && auth.balance.value >= total" class="btn-pay-now pull-right btn btn-primary">
                        {{ trans('strings.pay_now') }}
                    </button>
					<button v-if="loading.paying" @click.prevent="" type="load" class="pull-right btn btn-md btn-primary">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
					<span class="pull-right price">
						{{ trans('strings.total_value') }} $<span class="value" v-if="total > 0">
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
	import PlayComponent from './PlayComponent'
	import {mapState, mapGetters} from 'vuex'
	import TicketComponent from './TicketComponent'
	export default {
		activated: function() {

		},
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
		data: function() {
			return {
				rawHtml: '',
				loading: {
					component: true,
					paying: false
				},
				lottery: {},
				id: '',
				next_lottery: {
					days: '',
	    			hours: '',
	    			minutes: '',
	    			seconds: ''
				},
				//Dezenas máxima a ser selecionada
				dickersMaxSel: [],
				dickers: [],
				dickersExtras: [],
				dickersExtrasSelect: [],
				tickets: [0, 1, 2, 3, 4],
				total: 0.00,
				lot_jogo_id: '',
				item: {
					hash: null,
					id: null,
					value: null,
					name: '',
					date: '',
					lottery: {},
					tickets: [
				 		{
				 			ticket: 0,
					 		complete: false,
					 		completeExtras: false,
					 		numbers: [],
					 		numbersExtras: []
					 	},
					]
				}
			}
		},
		methods: {
			retireHour(date) {
				date = date.split(' ');
				return date[0];
			},
			completePurchase(event) {

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
									toastr.options.onHidden = function() {
										window.location.reload();
									};
									toastr.success(
										this.trans('strings.successful_purchase'),
										this.trans('strings.buy'),
									);
									window.localStorage.setItem('authUser', JSON.stringify(response.data))
									this.$store.dispatch('setUserObject', response.data);
									this.$store.dispatch('clearPurchase');
									
									/*this.$router.push({
										name: 'users.transactions'
									});	*/
								}								
							}).catch((error) => {

							});
						
					}
				}).catch((error) => {
					this.loading.paying = false;
				});		
			},
			validate(event) {
				var tickets = this.getTicketsFinished().clone();

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake,
					dickers: this.dickers,
					dickersMaxSelect: this.dickersMaxSel,
					dickersExtras: this.dickersExtras,
					dickersExtrasMaxSelect: this.dickersExtrasSelect
				};

				if(tickets.length == 0) {
					alert('Faça pelo menos um jogo');
					//this.$store.dispatch('removeItemLottery', item);
				} else {

					this.$store.dispatch('setItemLottery', item);

					var validateRequest = axios.create();

					validateRequest.interceptors.request.use(config => {
						this.loading.paying = true;
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
						this.$store.dispatch('removeItemLottery', item);
						toastr.error(
							error.response.data.msg,
							this.trans('strings.error')
						);
						this.loading.paying = false
					});	
				}
			},
			fastBuy(event) {
				var vm = this
				var tickets = this.getTicketsFinished().clone();

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake,
					dickers: this.dickers,
					dickersMaxSelect: this.dickersMaxSel,
					dickersExtras: this.dickersExtras,
					dickersExtrasMaxSelect: this.dickersExtrasSelect
				};

				let addLotteryRequest = axios.create();

				addLotteryRequest.interceptors.request.use(config => {
					return config;
				});

				addLotteryRequest.post(routes.carts.add_lotteries, {
					purchase: item, 
					auth: this.auth,
					hash: item.hash
					
				}).then(response => {
		            if(response.status === 200) {
						this.completePurchase();
					}
		        }).catch((error) => {
		        	this.loading.paying = false;
		        	toast.error('Erro ao adicionar item', 'Por favor tente novamente');
		        });
			},
			sweepstakesRequest() {				

				const sweepstakesRequest = axios.create();
				let url = routes.lotteries.sweepstakes.replace('{id}', this.$route.params.id)

				sweepstakesRequest.interceptors.request.use(config => {		        
				  	return config;
				});

				return sweepstakesRequest.get(url, {}, {});
			},
			back(event) {
				this.$router.push({
					name: 'lotteries.index'
				})
			},
			wow(bet) {
				return bet.complete && bet.completeExtras ? 'complete' : ''
			},
			deleteTicket(index) {
				/*this.tickets = item.tickets.map((elem, idx, array) => {
					if(index != idx) {
						return true;
					}
				})*/
				this.item.tickets.splice(index, 1);
				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				this.total = this.item.value * tickets.length;
			},
			showRequest() {
				const showRequest = axios.create();

				this.id = this.$route.params.id;
				
				showRequest.interceptors.request.use(config => {
		        	this.loading.component = true
				  	return config;
				});
				showRequest.get(routes.lotteries.show.replace('{id}', this.id), {}, {}).then(response => {
					if(response.status === 200){
						this.lottery = response.data
						this.lot_jogo_id = this.lottery.sweepstakes[0].id
						this.loading.component = false
						this.tickets = [0, 1, 2, 3, 4];
						this.item.hash = this.makeid(); 
						this.item.id = this.lottery.id;
						this.item.value = this.lottery.value;
						this.item.lottery = this.lottery;

						this.lot_jogo_id = 0;
						
						this.item.tickets = [
							{
					 			ticket: 0,
						 		complete: false,
						 		completeExtras: false,
						 		numbers: [],
						 		numbersExtras: []
						 	},
						 	{
					 			ticket: 1,
						 		complete: false,
						 		completeExtras: false,
						 		numbers: [],
						 		numbersExtras: []
						 	},
						 	{
					 			ticket: 2,
						 		complete: false,
						 		completeExtras: false,
						 		numbers: [],
						 		numbersExtras: []
						 	},
						 	{
					 			ticket: 3,
						 		complete: false,
						 		completeExtras: false,
						 		numbers: [],
						 		numbersExtras: []
						 	},
						 	{
					 			ticket: 4,
						 		complete: false,
						 		completeExtras: false,
						 		numbers: [],
						 		numbersExtras: []
						 	}
						];
						this.dickers = [];
						this.dickersMaxSel = [];
						this.dickersExtras = [];
						this.dickersExtrasSelect = [];
					 	for (var i = 1; i <= this.lottery.dezena; i++) {
			            	this.dickers.push(i);
			            }
			            for (var i = 1; i <= this.lottery.dezena_sel; i++) {
			            	this.dickersMaxSel.push(i);
			            }
			            for (var i = 1; i <= this.lottery.dezena_extra; i++) {
			            	this.dickersExtras.push(i);
			            }
			            for (var i = 1; i <= this.lottery.dezena_extra_sel; i++) {
			            	this.dickersExtrasSelect.push(i);
			            }
						
						var date = this.formatDate(this.lottery.sweepstakes[0].data_fim);				
						var timeOut = setInterval(() => {
		    				this.setCountdown(date, timeOut);
		    			}, 1000);
		    			this.setCountdown(date, timeOut);
					
					}
				}).catch((error) => {
					this.loading.component = false;
					this.lottery.sweepstakes = []
				});
			},
			verifyNumberSelected(numbers, dicker) {
				//
				for(var i = 0; i < numbers.length; i++) {
					if(dicker == numbers[i]) {
						return true;
						//continue;
					}
				}
			},
			showLottery() {

				//Esperando a busca do item
				var loopFindItem = setInterval(() => {
					//Pegando o item que seja igual ao hash passado como parâmetro
					var item = this.purchase.lotteries.items.filter((val) => {
						return this.$route.params.hash == val.hash;
					})

					//Se encontrou o item, paro a busca e sigo com o processo
					if(item.length > 0) {
						clearInterval(loopFindItem);

						item = item[0]

						this.lottery = item.lottery

						this.sweepstakesRequest().then(response => {
							if(response.status === 200) {
								this.lottery.sweepstakes = response.data
								var date = this.formatDate(this.lottery.sweepstakes[0].data_fim);				
								var timeOut = setInterval(() => {
				    				this.setCountdown(date, timeOut);
				    			}, 1000);
				    			this.setCountdown(date, timeOut);
							}
						});

		    			this.lot_jogo_id = item.lot_jogo_id

						this.loading.component = false

						var tickets = [];

						item.tickets.map((elem, index, array) => {
							tickets.push(elem)

							var loopFindTicket = setInterval(() => {
								if($('.ticket'+index).length > 0) {
									clearInterval(loopFindTicket);
									$('.ticket'+index).addClass('complete');
								}
							});
						})

						this.tickets = tickets;
						this.item.hash = item.hash; 
						this.item.id = item.id;
						this.item.value = item.value;
						this.item.lottery = item.lottery;
						
						this.item.tickets = item.tickets;
						this.dickers = item.dickers;
						this.dickersMaxSel = item.dickersMaxSelect;
						this.dickersExtras = item.dickersExtras;
						this.dickersExtrasSelect = item.dickersExtrasMaxSelect;

						this.total = this.item.value * item.tickets.length;

					} else {

					}
				})

				var loopFindTicket = setInterval(() => {
					if($(".container-tickets").length > 0) {
						clearInterval(loopFindTicket);
						//Arrastando o scroll para a esquerda
						$(".container-tickets").animate({ 
							scrollLeft: $('.container-tickets')[0].scrollWidth 
						}, 500, 'linear', function() {
							
						});
					}
				})
				
			},
			//Funcão executada ao carregar
			init: function() {
				if(this.$route.params.hash != undefined) {
					this.showLottery();
				} else if(this.$route.params.id != undefined) {
					this.showRequest();
				}
				window.document.title = this.trans('strings.lotteries');
			},
			setCountdown(date, timeOut) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.next_lottery.days = d;
					this.next_lottery.hours = h;
					this.next_lottery.minutes = m;
					this.next_lottery.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
					}
	            });
			},
			//Removendo aposta
			removeBet: function(event) {

				//Remove a última coluna
				this.tickets.pop();
				

				//Remove a última aposta
				this.item.tickets.pop();



				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				
				this.total = this.item.value * tickets.length;

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake
				};
				
				
				if(item.tickets.length == 0) {
					this.$store.dispatch('removeItemLottery', item);
				} else {
					this.$store.dispatch('setItemLottery', item);	
				}

				
			},
			//Adiciona aposta
			addBet: function(event) {

				var tickets = []

				this.tickets.filter((val) => {
					tickets.push(val)
				})

				//Adicionando uma nova coluna
				this.tickets.push({
					ticket: this.tickets.length - 1,
					complete: false,
					completeExtras: false,
					numbers: [],
					numbersExtras: []
				});

				//Adicionando uma nova aposta no array
				this.item.tickets.push({
					ticket: this.tickets.length - 1,
					complete: false,
					completeExtras: false,
					numbers: [],
					numbersExtras: []
				});
				
				//Arrastando o scroll para a esquerda
				$(".container-tickets").animate({ 
					scrollLeft: $('.container-tickets')[0].scrollWidth 
				}, 500, 'linear', function() {
					
				});
			},
			clickNumberExtras: function(ticket, number, event) {
				var btn = $(event.currentTarget);					

				if(btn.hasClass('btn-checked')){
					btn.removeClass('btn-checked');
					this.item.tickets[ticket].numbersExtras = this.item.tickets[ticket].numbersExtras.filter((val) => {
						return val != number;
					});
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.item.tickets[ticket].numbersExtras.length != this.dickersExtrasSelect.length) {
						btn.addClass('btn-checked');
						this.item.tickets[ticket].numbersExtras.push(number);
					}
				}

				//Se o número de dezenas extras selecionada for igual ao número de dezenas extras possíveis
				if(this.item.tickets[ticket].numbersExtras.length == this.dickersExtrasSelect.length) {
					this.item.tickets[ticket].completeExtras = true
				} else {
					this.item.tickets[ticket].completeExtras = false
				}

				
				//Se a aposta foi selecionada
				if(this.item.tickets[ticket].complete === true && this.item.tickets[ticket].completeExtras === true) {
					$('.ticket'+ticket).addClass('complete');
					$('.ticket'+ticket).removeClass('incomplete');
				}else {
					$('.ticket'+ticket).addClass('incomplete');
					$('.ticket'+ticket).removeClass('complete');
				}	

				if(this.item.tickets[ticket].numbersExtras.length == 0 && this.item.tickets[ticket].numbers.length == 0) {
					$('.ticket'+ticket).removeClass('complete');
					$('.ticket'+ticket).removeClass('incomplete');
				}

				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				this.total = this.item.value * tickets.length;
			},
			isEnabledDickersExtras: function() {
				if(this.dickersExtrasSelect.length > 0) {
					return true
				}
				return false
			},
			//Função executada ao clicar em algum número da aposta 
			//ticket significa a aposta clicada
			clickNumber: function(ticket, number, event) {
				var btn = $(event.currentTarget);
				
				//
				if(btn.hasClass('btn-checked')){
					btn.removeClass('btn-checked');
					this.item.tickets[ticket].numbers = this.item.tickets[ticket].numbers.filter(function(val) {
						return val != number;
					});
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.item.tickets[ticket].numbers.length != this.dickersMaxSel.length) {
						btn.addClass('btn-checked');
						this.item.tickets[ticket].numbers.push(number);
					}
				}


				//Se o usuário selecionou todas as dezenas possíveis
				if(this.item.tickets[ticket].numbers.length == this.dickersMaxSel.length) {
					this.item.tickets[ticket].complete = true
				} else {
					this.item.tickets[ticket].complete = false
				}

				//Verifico se existe dezenas extras,
				//Caso não, faço a verificação somente nas dezenas
				if(this.isEnabledDickersExtras()) {
					if(this.item.tickets[ticket].complete === true && this.item.tickets[ticket].completeExtras === true) {
						$('.ticket'+ticket).addClass('complete');
						$('.ticket'+ticket).removeClass('incomplete');
					}else {
						$('.ticket'+ticket).addClass('incomplete');
						$('.ticket'+ticket).removeClass('complete');
					}	
				}else{
					if(this.item.tickets[ticket].complete === true) {
						$('.ticket'+ticket).addClass('complete');
						$('.ticket'+ticket).removeClass('incomplete');
					}else {
						$('.ticket'+ticket).addClass('incomplete');
						$('.ticket'+ticket).removeClass('complete');
					}	
				}


				//Se não tem nenhuma dezena selecionada
				if(this.item.tickets[ticket].numbersExtras.length == 0 && this.item.tickets[ticket].numbers.length == 0) {
					$('.ticket'+ticket).removeClass('complete');
					$('.ticket'+ticket).removeClass('incomplete');
				}

				//Pegando apostas concluídas
				var tickets = this.getTicketsFinished();
				//Atualizando o total
				this.total = this.item.value * tickets.length;
			},
			//Função para remover números duplicados em um array
			removeRepeatedNumbers: function(numbers, value) {
				for(var i = 0; i < numbers.length; i++) {
					for(var j = i + 1; j < numbers.length; j++){
						if(numbers[i] == numbers[j]) {
							numbers[i] = Math.floor(Math.random()*this.dickers.length) + 1;
							this.removeRepeatedNumbers(numbers)
						}
					}
				}
				return numbers;
			},
			selectRandom: function(ticket, event) {
				//Números randomicos
				var numbersRand = [];

				//Pegando números aleatórios entre as dezenas selecionáveis
				//Por exemplo: 1 até 60
				var dickersLength = this.dickers.length;

				for(var i = 1; i <= this.dickersMaxSel.length; i++) {
					var rand = Math.floor(Math.random()*dickersLength) + 1;
					numbersRand.push(rand);
				}

				this.item.tickets[ticket].numbers = this.removeRepeatedNumbers(numbersRand);
				this.item.tickets[ticket].complete = true;

				$('.ticket'+ticket).find('button').removeClass('btn-checked');
				
				//Percorrendo os números e adicionando a classe btn-checked
				for(var i = 0; i < numbersRand.length; i++) {
					var btn = $('.ticket'+ticket+' .tickets-content').find('button')[numbersRand[i] - 1];
					$(btn).addClass('btn-checked');
				}

				//Números extras randomicos
				var numbersExtrasRand = []
				//Dezenas extras
				var dickersExtrasLength = this.dickersExtras.length;

				//Pegando números aleatórios entre as dezenas extras selecionáveis
				//Por exemplo: 1 até 20
				for(var i = 1; i <= this.dickersExtrasSelect.length; i++) {
					var rand = Math.floor(Math.random()*dickersExtrasLength) + 1;
					numbersExtrasRand.push(rand);
				}
				
				this.item.tickets[ticket].numbersExtras = this.removeRepeatedNumbers(numbersExtrasRand);
				if(this.isEnabledDickersExtras()) {
					this.item.tickets[ticket].completeExtras = true;
				}

				//Percorrendo os números extras e adicionando a classe btn-checked
				for(var i = 0; i < numbersExtrasRand.length; i++) {
					var btn = $('.ticket'+ticket+' .tickets-extras').find('button')[numbersExtrasRand[i] - 1];
					$(btn).addClass('btn-checked');
				}
				$('.ticket'+ticket).removeClass('incomplete');
				$('.ticket'+ticket).addClass('complete');


				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				
				this.total = this.item.value * tickets.length;


			},
			//Pegando todas as apostas concluídas
			getTicketsFinished: function() {
				const vm = this
				//Pegando todas as apostas feitas
				var tickets = this.item.tickets.filter(function(val) {
					//Verificando se dezenas extras está habilitado
					if(vm.isEnabledDickersExtras()) {
						if(val.complete == true && val.completeExtras == true) {
							return true;
						}
					}else{
						if(val.complete == true) {
							return true;
						}
					}					
					return false;
				});

				return tickets;
			},
			refreshNumbersChecked() {
				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				
				this.total = this.item.value * tickets.length;

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake
				};

				if(item.tickets.length === 0) {
					this.$store.dispatch('removeItemLottery', item);
				} else {
					this.$store.dispatch('setItemLottery', item);	
				}
			},
			//Deletando números selecionados na aposta clicada
			//
			deleteNumbersChecked: function(ticket, event) {
				$('.ticket'+ticket).find('.btn-checked').removeClass('btn-checked');
				$('.ticket'+ticket).removeClass('incomplete');
				$('.ticket'+ticket).removeClass('complete');
				this.item.tickets[ticket].numbers = [];
				this.item.tickets[ticket].numbersExtras = [];
				this.item.tickets[ticket].completeExtras = false;
				this.item.tickets[ticket].complete = false;

				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				
				this.total = this.item.value * tickets.length;

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake
				};

				if(item.tickets.length === 0) {
					this.$store.dispatch('removeItemLottery', item);
				} else {
					this.$store.dispatch('setItemLottery', item);	
				}
			},
			//Função para adicionar item no carrinho
			addToCart: function(event) {
				var vm = this
				var tickets = this.getTicketsFinished().clone();

				

				var sweepstake = Object.assign(this.item.lottery.sweepstakes[this.lot_jogo_id]);

				//this.item.lottery.sweepstakes = this.item.lottery.sweepstakes[this.lot_jogo_id]

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets,
					sweepstake: sweepstake,
					dickers: this.dickers,
					dickersMaxSelect: this.dickersMaxSel,
					dickersExtras: this.dickersExtras,
					dickersExtrasMaxSelect: this.dickersExtrasSelect
				};

				if(tickets.length == 0) {
					alert('Faça pelo menos um jogo');
					//this.$store.dispatch('removeItemLottery', item);
				}else {

					let addLotteryRequest = axios.create();

					addLotteryRequest.interceptors.request.use(config => {
			        	this.loading.paying = true;
					  	return config;
					});

					addLotteryRequest.post(routes.carts.add_lotteries, {
						purchase: item, 
						auth: this.auth,
						hash: item.hash
						
					}).then(response => {
			            if(response.status === 200) {
							this.$store.dispatch('setItemLottery', item);
			            	this.$router.push({
								name: 'cart.index'
							})
						}
			        }).catch((error) => {
			        	this.loading.paying = false;
			        	toast.error('Erro ao adicionar item', 'Por favor tente novamente');
			        })	
					
					/*const cartRequest = axios.create();
					cartRequest.interceptors.request.use(config => {
			        	return config;
					});
					cartRequest.post(routes.carts.store, {}, {}).then(response => {
						
					}).catch((error) => {
					
					});*/
				}
			},
			//Função para remover item do carrinho
			removeToCart: function() {
				var vm = this
				var tickets = this.item.tickets.filter(function(val) {
					if(vm.isEnabledDickersExtras()) {
						if(val.complete == true && val.completeExtras == true) {
							return true;
						}
					}else{
						if(val.complete == true) {
							return true;
						}
					}					
					return false;
				});
				var item = {
					hash: this.item.hash,
					id: this.item.id,
					name: this.item.name,
					value: this.item.value,
					lottery: this.item.lottery,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					tickets: tickets
				};
				this.$store.dispatch('removeItemLottery', item);
			},
			refreshTickes() {
				//Pegando todas as apostas feitas
				var tickets = this.getTicketsFinished();
				
				this.total = this.item.value * tickets.length;
			},
			init() {
				if(this.$route.params.hash != undefined) {
					this.showSoccerExpert();
				} else if(this.$route.params.id != undefined) {
					this.showRequest();
				}
				window.document.title = this.trans('strings.soccer_expert');
			}
 		},
 		mounted: function() {
			this.init();
		},
		computed: {
            ...mapState({
                User: state => state.User
            }),
            ...mapGetters([
                'auth', 'purchase'
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
        },
		components: {
			LoadComponent,
			PlayComponent,
			TicketComponent
		},
		watch: {
			purchase: {
				handler(newValue, oldValue) {
			      	
			    },
			    deep:true
			},
			'tickets': function(newValue, oldValue) {
				
			}
		}
	}
</script>

<style scoped>
	.btn-pay-now {
		margin-right: 15px
	}
	
	.countdown {

	}

	.btn-xs {
        margin: 2px;
        width: 28px;
        height: 28px;
        font-size: 12px;
        border-radius: 999px !important;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        -webkit-transition: -webkit-box-shadow 0.15s ease-out;
        -moz-transition: -moz-box-shadow 0.15s ease-out;
        -o-transition: -o-box-shadow 0.15s ease-out;
        transition: box-shadow 0.15s ease-out;
        padding: 0;
    }
</style>