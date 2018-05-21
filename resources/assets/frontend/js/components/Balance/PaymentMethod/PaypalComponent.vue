<template>
	<div class="row">
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu Paypal como forma de pagamento</h4>
			<h5>
			</h5>
			<form @submit.prevent="sendPaypal" id="sendPaypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<div class="row">
					<div class="col-lg-12 col-12 col-sm-12 col-md-12">
					    <strong>
					    	<label for="amount">* Quantia a ser depositada &nbsp;
					    	<i class="fa fa-info" title="Mínimo de $15.00"></i>
					    </label>
					    </strong>
						<div class="input-group">
							<div class="input-group-addon">@</div>
						    <input type="number" v-model="paypal.amount_1" required class="form-control" id="amount" aria-describedby="amount" :placeholder="'Por favor, indique o valor em USD'" maxlength="5">
					  	</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="checkbox" v-model="terms" required name="terms" id="terms">
						&nbsp;Eu li e aceito os <router-link :to="{ name: 'terms.index' }" target="_blank">termos e condições</router-link> de uso deste site.                    
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
	export default {
		data: function() {
			return {
				amount: '',
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
		methods: {
			sendPaypal: function(event) {
				var form = $(event.currentTarget);
				if(this.validate(this.paypal)) {

					var form = $('#sendPaypal');

					var rm = document.createElement('input');
                    rm.setAttribute('name', "rm");
                    rm.setAttribute('type', "hidden");
                    rm.setAttribute('value', 2);
                    form.append(rm);

					var cmd = document.createElement('input');
                    cmd.setAttribute('name', "cmd");
                    cmd.setAttribute('type', "hidden");
                    cmd.setAttribute('value', '_xclick');
                    form.append(cmd);

                    var invoice = document.createElement('input');
                    invoice.setAttribute('name', "invoice");
                    invoice.setAttribute('type', "hidden");
                    invoice.setAttribute('value', 1);
                    form.append(invoice);

                    var upload = document.createElement('input');
                    upload.setAttribute('name', "upload");
                    upload.setAttribute('type', "hidden");
                    upload.setAttribute('value', 1);
                    form.append(business);

                    var business = document.createElement('input');
                    business.setAttribute('name', "business");
                    business.setAttribute('type', "hidden");
                    business.setAttribute('value', 'lottoyou.adm-facilitator@gmail.com');
                    form.append(business);

                    var return1 = document.createElement('input');
                    return1.setAttribute('name', "return");
                    return1.setAttribute('type', "hidden");
                    return1.setAttribute('value', 'http://dev.lottoyou.bet');
                    form.append(return1);

                    var cancel = document.createElement('input');
                    cancel.setAttribute('name', "cancel");
                    cancel.setAttribute('type', "hidden");
                    cancel.setAttribute('value', 'http://dev.lottoyou.bet/cancel');
                    form.append(cancel);

                    var notify_url = document.createElement('input');
                    notify_url.setAttribute('name', "notify_url");
                    notify_url.setAttribute('type', "hidden");
                    notify_url.setAttribute('value', 'http://dev.lottoyou.bet/paypal/feedback');
                    form.append(notify_url);

                    var charset = document.createElement('input');
                    charset.setAttribute('name', "charset");
                    charset.setAttribute('type', "hidden");
                    charset.setAttribute('value', 'utf-8');
                    form.append(charset);

                    var lc = document.createElement('input');
                    lc.setAttribute('name', "lc");
                    lc.setAttribute('type', "hidden");
                    lc.setAttribute('value', 'en_US');
                    form.append(lc);

                    var country_code = document.createElement('input');
                    country_code.setAttribute('name', "country_code");
                    country_code.setAttribute('type', "hidden");
                    country_code.setAttribute('value', 'US');
                    form.append(country_code);

                    var currency_code = document.createElement('input');
                    currency_code.setAttribute('name', "currency_code");
                    currency_code.setAttribute('type', "hidden");
                    currency_code.setAttribute('value', 'USD');
                    form.append(currency_code);

                    var amount = document.createElement('input');
                    amount.setAttribute('name', "amount");
                    amount.setAttribute('type', "hidden");
                    amount.setAttribute('value', parseFloat(this.paypal.amount_1).format(2, true));
                    form.append(amount);

                    var item_name = document.createElement('input');
                    item_name.setAttribute('name', "item_name");
                    item_name.setAttribute('type', "hidden");
                    item_name.setAttribute('value', 'transference');
                    form.append(item_name);

                    var quantity = document.createElement('input');
                    quantity.setAttribute('name', "quantity");
                    quantity.setAttribute('type', "hidden");
                    quantity.setAttribute('value', 1);
                    form.append(quantity);

                    setTimeout(() => {

                    	form.submit();
                    }, 2000);

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
					  	title: "Informe um valor maior do que $10.00",
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
			validate: function(data) {
				if(data.amount_1 >= 10.00) {
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