<template>
	<load v-if="loading.quotation" />
	<div class="row" v-else>
		<div class="col-lg-12">
			<h6 class="choice-payment-method-msg"><strong>Você escolheu o Pagseguro como forma de pagamento (Válido só no Brasil)</strong></h6>
			<h5>
			</h5>
			<form @submit.prevent="sendPagseguro" id="sendPagseguro" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post">
                <div class="row">
                    <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                        <strong>
                            <label for="amount">* Quantia a ser depositada &nbsp;
                                <i class="fa fa-info" :title="'Mínimo de '+getSystemCurrency.data.symbol+'10.00'"></i>
                            </label>
                        </strong>
                    </div>
                </div>
                <div class="row">
					<div class="col-lg-4 col-12 col-sm-4 col-md-4">
					    <input type="text" ref="fieldAmount" @blur="fieldAmountBlur($event)" required class="form-control" id="amount" placeholder="Por favor, indique o valor">
					</div>
					<!-- <div class="col-lg-8 col-sm-8 col-md-8 col-12">
						<h6 v-if="quotation.results">Você será direcionado a uma página no Brasil para realizar o pagamento em reais.<br>
							Dólar comercial: {{ parseFloat(quotation.results.currencies.USD.buy).format(2, true) }}
						</h6>
					</div> -->
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="checkbox" v-model="terms" required name="terms" id="terms">
						&nbsp;Eu li e aceito os <router-link :to="{ name: 'terms' }" target="_blank">termos e condições</router-link> de uso deste site.
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 buttons">
						<button v-if="loading.paying" @click.prevent="" type="load" class="btn btn-md btn-primary">
							<i class="fa fa-refresh fa-spin"></i>
						</button>
						<button v-else type="submit" class="btn btn-primary btn-md">Efetuar compra</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	import { routes } from '../../../api_routes';
	import { mapGetters } from 'vuex';
	export default {
		computed: {
			...mapGetters([
            	'getSystemCurrency'
        	]),
		},
		components: {
			
		},
		props: ['order_id'],
		watch: {
		},
		data () {
			return {
				amount: '',
				loading: {
					paying: false,
					quotation: false,
				},
				terms: '',
				errors: [],
				quotation: {},
			}
		},
		mounted () {
			this.setMaskFieldAmount();
		},
		methods: {
			fieldAmountBlur (event) {
				if(this.getAmount() < 10) {
					this.$refs.fieldAmount.value = VMasker.toMoney('10.00', {
                        // Decimal precision -> "90"
						precision: 2,
						// Decimal separator -> ",90"
						separator: ',',
						// Number delimiter -> "12.345.678"
						delimiter: '.',
						unit: this.getSystemCurrency.data.symbol,
                    });
                }
			},
            setMaskFieldAmount () {
				VMasker(this.$refs.fieldAmount).maskMoney({
                    // Decimal precision -> "90"
					precision: 2,
					// Decimal separator -> ",90"
					separator: ',',
					// Number delimiter -> "12.345.678"
					delimiter: '.',
                    unit: this.getSystemCurrency.data.symbol,
                });
            },
			getQuotationDolar () {
				let _self = this;
				const quotationDolarRequest = axios.create();
				
				quotationDolarRequest.interceptors.request.use(config => {
					this.loading.quotation = true;
		        	return config;
				});
				
				let url = routes.quotation_dolar;

				quotationDolarRequest.get(url, {}, {

				})
				.then((response) => {
					if(response.status === 200) { 
						this.loading.quotation = false;
						this.quotation = response.data;

						//var formatBr = (10 * this.quotation.results.currencies.USD.buy).format(2, true) + '';
						//formatBr = formatBr.replace('.', ',');
						//this.amount = formatBr;
											
						
					}
				}).catch((error) => {
					
				});
			},
			handleTerms () {
                console.log('sad')
			},
			getAmount () {
				let value = $("#amount").val();
				value = value.replace('R$', '');
				value = value.replace(' ', '');
				value = value.replace('.', '');
				value = value.replace(',', '.');
				return parseFloat(value).format(2, true);
			},
			sendPagseguro (event) {
				if(this.validate(this.getAmount())) {
					this.loading.paying = true;
					let form = $(event.currentTarget);

					let receiverEmail = document.createElement('input');
                    receiverEmail.setAttribute('name', "receiverEmail");
                    receiverEmail.setAttribute('type', "hidden");
                    receiverEmail.setAttribute('value', 'lottoyou.adm@gmail.com');
                    form.append(receiverEmail);

                    let currency = document.createElement('input');
                    currency.setAttribute('name', "currency");
                    currency.setAttribute('type', "hidden");
                    currency.setAttribute('value', 'BRL');
                    form.append(currency);

					var itemId1 = document.createElement('input');
                    itemId1.setAttribute('name', "itemId1");
                    itemId1.setAttribute('type', "hidden");
                    itemId1.setAttribute('value', this.order_id);
                    form.append(itemId1);

                    var itemDescription1 = document.createElement('input');
                    itemDescription1.setAttribute('name', "itemDescription1");
                    itemDescription1.setAttribute('type', "hidden");
                    itemDescription1.setAttribute('value', 'Deposit '+this.order_id);
                    form.append(itemDescription1);

					console.log(this.getAmount())
                    var itemAmount1 = document.createElement('input');
                    itemAmount1.setAttribute('name', "itemAmount1");
                    itemAmount1.setAttribute('type', "hidden");
					itemAmount1.setAttribute('value', this.getAmount());
					//Linha comentada para remover a multiplicação do valor pela cotação do dolar
					//itemAmount1.setAttribute('value', (this.getAmount() * this.quotation.results.currencies.USD.buy).format(2, true));
                    form.append(itemAmount1);

                    var itemQuantity1 = document.createElement('input');
                    itemQuantity1.setAttribute('name', "itemQuantity1");
                    itemQuantity1.setAttribute('type', "hidden");
                    itemQuantity1.setAttribute('value', 1);
                    form.append(itemQuantity1);

                    var reference = document.createElement('input');
                    reference.setAttribute('name', "reference");
                    reference.setAttribute('type', "hidden");
                    reference.setAttribute('value', this.order_id);
                    form.append(reference);

                    var return1 = document.createElement('input');
                    return1.setAttribute('name', "return");
                    return1.setAttribute('type', "hidden");
                    return1.setAttribute('value', routes.base);
                    form.append(return1);

                    var paymentRequest = axios.create();
			        
			        paymentRequest.interceptors.request.use(config => {
			        	return config;
					});

					paymentRequest.post(routes.pagseguro.payment, {
						order_id: this.order_id,
						amount: this.getAmount()
					}, {}).then(response => {
						if(response.status === 200) {
							form.submit();
						}
					}).catch((error) => {
						this.loading.paying = false;
						$('[name="receiverEmail"]').remove();
						$('[name="currency"]').remove();
						$('[name="itemId1"]').remove();
						$('[name="itemDescription1"]').remove();
						$('[name="itemAmount1"]').remove();
						$('[name="itemQuantity1"]').remove();
						$('[name="reference"]').remove();
						$('[name="return"]').remove();    
					});

				} else {
					swal({
						title: 'Informe um valor maior do que '+this.getSystemCurrency.data.symbol+'10.00',
						showCloseButton: true,
						imageUrl: '/imgs/logo.png',
						imageHeight: 50,
						imageAlt: 'Logo lottoyou',
		                showCancelButton: false,
		                confirmButtonColor: "#00a65a",
		                confirmButtonText: "Confirmar",
		                closeOnConfirm: false,
		                showLoaderOnConfirm: false
					}, function(inputValue){
					  	
					});
				}
			},
			validate (amount) {
				if(amount >= 10.00) {
					return true;
				}
				return false;
			}
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