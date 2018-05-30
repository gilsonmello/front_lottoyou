<template>
	<div class="row">
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu O Pagseguro como forma de pagamento</h4>
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
						<div class="input-group">
							<div class="input-group-addon">@</div>
						    <input type="number" v-model="amount" required class="form-control" id="amount" aria-describedby="amount" :placeholder="'Por favor, indique o valor em USD'" maxlength="5">
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
	export default {
		props: ['order_id'],
		data: function() {
			return {
				amount: '10.00',
				loading: {
					paying: false
				},
				terms: '',
				errors: []
			}
		},
		methods: {
			sendPagseguro: function(event) {
				var form = $(event.currentTarget);
				if(this.validate(this.amount)) {

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
                    itemAmount1.setAttribute('value', this.amount);
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
			        	this.loading.paying = true;
					  	return config;
					});

					paymentRequest.post('/pagseguro/payment', {
						order_id: this.order_id,
						amount: this.amount
					}, {}).then(response => {
						if(response.status === 200) {
							form.submit();
						}
					}).catch((error) => {
						this.loading.paying = false;
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