<template>
	<div class="row">
		<div class="col-lg-12">
			<h6 class="choice-payment-method-msg"><strong>Você escolheu o Paypal como forma de pagamento</strong></h6>
			<h5>
			</h5>
			<form @submit.prevent="sendPaypal" id="sendPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<div class="row">
					<div class="col-lg-12 col-12 col-sm-12 col-md-12">
					    <strong>
					    	<label for="amount">* Quantia a ser depositada &nbsp;
					    	<i class="fa fa-info" :title="'Mínimo de '+getSystemCurrency.data.symbol+'10.00'"></i>
					    </label>
					    </strong>
					    <input type="text" ref="fieldAmount" @blur="fieldAmountBlur($event)" required class="form-control" placeholder="Por favor, indique o valor">
					</div>
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
		props: ['order_id'],
		data () {
			return {
				amount: '10.00',
				loading: {
					paying: false
				},
				terms: '',
				paypal: {
					cmd: '_xclick',
					upload: '1',
					business: 'lottoyou.adm@gmail.com',
					item_name_1: 'transference',
					amount_1: 10.00,
					quantity_1: 1,
					custom: '',
					notify_url: '',
					return: 'http://lottoyou.bet/return/paypal',
					rm: '2',
					cbt: 'Retorno para a loja',
					cancel_return: 'http://lottoyou.bet/return/cancel',
					lc: 'BR',
					currency_code: 'BRL'
				},
				errors: []
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
			getAmount () {
				let value = this.$refs.fieldAmount.value;
				value = value.replace('R$', '');
				value = value.replace(' ', '');
				value = value.replace('.', '');
				value = value.replace(',', '.');
				return parseFloat(value).format(2, true);
			},
			sendPaypal (event) {
				if(this.validate(this.getAmount())) {
					this.loading.paying = true;
					
					let form = $(event.currentTarget);

					let rm = document.createElement('input');
                    rm.setAttribute('name', "rm");
                    rm.setAttribute('type', "hidden");
                    rm.setAttribute('value', 2);
                    form.append(rm);

					let cmd = document.createElement('input');
                    cmd.setAttribute('name', "cmd");
                    cmd.setAttribute('type', "hidden");
                    cmd.setAttribute('value', '_xclick');
                    form.append(cmd);

                    let invoice = document.createElement('input');
                    invoice.setAttribute('name', "invoice");
                    invoice.setAttribute('type', "hidden");
                    invoice.setAttribute('value', this.order_id);
                    form.append(invoice);

                    let upload = document.createElement('input');
                    upload.setAttribute('name', "upload");
                    upload.setAttribute('type', "hidden");
                    upload.setAttribute('value', '1');
                    form.append(upload);

                    let business = document.createElement('input');
                    business.setAttribute('name', "business");
                    business.setAttribute('type', "hidden");
                    business.setAttribute('value', 'lottoyou.adm@gmail.com');
                    form.append(business);

                    let return1 = document.createElement('input');
                    return1.setAttribute('name', "return");
                    return1.setAttribute('type', "hidden");
                    return1.setAttribute('value', routes.base);
                    form.append(return1);

                    let cancel = document.createElement('input');
                    cancel.setAttribute('name', "cancel");
                    cancel.setAttribute('type', "hidden");
                    cancel.setAttribute('value', routes.base);
                    form.append(cancel);

                    let notify_url = document.createElement('input');
                    notify_url.setAttribute('name', "notify_url");
                    notify_url.setAttribute('type', "hidden");
                    notify_url.setAttribute('value', routes.paypal.feedback);
                    form.append(notify_url);

                    let charset = document.createElement('input');
                    charset.setAttribute('name', "charset");
                    charset.setAttribute('type', "hidden");
                    charset.setAttribute('value', 'utf-8');
                    form.append(charset);

                    let lc = document.createElement('input');
                    lc.setAttribute('name', "lc");
                    lc.setAttribute('type', "hidden");
                    lc.setAttribute('value', 'pt_BR');
                    form.append(lc);

                    let country_code = document.createElement('input');
                    country_code.setAttribute('name', "country_code");
                    country_code.setAttribute('type', "hidden");
                    country_code.setAttribute('value', 'BR');
                    form.append(country_code);

                    let currency_code = document.createElement('input');
                    currency_code.setAttribute('name', "currency_code");
                    currency_code.setAttribute('type', "hidden");
                    currency_code.setAttribute('value', 'BRL');
                    form.append(currency_code);

                    let amount = document.createElement('input');
                    amount.setAttribute('name', "amount");
                    amount.setAttribute('type', "hidden");
                    amount.setAttribute('value', this.getAmount());
                    form.append(amount);

                    let item_name = document.createElement('input');
                    item_name.setAttribute('name', "item_name");
                    item_name.setAttribute('type', "hidden");
                    item_name.setAttribute('value', 'Deposit '+this.order_id);
                    form.append(item_name);

                    let quantity = document.createElement('input');
                    quantity.setAttribute('name', "quantity");
                    quantity.setAttribute('type', "hidden");
                    quantity.setAttribute('value', 1);
                    form.append(quantity);

                    let paymentRequest = axios.create();
			        
			        paymentRequest.interceptors.request.use(config => {
			        	return config;
					});

					paymentRequest.post(routes.paypal.payment, {
						order_id: this.order_id,
						amount: this.getAmount()
					}, {}).then(response => {
						if(response.status === 200) {
							form.submit();
						}
					}).catch((error) => {
						this.loading.paying = false;
						$('[name="rm"]').remove();
						$('[name="cmd"]').remove();
						$('[name="invoice"]').remove();
						$('[name="upload"]').remove();
						$('[name="business"]').remove();
						$('[name="return"]').remove();
						$('[name="cancel"]').remove();
						$('[name="notify_url"]').remove();
						$('[name="charset"]').remove();
						$('[name="lc"]').remove();
						$('[name="country_code"]').remove();
						$('[name="currency_code"]').remove();
						$('[name="amount"]').remove();
						$('[name="item_name"]').remove();
						$('[name="quantity"]').remove();
					});

                
                    

					/*var paymentRequest = axios.create();
			        
			        paymentRequest.interceptors.request.use(config => {
			        	$(this.$el).find('[type="load"]').removeClass('hide');
			        	$(this.$el).find('[type="submit"]').addClass('hide');
					  	return config;
					});

					var url = '?cmd='+this.paypal.cmd;
					url += '&cmd='+this.paypal.cmd;

					paymentRequest.post('https://www.sandbox.paypal.com/cgi-bin/webscr', {
						cmd: this.paypal.cmd,
						upload: this.paypal.upload,
						business: this.paypal.business,
						item_name_1: this.paypal.item_name_1,
						amount_1: this.paypal.amount_1,
						quantity_1: this.paypal.quantity_1,
						custom: this.paypal.custom,
						notify_url: this.paypal.notify_url,
						return: this.paypal.return,
						rm: this.paypal.rm,
						cbt: this.paypal.cbt,
						cancel_return: this.paypal.cancel_return,
						lc: 'US',
						currency_code: 'USD'
					}, {}).then(response => {
						if(response.status === 200){

						}
					}).catch((error) => {
						$(this.$el).find('[type="load"]').addClass('hide');
	        			$(this.$el).find('[type="submit"]').removeClass('hide');
						this.errors = {
							credentials: 'Usuário ou Senha inválidos'
						};
					});*/

				} else {
					swal({
					  	title: 'Informe um valor maior do que '+this.getSystemCurrency.data.symbol+'10.00',
		                //type: "error",
						showCloseButton: true,
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