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
		color:#666;
	}
</style>

<template>
    <vc-load v-if="loading.component"></vc-load>
    <div class="container" v-else>
		  <h1 class="page-header">{{trans('strings.withdraw')}} {{trans('strings.funds')}}</h1>
      <div class="row">
        <div class="col-lg-12 col-12 col-md-12 col-sm-12">
          <!-- <h4 class="choice-payment-method-msg" v-if="payment_method == ''">
            Por favor, clique em um dos métodos de pagamento:
          </h4>
          <div class="row box-payment-method" style="align-items: center;">
            <div class="col-lg-2 col-6 col-md-2 col-sm-4">
              <a @click.prevent="changePaymentMethod('payment_agent', $event)" href="#" class="payment-method active">
                <img class="img-fluid" src="/img/payment_agent.png">
                <span class="payment-method-name">Pagseguro</span>
              </a>
            </div>
          </div> -->
          <div class="row box-actions-payment">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <vc-agent :order_id="order_id" v-if=" payment_method == 'payment_agent' "></vc-agent>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import VcLoad from '../Load'
  import VcAgent from './WithdrawalMethod/VcAgent'
  export default {
    components: {
      VcLoad,
      VcAgent
    },
    data: function() {
			return {
				payment_method: 'payment_agent',
				order_id: '',
				loading: {
					component: false
				},
				counter: 0
			}
		},
    methods: {
      changePaymentMethod: function(payment_method, el) {
				$('.box-payment-method').find('.active').removeClass('active');
				var parent = $(el.target).parent();
				parent.addClass('active');
				this.payment_method = payment_method
			},
    }
  }
</script>

