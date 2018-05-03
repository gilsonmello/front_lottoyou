<template>
	<div class="row">
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu Paypal como forma de pagamento</h4>
			<h5>
			</h5>
			<form @submit.prevent="sendPaypal">
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
					cmd: '_cart',
					upload: '1',
					business: 'teste@lottoyou.bet',
					item_name_1: 'teste',
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
					var loginRequest = axios.create();
			        loginRequest.interceptors.request.use(config => {
			        	$(this.$el).find('[type="load"]').removeClass('hide');
			        	$(this.$el).find('[type="submit"]').addClass('hide');
					  	return config;
					});

					loginRequest.post(routes.auth.login, qs.stringify(data)).then(response => {
						if(response.status === 200){

						}
					}).catch((error) => {
						$(this.$el).find('[type="load"]').addClass('hide');
	        			$(this.$el).find('[type="submit"]').removeClass('hide');
						this.errors = {
							credentials: 'Usuário ou Senha inválidos'
						};
					});
				}else{
					alert('Valor Mínimo para transferência é de $10.00')
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
</style>