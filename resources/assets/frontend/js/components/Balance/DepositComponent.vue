<template>
  <load v-if="loading.component"/>
  <div class="container" v-else>
    <h1 class="page-header">Depositar fundos</h1>
    <div class="row">
      <div class="col-lg-12 col-12 col-md-12 col-sm-12">
        <h5
          style="margin-bottom: 25px;"
        >Deposite e comece a desfrutar de infinitas possibilidades com a Lottoyou.</h5>
        <h4
          class="choice-payment-method-msg"
          v-if="payment_method == ''"
        >Por favor, clique em um dos métodos de pagamento:</h4>
        <div class="row box-payment-method" style="align-items: center;">
          <div class="col-lg-2 col-6 col-md-2 col-sm-4">
            <a
              @click.prevent="changePaymentMethod('paypal', $event)"
              href="#"
              class="payment-method"
            >
              <img class="img-fluid" alt="Paypal" title="Paypal" src="/img/paypal.png">
              <!-- <span class="payment-method-name">Paypal</span> -->
            </a>
          </div>
          <div class="col-lg-2 col-6 col-md-2 col-sm-4">
            <a
              @click.prevent="changePaymentMethod('pagseguro', $event)"
              href="#"
              class="payment-method"
            >
              <img class="img-fluid" alt="Pagseguro" title="Pagseguro" src="/img/pagseguro.png">
              <!-- <span class="payment-method-name">Pagseguro</span> -->
            </a>
          </div>
          <div class="col-lg-2 col-6 col-md-2 col-sm-4">
            <a
              @click.prevent="changePaymentMethod('payment_agent', $event)"
              href="#"
              class="payment-method"
            >
              <img
                class="img-fluid"
                alt="Agente de pagamento"
                title="Agente de Pagamento"
                src="/img/payment_agent.png"
              >
              <!-- <span class="payment-method-name">Pagseguro</span> -->
            </a>
          </div>
        </div>
        <div class="row box-actions-payment">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <paypal-component :order_id="order_id" v-if="payment_method == 'paypal' "></paypal-component>
            <vc-pagseguro :order_id="order_id" v-else-if=" payment_method == 'pagseguro' "></vc-pagseguro>
            <vc-agent :order_id="order_id" v-else-if=" payment_method == 'payment_agent' "></vc-agent>
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
      </div>-->
    </div>
  </div>
</template>

<script>
import { routes, getHeaders } from "../../api_routes";
import { mapState, mapGetters } from "vuex";
import VcPagseguro from "./PaymentMethod/VcPagseguro";
import PaypalComponent from "./PaymentMethod/PaypalComponent";
import VcAgent from "./PaymentMethod/VcAgent";
export default {
  metaInfo() {
    return {
      title:
        this.trans("strings.deposit") + " | " + this.trans("strings.lottoyou"),
      meta: [
        {
          name: "description",
          content: this.trans("strings.deposit")
        }
      ]
    };
  },
  methods: {
    changePaymentMethod(payment_method, el) {
      this.$router.replace({
        query: Object.assign({})
      });
      $(".box-payment-method")
        .find(".active")
        .removeClass("active");
      var parent = $(el.target).parent();
      parent.addClass("active");
      this.payment_method = payment_method;
    },
    orderRequest() {
      const orderRequest = axios.create();
      orderRequest.interceptors.request.use(config => {
        this.counter++;
        this.loading.component = true;
        return config;
      });
      let url = routes.orders.generate_order;

      orderRequest
        .post(url, {}, getHeaders())
        .then(response => {
          if (response.status === 200) {
            this.loading.component = false;
            this.order_id = response.data;
            this.counter = 0;
          }
        })
        .catch(error => {
          if (this.counter == 5) {
            this.counter = 0;
            toastr.error(this.trans("strings.connection_not_found"));
          } else {
            // this.orderRequest();
          }
        });
    }
  },
  computed: {
    ...mapGetters(["auth"])
  },
  data: () => {
    return {
      payment_method: "",
      order_id: "",
      loading: {
        component: true
      },
      counter: 0
    };
  },
  mounted() {
    if (
      this.$route.query.payment_method &&
      this.$route.query.payment_method != ""
    ) {
      this.payment_method = this.$route.query.payment_method;
    }
    this.orderRequest();
  },
  components: {
    PaypalComponent,
    VcPagseguro,
    VcAgent
  }
};
</script>

<style scoped>
.box-payment-method {
  transition: 1s background-color;
  background: #f7f7f7;
  margin: 15px 0 !important;
  border-radius: 5px;
  border: 1px solid #e2e2e2;
  border-bottom: #e2e2e2 1px solid !important;
  padding: 15px 0 10px;
}

.box-payment-method .active {
  transition: 1s background-color;
  border: 1px solid;
}

.choice-payment-method-msg {
  background-color: #efefef;
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