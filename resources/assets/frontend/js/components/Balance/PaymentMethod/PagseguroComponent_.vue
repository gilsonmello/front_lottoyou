<template>
	<load v-if="loading.component == true"></load>
	<div class="row" v-else>
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu Pagseguro como forma de pagamento</h4>
			<div class="row">
				<div class="col-lg-12 col-12 col-sm-12 col-md-12">
				    <strong>
				    	<label for="amount">* Quantia a ser depositada &nbsp;
				    	<i class="fa fa-info" title="Mínimo de $15.00"></i>
				    </label>
				    </strong>
					<div class="input-group">
						<div class="input-group-addon">@</div>
					    <input type="number" v-model="amount" required class="form-control" id="amount" aria-describedby="amount" :placeholder="'Por favor, indique o valor'" maxlength="5">
				  	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<input type="checkbox" v-model="terms" required name="terms" id="terms">
					&nbsp;Eu li e aceito os <router-link :to="{ name: 'terms' }" target="_blank">termos e condições</router-link> de uso deste site.
				</div>
			</div>

			<hr>
			<form @submit.prevent="payment($event)" id="payment-pagseguro">
				<div class="row">
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_name" :placeholder="trans('strings.card_name')">
								{{ trans('strings.card_name') }}
							</label>
							<input name="card_name" type="text" v-model="card_name" class="form-control">
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_personal_id" :placeholder="trans('strings.card_personal_id')">
								{{ trans('strings.card_personal_id') }}
							</label>
							<inputmask id="card_personal_id" name="card_personal_id" v-on:onblur="cardPersonal" :mask="'999.999.999-99'" :greedy="false" v-model="card_personal_id"></inputmask>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_birth_date" :placeholder="trans('strings.card_birth_date')">
								{{ trans('strings.card_birth_date') }}
							</label>
							<datepicker name="card_birth_date" v-model="card_birth_date" :options="{}"></datepicker>
						</div>
					</div>
				</div>

				<div class="row" style="align-items: flex-end">
					<div class="col-lg-6 col-12">
						<div class="row">
							<div class="col-lg-10" style="padding-right: 0;">
								<div class="form-group">
									<label for="card_number" :placeholder="trans('strings.card_number')">
										{{ trans('strings.card_number') }}
									</label>
									<inputmask name="card_number" v-on:onblur="cardNumberBlur" :blur="true" v-model="card_number" :mask="'9'" :repeat="20" :greedy="false" :rightAlign="false"> 
									</inputmask>
								</div>
							</div>
							<div class="col-lg-2" style="padding-left: 0; padding-right: 30px;">
								<div class="form-group">
									<label>
										&nbsp;
									</label>
									<span class="input-group-addon fa fa-credit-card-alt"></span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_month" :placeholder="trans('strings.card_month')">
								{{ trans('strings.card_month') }}
							</label>
							<inputmask id="card_month" name="card_month" :mask="'99'" v-model="card_month"></inputmask>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_year" :placeholder="trans('strings.card_year')">
								{{ trans('strings.card_year') }}
							</label>
							<inputmask name="card_year" :mask="'9999'" v-model="card_year"></inputmask>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_cvv" :placeholder="trans('strings.card_cvv')">
								{{ trans('strings.card_cvv') }}
							</label>
							<inputmask name="card_cvv" :mask="'999'" v-model="card_cvv"></inputmask>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12 buttons">
						<button type="submit" class="btn btn-success">Efeutuar compra</button>
						<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-success">
							<i class="fa fa-refresh fa-spin"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	import {mapState, mapGetters} from 'vuex'
	import {routes} from '../../../api_routes'
	export default {
		props: ['order_id'],
		computed: {
            ...mapGetters([
                'auth', 'purchase'
            ])
		},
		data: function() {
			return {
				amount: '',
				terms: '',
				loading: {
					component: true,
				},
				session_id: '',
				card_name: '',
				card_personal_id: '',
				card_birth_date: '',
				card_number: '',
				card_month: '',
				card_year: '',
				card_cvv: '',
				card_brand: '',
				card_token: '',
				sender_hash: '',
				method: 'creditCard',
				quotation: {},
				query: {
					page: 1,
					column: 'pontuacao',
					direction: 'desc',
					nickname: '',
					valor: '',
					data_termino: '',
				}
			}
		},
		methods: {
			getQuotationDolar() {
				const paymentRequest = axios.create();
				paymentRequest.interceptors.request.use(config => {
		        	return config;
				});
				let url = "http://api.promasters.net.br/cotacao/v1/valores";

				paymentRequest.get(url)
				.then((response) => {
					if(response.status === 200) { 
						this.quotation = response.data;
					}
				}).catch((error) => {
					
				});
			},
			cardPersonal() {
				if(!this.validateCPF(this.card_personal_id)) {
					swal({
						title: "CPF",
						text: 'Por favor, informe um CPF válido',
		                imageUrl: '/imgs/logo.png',
						imageHeight: 50,
						imageAlt: 'Logo lottoyou',
		                showCancelButton: false,
		                confirmButtonColor: "#00a65a",
		                confirmButtonText: "Confirmar",
		                closeOnConfirm: false,
		                showLoaderOnConfirm: false
					}, (inputValue) => {
					  	
					});
					$('#card_personal_id').val('')
					this.card_personal_id = '';
				}
			},
			payment(event) {
				if($("#payment-pagseguro").valid()) {
					this.setCardToken();
			        this.setSenderHash();
			    }
			},
			executePayment() {
				const paymentRequest = axios.create();
				paymentRequest.interceptors.request.use(config => {
		        	return config;
				});
				let url = "/pagseguro/payment";

				paymentRequest.post(url, {
					amount: this.amount,
					owner_id: this.auth.id,
					session_id: '',
					card_name: this.card_name,
					card_personal_id: this.card_personal_id,
					card_birth_date: this.card_birth_date,
					card_number: this.card_number,
					card_month: this.card_month,
					card_year: this.card_year,
					card_cvv: this.card_cvv,
					card_brand: this.card_brand,
					card_token: this.card_token,
					sender_hash: this.sender_hash,
					method: this.method,
					order_id: this.order_id,
				}, {}).then(response => {
					if(response.status === 200) {
						swal({
						  	title: "Pedido efeituado",
			                type: "success",
			                text: 'Confirme para redirecionar à página do cliente',
			                html: true,
			                showCancelButton: false,
			                confirmButtonColor: "#00a65a",
			                confirmButtonText: "Confirmar",
			                closeOnConfirm: false,
			                showLoaderOnConfirm: false
						}, function(inputValue){
						  	
						});
					}
				}).catch((error) => {
					
				});
			},
			setCardToken() {
				if(this.card_token == '') {
				    var parametros = {
				        cardNumber: this.card_number,
				        brand: this.card_brand,
				        cvv: this.card_cvv,
				        expirationMonth: this.card_month,
				        expirationYear: this.card_year,
				        success: (data) => {
				            this.card_token = data.card.token;
							
							if(this.card_token != '') {
				            	console.log(this.card_token);
				            }
				        },
				        error: (data) => {
			        		window.console.log(data);
				        },
				        complete: (data) => {
				        	this.executePayment();
				        }
				    };
			    	PagSeguroDirectPayment.createCardToken(parametros);
				} else {
					this.executePayment();
				}
			},
			setSenderHash() {
				if(this.sender_hash == '') {
					this.sender_hash = PagSeguroDirectPayment.getSenderHash();
				}
			},
			cardNumberBlur(event) {
				var vm = this;
				if(vm.card_number != ''){
					PagSeguroDirectPayment.getBrand({
		                cardBin: vm.card_number.replace(/ /g, ''),
		                success: function (data) {
		                    vm.card_brand = data.brand.name
		                    $(vm.$el)
		                    	.find('.fa-credit-card-alt')
		                    	.removeClass('fa-credit-card-alt')
		                    	.addClass('fa-cc-' + vm.card_brand);
						},
		                error: function (data, error, other) {
		                    
		                },
		                complete: function(data) {
		                	
		                }
		            });
				}
			},
			validatePayment() {
				$('#payment-pagseguro').validate({
					rules: {
						card_name: {
							required: true
						},
						card_personal_id: {
							required: true/*,
							isCPF: true*/
						},
						card_birth_date:{
							required: true
						},
						card_number: {
							required: true
						},
						card_month: {
							required: true,
							minlength: 2,
							maxlength: 2,
						},
						card_year: {
							required: true,
							minlength: 4
						},
						card_cvv: {
							required: true,
							minlength: 3
						}
					},
					messages: {
						card_name: {
							required: 'Campo obrigatório'
						},
						card_personal_id: {
							required: 'Campo obrigatório'/*,
							isCPF: 'CPF Inválido'*/
						},
						card_birth_date:{
							required: 'Campo obrigatório'
						},
						card_number: {
							required: 'Campo obrigatório'
						},
						card_month: {
							required: 'Campo obrigatório',
							minlength: 'Tamanho mínimo de 2 digitos'
						},
						card_year: {
							required: 'Campo obrigatório',
							minlength: 'Tamanho mínimo de 4 digitos'
						},
						card_cvv: {
							required: 'Campo obrigatório',
							minlength: 'Tamanho mínimo de 3 digitos'
						},
					}
				});
			}
		},
		mounted() {
			$.ajaxSetup({
			  	cache: true
			});

			$.getScript("https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js", function( data, textStatus, jqxhr ) {
			});

			const sessionRequest = axios.create();
			sessionRequest.interceptors.request.use(config => {
	        	return config;
			});
			let url = "/pagseguro/get_session_id";

			sessionRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.session_id = response.data.id
					PagSeguroDirectPayment.setSessionId(this.session_id);
				}
			}).catch((error) => {
				
			});


			const orderRequest = axios.create();
			orderRequest.interceptors.request.use(config => {
	        	return config;
			});
			url = "/pagseguro/generate_order";

			orderRequest.post(
				url, 
				{
					owner_id: this.auth.id
				}, 
				{

				}
			).then(response => {
				if(response.status === 200){
					this.order_id = response.data
					this.loading.component = false

					var time = setInterval(() => {
						if($('#payment-pagseguro').length > 0) {
							clearInterval(time);
							this.validatePayment();
						}
					})
				}
			}).catch((error) => {
				
			});

		},
		beforeDestroy() {
			$.ajaxSetup({
			  	cache: false
			});
		},
		components: {
		}
	}
</script>

<style scoped>
	.choice-payment-method-msg {
	    background-color: #EFEFEF;
	    padding: 15px;
	    font-size: 17px;
	    display: inline-block;
	    width: 100%;
	    -webkit-transition: background-color 0.5s ease;
	    -moz-transition: background-color 0.5s ease;
	    -o-transition: background-color 0.5s ease;
	    transition: background-color 0.5s ease;
	}

	.buttons {
		margin: 15px auto;
	}

	.input-group {
		display: flex;
	}
</style>