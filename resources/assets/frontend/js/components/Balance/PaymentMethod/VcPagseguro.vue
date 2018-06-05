<template>
	<vc-load v-if="loading.quotation"></vc-load>
	<div class="row" v-else>
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu o Pagseguro como forma de pagamento</h4>
			<h5>
			</h5>
			<form @submit.prevent="sendPagseguro" id="sendPagseguro" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="post">
				<div class="row">
					<div class="col-lg-12 col-12 col-sm-12 col-md-12">
					    <strong>
					    	<label for="amount">* Quantia a ser depositada &nbsp;
					    	<i class="fa fa-info" title="Mínimo de $15.00"></i>
					    </label>
					    </strong>
					    <input type="text" v-model="amount" required class="form-control" id="amount" :placeholder="'Por favor, indique o valor em USD'">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="checkbox" @click="handleTerms" v-model="terms" required name="terms" id="terms">
						&nbsp;Eu li e aceito os <router-link :to="{ name: 'terms' }" target="_blank">termos e condições</router-link> de uso deste site.
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 buttons">
						<button v-if="loading.paying" @click.prevent="" type="load" class="btn btn-md btn-primary">
							<i class="fa fa-refresh fa-spin"></i>
						</button>
						<button v-else type="submit" class="btn btn-primary btn-md">Efeutuar compra</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	import VcLoad from '../../Load'
	export default {
		components: {
			VcLoad
		},
		props: ['order_id'],
		watch: {
			amount: function(newValue, oldValue) {
				
			}
		},
		data() {
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
		mounted() {
			this.getQuotationDolar();
		},
		methods: {
            setMask() {
                VMasker(document.querySelector("#amount")).maskMoney({
                    // Decimal precision -> "90"
                    precision: 2,
                    // Decimal separator -> ",90"
                    separator: ',',
                    // Number delimiter -> "12.345.678"
                    delimiter: '.',
                    unit: 'R$',
                });
            },
			getQuotationDolar() {
				const quotationDolarRequest = axios.create();
				
				quotationDolarRequest.interceptors.request.use(config => {
					this.loading.quotation = true;
		        	return config;
				});
				let url = "/quotation_dolar";

				quotationDolarRequest.get(url, {}, {

				})
				.then((response) => {

					if(response.status === 200) { 
						this.loading.quotation = false;
						this.quotation = response.data;

						var formatBr = (10 * this.quotation.valores.USD.valor).format(2, true) + '';
						formatBr = formatBr.replace('.', ',');
						this.amount = formatBr;
						
						var vm = this;

						var time = setInterval(() => {
							if($("#amount").length > 0) {
								clearInterval(time);

                                this.setMask();
                                $("#amount").on("blur", function(event) {
                                    let value = $(this).val();
                                    vm.amount = value;
                                    value = value.replace(/\R\$\ /g, '');
                                    value = value.replace(/\./g, '');
                                    value = value.replace(/,/g, '.');
                                    value = parseFloat(value);
                                    if(value < 10) {
                                        formatBr = (10 * vm.quotation.valores.USD.valor).format(2, true) + '';
                                        formatBr = formatBr.replace('.', ',');
                                        $(this).val(VMasker.toMoney(formatBr, {
                                            // Decimal precision -> "90"
                                            precision: 2,
                                            // Decimal separator -> ",90"
                                            separator: ',',
                                            // Number delimiter -> "12.345.678"
                                            delimiter: '.',
                                            unit: 'R$',
                                        }));
                                        vm.amount = VMasker.toMoney(formatBr, {
                                            // Decimal precision -> "90"
                                            precision: 2,
                                            // Decimal separator -> ",90"
                                            separator: ',',
                                            // Number delimiter -> "12.345.678"
                                            delimiter: '.',
                                            unit: 'R$',
                                        });
                                    }
                                });

								/*$("#amount").maskMoney({
									prefix:'R$ ', 
									allowNegative: false, 
									thousands: '.', 
									decimal: ',', 
									affixesStay: false
								}).on("blur", function(event) {
									let value = $(this).val();
									vm.amount = value;
									value = value.replace(/\R\$\ /g, '');
									value = value.replace(/\./g, '');
									value = value.replace(/,/g, '.');
									value = parseFloat(value);				
									
									if(value < 10) {
										formatBr = (10 * vm.quotation.valores.USD.valor).format(2, true) + '';
										formatBr = formatBr.replace('.', ',')
										$(this).val(formatBr);
										vm.amount = formatBr;
									}
							    });*/
							}
						})
						
						
					}
				}).catch((error) => {
					
				});
			},
			handleTerms() {
			},
			getAmount() {
				let value = $("#amount").val();
				value = value.replace(/\R\$\ /g, '');
				value = value.replace(/\./g, '');
				value = value.replace(/,/g, '.');
				return parseFloat(value).format(2, true);
			},
			sendPagseguro: function(event) {
				var form = $(event.currentTarget);
				if(this.validate(this.getAmount())) {
					this.loading.paying = true;
					var form = $('#sendPagseguro');


					var receiverEmail = document.createElement('input');
                    receiverEmail.setAttribute('name', "receiverEmail");
                    receiverEmail.setAttribute('type', "hidden");
                    receiverEmail.setAttribute('value', 'lottoyou.adm@gmail.com');
                    form.append(receiverEmail);

                    var currency = document.createElement('input');
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

                    var itemAmount1 = document.createElement('input');
                    itemAmount1.setAttribute('name', "itemAmount1");
                    itemAmount1.setAttribute('type', "hidden");
                    itemAmount1.setAttribute('value', this.getAmount());
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
                    return1.setAttribute('value', 'http://dev.lottoyou.bet');
                    form.append(return1);

                    var paymentRequest = axios.create();
			        
			        paymentRequest.interceptors.request.use(config => {
			        	return config;
					});

					paymentRequest.post('/pagseguro/payment', {
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
					  	title: "Informe um valor maior do que R$10.00",
		                type: "error",
		                html: true,
		                showCancelButton: false,
		                confirmButtonColor: "#00a65a",
		                confirmButtonText: "Confirmar",
		                closeOnConfirm: false,
		                showLoaderOnConfirm: false
					}, function(inputValue){
					  	
					});
				}
			},
			validate: function(amount) {
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