<template>
	<div class="container">
		<h1 class="page-header">Depositar fundos</h1>
		<div class="row">
			<div class="col-lg-10 col-12 col-md-8 col-sm-12">
				<h5 style="margin-bottom: 25px;">
					Deposite para começar a jogar Keno, as suas loterias favoritas e jogos.
				</h5>
				<h4 class="choice-payment-method-msg">
					Por favor escolha o seu método de pagamento:
				</h4>
				<div class="row box-payment-method">
					<div class="col-lg-2 col-6 col-md-2 col-sm-4">
						<a @click.prevent="changePaymentMethod('paypal', $event)" href="#" class="payment-method">
							<img class="img-fluid" src="/img/pagseguro.png">
							<!-- <span class="payment-method-name">Paypal</span> -->
						</a>
					</div>
					<div class="col-lg-2 col-6 col-md-2 col-sm-4">
						<a @click.prevent="changePaymentMethod('pagseguro', $event)" href="#" class="payment-method">
							<img class="img-fluid" src="/img/paypal.png">
							<!-- <span class="payment-method-name">Pagseguro</span> -->
						</a>
					</div>
				</div>
				<div class="row box-actions-payment">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<paypal-component :order_id="order_id" v-if="payment_method == 'paypal' "></paypal-component>
						<vc-pagseguro :order_id="order_id" v-else-if=" payment_method == 'pagseguro' "></vc-pagseguro>
					</div>
				</div>
			</div>
			<!-- <div class="col-lg-2 col-12 col-md-4 col-sm-12 text-center">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<a href="https://www.grandesloterias.com/pt/support-and-service-excellence.html"><img border="0" alt="atendimendo ao cliente, Grandesloterias.com, loteria" src="https://www.grandesloterias.com/images/banners/grandesloterias_com/customer_support_stamp_-_pt/160x148-_portuguese.jpg"></a>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<a target="_blank" href="http://www.webutation.net/go/review/grandesloterias.com"><img border="0" alt="Webutation, GrandesLoterias" src="https://www.grandesloterias.com/images/banners/grandesloterias_com/__webutation_grandesloterias_pt/160x148-_160x148-grandesloterias_es_webutation.jpg"></a>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<a href="https://www.grandesloterias.com/pt/deposit/funds.html"><img border="0" alt="Boleto, Grandes loterias, método de pagamento" src="https://www.grandesloterias.com/images/banners/grandesloterias_com/boleto_bancario/160x300-_boletobancario-160x300.gif"></a>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<a href="https://www.grandesloterias.com/pt/tell-a-friend.html"><img border="0" alt="indique um amigo, Grandesloterias.com, loterias" src="https://www.grandesloterias.com/images/banners/grandesloterias_com/tell_a_friend_portuguese/160x300-_tell-afriend-banner-pt.gif"></a>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<a href="https://www.grandesloterias.com/pt/lottery-horoscope.html">
						<img border="0" alt="Horóscopo para loteria, números da sorte" src="https://www.grandesloterias.com/images/banners/grandesloterias_com/hor__scopo_para_loteria__portugu__s_/160x300-_new-horoscope-160x300-pt.gif"></a>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</template>

<script>
	import {mapState, mapGetters} from 'vuex'
	import VcPagseguro from './PaymentMethod/VcPagseguro'
	import PaypalComponent from './PaymentMethod/PaypalComponent'
	export default {
		methods: {
			changePaymentMethod: function(payment_method, el) {
				$('.box-payment-method').find('.active').removeClass('active');
				var parent = $(el.target).parent();
				parent.addClass('active');
				this.payment_method = payment_method
			}
		},
		computed: {
            ...mapGetters([
                'auth', 'purchase'
            ])
		},
		data: function() {
			return {
				payment_method: '',
				order_id: '',
			}
		},
		mounted() {
			const orderRequest = axios.create();
			orderRequest.interceptors.request.use(config => {
	        	return config;
			});
			let url = "/pagseguro/generate_order";

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
				}
			}).catch((error) => {
				
			});
		},
		components: {
			PaypalComponent,
			VcPagseguro
		}
	}
</script>

<style scoped>
	
	.box-payment-method {
		transition: 1s background-color;
		background: #F7F7F7;
	    margin: 15px 0!important;
	    border-radius: 5px;
	    border: 1px solid #E2E2E2;
	    border-bottom: #E2E2E2 1px solid!important;
	    padding: 15px 0 10px;
	}

	.box-payment-method .active {
		transition: 1s background-color;
	    border: 1px solid;
	}

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

	.payment-method {
		display: inline-block;
		text-decoration: none;
	}

	.payment-method img {
		display: block;
		height: 100%;
		width: 100%;
	}

	.payment-method .payment-method-name {
		display: block;
		text-align: center;
		color: #666;
	}
</style>