<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<!-- <h3 class="">&nbsp;</h3> -->
		<div class="container">
	        <div class="row">
	        	<div class="col-lg-12">
	        		<div class="sub-navigation">
	        			<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="active show" id="play-component">
		                    {{ trans('strings.play_on_the') }} {{ lottery.sorteio }}
		                </router-link>
		                <router-link :to="{ name: 'lotteries.results', params: { id: lottery.id } }" class="show" id="result-component">
		                    Resultado 
		               	</router-link>
	        		</div>
	        	</div>
	        </div>	
		</div>

        <form @submit.prevent="addToCart">
        	<div class="row">
	        	<div class="col-lg-12">
	        		<h4 class="page-header" style="margin-top: 0;">{{ lottery.sorteio }}</h4>
	        	</div>
	        </div>
			<div class="row container-tickets" style="overflow: auto; flex-wrap: nowrap;">
				<div class="col-lg-3" v-for="(index, column) in columns">
					<div :class="'ticket'+column+' tickets'">
						<div class="tickets-header">
							<strong>{{ column }}</strong>
							<div class="tools">
								<a class="" href="#" @click.prevent="selectRandom(column, $event)">
									<i class="fa fa-random"></i>
								</a>
								<a class="" href="#" @click.prevent="deleteNumbersChecked(column, $event)">
									<i class="fa fa-close"></i>
								</a>
							</div>
						</div>
						<div class="tickets-content">
							<span class="fields" v-for="dicker in dickers">
								<button @click.prevent="clickNumber(column, dicker, $event)" class="btn btn-xs btn-default-color">
									{{ dicker }}
								</button>
							</span>
						</div>
						<div class="tickets-extras">
							<span class="fields" v-for="dicker in dickersExtras">
								<button @click.prevent="clickNumberExtras(column, dicker, $event)" class="btn btn-xs btn-default-darking">
									{{ dicker }}
								</button>
							</span>
						</div>
						<div class="tickets-footer">
							<em class="text-caption">
                        		Dezenas restantes - 
                    			<input v-if="item.betting.length > 0 && item.betting[column].numbers != undefined" v-model="dickersMaxSel.length - item.betting[column].numbers.length" name="data[LotUserJogo][qtdNumeros1]" id="qtdNumeros1" type="text" disabled>
                    			<input v-if="item.betting.length > 0 && dickersExtrasSelect.length > 0 && item.betting[column].numbersExtras != undefined" v-model="dickersExtrasSelect.length - item.betting[column].numbersExtras.length" name="data[LotUserJogo][qtdNumerosd1]" id="qtdNumerosd1" disabled type="text">
                    		</em>
						</div>
					</div>
				</div>
				<div class="col-lg-1 vcenter" style="justify-content: center;" id="btn-add-ticket">
					<a href="#" @click.prevent="addBet($event)" class="fa fa-plus" style="font-size: 60px;"></a>
					<a v-if="columns.length > 1" href="#" @click.prevent="removeBet($event)" class="fa fa-minus" style="font-size: 60px;"></a>
				</div>
			</div>

			<div class="row">

				<div class="col-lg-3 col-sm-3 col-md-3 col-6">
					<div class="form-group">
						<label for="date">{{ trans('strings.sweepstake_date') }}</label>
					    <select v-model="lot_jogo_id" class="form-control" id="lot_jogo_id">
					      	<option :value="sweepstake.id" :data-key="key" v-for="(sweepstake, key) in lottery.sweepstakes">
					      		{{ sweepstake.data_fim }}
					      	</option>
					    </select>
				  	</div>
				</div>
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
	import PlayComponent from './PlayComponent'
	import ResultComponent from './ResultComponent'
	import {mapState, mapGetters} from 'vuex'
	export default {
		activated: function() {

		},
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
		data: function() {
			return {
				loading: {
					component: true
				},
				lottery: {},
				id: '',
				//Dezenas máxima a ser selecionada
				dickersMaxSel: [],
				dickers: [],
				dickersExtras: [],
				dickersExtrasSelect: [],
				columns: [0],
				total: 0.00,
				lot_jogo_id: '',
				item: {
					hash: null,
					id: null,
					value: null,
					name: '',
					date: '',
					betting: [
				 		{
				 			column: 0,
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
			//Funão executada ao carregar
			init: function() {
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
						this.columns = [0];
						this.item.hash = this.makeid(); 
						this.item.id = this.lottery.id;
						this.item.value = this.lottery.value;
						this.item.name = this.lottery.sorteio;
						this.item.betting = [
							{
					 			column: 0,
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
					
					}
				}).catch((error) => {
					
				});
			},
			//Removendo aposta
			removeBet: function(event) {
				//Remove a última coluna
				this.columns.pop();
				//Remove a última aposta
				this.item.betting.pop();

				var betting = this.getBettingFinished();

				this.total = this.item.value * betting.length;

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					value: this.item.value,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					betting: betting
				};
				
				if(item.betting.length == 0) {
					this.$store.dispatch('removeItemLottery', item);
				} else {
					this.$store.dispatch('setItemLottery', item);	
				}
			},
			//Adiciona aposta
			addBet: function(event) {

				//Adicionando uma nova coluna
				this.columns.push(this.columns.length + 1);

				//Adicionando uma nova aposta no array
				this.item.betting.push({
					column: this.columns.length - 1,
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
			clickNumberExtras: function(column, number, event) {
				var btn = $(event.currentTarget);					

				if(btn.hasClass('btn-checked')){
					btn.removeClass('btn-checked');
					this.item.betting[column].numbersExtras = this.item.betting[column].numbersExtras.filter((val) => {
						return val != number;
					});
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.item.betting[column].numbersExtras.length != this.dickersExtrasSelect.length) {
						btn.addClass('btn-checked');
						this.item.betting[column].numbersExtras.push(number);
					}
				}

				//Se o número de dezenas extras selecionada for igual ao número de dezenas extras possíveis
				if(this.item.betting[column].numbersExtras.length == this.dickersExtrasSelect.length) {
					this.item.betting[column].completeExtras = true
				} else {
					this.item.betting[column].completeExtras = false
				}

				
				//Se a aposta foi selecionada
				if(this.item.betting[column].complete === true && this.item.betting[column].completeExtras === true) {
					$('.ticket'+column).addClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				}else {
					$('.ticket'+column).addClass('incomplete');
					$('.ticket'+column).removeClass('complete');
				}	

				if(this.item.betting[column].numbersExtras.length == 0 && this.item.betting[column].numbers.length == 0) {
					$('.ticket'+column).removeClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				}

				//Pegando todas as apostas feitas
				var betting = this.getBettingFinished();
				this.total = this.item.value * betting.length;
			},
			isEnabledDickersExtras: function() {
				if(this.dickersExtrasSelect.length > 0) {
					return true
				}
				return false
			},
			//Função executada ao clicar em algum número da aposta 
			//column significa a aposta clicada
			clickNumber: function(column, number, event) {
				var btn = $(event.currentTarget);
				
				//
				if(btn.hasClass('btn-checked')){
					btn.removeClass('btn-checked');
					this.item.betting[column].numbers = this.item.betting[column].numbers.filter(function(val) {
						return val != number;
					});
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.item.betting[column].numbers.length != this.dickersMaxSel.length) {
						btn.addClass('btn-checked');
						this.item.betting[column].numbers.push(number);
					}
				}


				//Se o usuário selecionou todas as dezenas possíveis
				if(this.item.betting[column].numbers.length == this.dickersMaxSel.length) {
					this.item.betting[column].complete = true
				} else {
					this.item.betting[column].complete = false
				}

				//Verifico se existe dezenas extras,
				//Caso não, faço a verificação somente nas dezenas
				if(this.isEnabledDickersExtras()) {
					if(this.item.betting[column].complete === true && this.item.betting[column].completeExtras === true) {
						$('.ticket'+column).addClass('complete');
						$('.ticket'+column).removeClass('incomplete');
					}else {
						$('.ticket'+column).addClass('incomplete');
						$('.ticket'+column).removeClass('complete');
					}	
				}else{
					if(this.item.betting[column].complete === true) {
						$('.ticket'+column).addClass('complete');
						$('.ticket'+column).removeClass('incomplete');
					}else {
						$('.ticket'+column).addClass('incomplete');
						$('.ticket'+column).removeClass('complete');
					}	
				}


				//Se não tem nenhuma dezena selecionada
				if(this.item.betting[column].numbersExtras.length == 0 && this.item.betting[column].numbers.length == 0) {
					$('.ticket'+column).removeClass('complete');
					$('.ticket'+column).removeClass('incomplete');
				}

				//Pegando apostas concluídas
				var betting = this.getBettingFinished();
				//Atualizando o total
				this.total = this.item.value * betting.length;
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
			selectRandom: function(column, event) {
				//Números randomicos
				var numbersRand = [];

				//Pegando números aleatórios entre as dezenas selecionáveis
				//Por exemplo: 1 até 60
				var dickersLength = this.dickers.length;

				for(var i = 1; i <= this.dickersMaxSel.length; i++) {
					var rand = Math.floor(Math.random()*dickersLength) + 1;
					numbersRand.push(rand);
				}

				this.item.betting[column].numbers = this.removeRepeatedNumbers(numbersRand);
				this.item.betting[column].complete = true;

				$('.ticket'+column).find('button').removeClass('btn-checked');
				
				//Percorrendo os números e adicionando a classe btn-checked
				for(var i = 0; i < numbersRand.length; i++) {
					var btn = $('.ticket'+column+' .tickets-content').find('button')[numbersRand[i] - 1];
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
				
				this.item.betting[column].numbersExtras = this.removeRepeatedNumbers(numbersExtrasRand);
				if(this.isEnabledDickersExtras()) {
					this.item.betting[column].completeExtras = true;
				}

				//Percorrendo os números extras e adicionando a classe btn-checked
				for(var i = 0; i < numbersExtrasRand.length; i++) {
					var btn = $('.ticket'+column+' .tickets-extras').find('button')[numbersExtrasRand[i] - 1];
					$(btn).addClass('btn-checked');
				}
				$('.ticket'+column).removeClass('incomplete');
				$('.ticket'+column).addClass('complete');


				//Pegando todas as apostas feitas
				var betting = this.getBettingFinished();
				
				this.total = this.item.value * betting.length;

			},
			//Pegando todas as apostas concluídas
			getBettingFinished: function() {
				const vm = this
				//Pegando todas as apostas feitas
				var betting = this.item.betting.filter(function(val) {
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
				return betting;
			},
			//Deletando números selecionados na aposta clicada
			//
			deleteNumbersChecked: function(column, event) {
				$('.ticket'+column).find('.btn-checked').removeClass('btn-checked');
				$('.ticket'+column).removeClass('incomplete');
				$('.ticket'+column).removeClass('complete');
				this.item.betting[column].numbers = [];
				this.item.betting[column].numbersExtras = [];
				this.item.betting[column].completeExtras = false;
				this.item.betting[column].complete = false;

				//Pegando todas as apostas feitas
				var betting = this.getBettingFinished();
				
				this.total = this.item.value * betting.length;

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					value: this.item.value,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					betting: betting
				};

				if(item.betting.length === 0) {
					this.$store.dispatch('removeItemLottery', item);
				} else {
					this.$store.dispatch('setItemLottery', item);	
				}
			},
			//Função para adicionar item no carrinho
			addToCart: function(event) {
				var vm = this
				var betting = this.getBettingFinished();

				var item = {
					hash: this.item.hash,
					id: this.item.id,
					value: this.item.value,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					betting: betting
				};

				if(betting.length == 0) {
					alert('Faça pelo menos um jogo');
					//this.$store.dispatch('removeItemLottery', item);
				}else {
					this.$store.dispatch('setItemLottery', item);
					const cartRequest = axios.create();
					cartRequest.interceptors.request.use(config => {
			        	return config;
					});
					cartRequest.post(routes.carts.store, {}, {}).then(response => {
						
					}).catch((error) => {
					
					});
				}
			},
			//Função para remover item do carrinho
			removeToCart: function() {
				var vm = this
				var betting = this.item.betting.filter(function(val) {
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
					value: this.item.value,
					lot_jogo_id: this.lot_jogo_id,
					total: this.total,
					betting: betting
				};
				this.$store.dispatch('removeItemLottery', item);
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
			ResultComponent
		},
		watch: {
			purchase: {
				handler:function (newValue, oldValue) {
			      	
			    },
			    deep:true
			}
		}
	}
</script>

<style scoped>
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

	.btn-default-color {
		background-color: #ffffff;
	    border-color: #00003f;
	    color: #00003f;
	}

	.btn-xs:hover {
		color: #969c9c;
    	text-decoration: none;
	}

	.btn-checked {
	    background-color: #000053 !important;
	    border-color: #000000 !important;
	    color: #ffffff !important;
	}

	.tickets {
		padding: 10px;
	    margin-bottom: 24px;
    	margin-top: 1px;
		background-color: #fff;
	    color: #313534 !important;
	    border-radius: 2px;
	    -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
	    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
	}

	.tickets-footer {
    	margin-top: 10px;
	}

	.tickets-header {
		background-color: #FCF914;
	}

	.tickets-header strong {
		margin-left: 10px;
	}

	.tickets-content, .tickets-extras {
	    background-color: #FCF914;
	    text-align: center;
	    padding-bottom: 5px;
	}

	.price {
		margin-right: 15px;
	}


	.tickets-extras .fields .btn-default-darking{
		margin: 2px;
    	border-color: #000;
    	background-color: #4CAF50;
    }

	.tickets-footer em {
		padding-left: 0px;
	    text-align: center;
	    font-size: 12px;
	    display: block;
	}

	.tickets-footer em input {
	    width: 29px;
	    height: 18px;
	    text-align: center;
	}

	.tools {
		float: right;
	    margin-right: 10px;
	}

	.tools a {
		margin-left: 2px;
	    margin-right: 2px;
	    color: #313534 !important;
	}

	.complete {
		border: 3px solid #67be13 !important;
	}

	.incomplete {
	    border: 3px solid #BF390F !important;
	}
</style>