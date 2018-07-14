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
</style>

<template>
  <div class="row">
        <div class="col-lg-12">
            <h6>
              No Brasil, este processo só poderá ser realizado por meio do Agente de Pagamento, seguindo os seguintes passos:
            </h6>

            <ol>
                <li>
                  O usuário deverá solicitar a retirada entrando em contato com o Agente de Pagamento
                </li>
                <li>
                  Até 24 horas após solicitação do saque, o usuário receberá uma mensagem por aprte da equipe da Lottoyou no e-mail cadastrado na lottoyou.bet para confirmação do pedido de retirada.
                </li>
                <li>
                  O usuário deverá responder o referido e-mail, confirmando a solicitação.
                </li>
                <li>
                  Após recebimento do e-mail de confirmação a equipe da Lottoyou autorizará ao Agente de Pagamento a transferência do dinheiro*
                </li>
            </ol>
            <div class="col-lg-2 col-6 col-md-2 col-sm-4">
              <router-link :to="{name: 'balances.deposit', query: {payment_method: 'payment_agent'}}">
                <img class="img-fluid" alt="Agente de pagamento" title="Clique aqui para ir à página de agente de pagamento" src="/img/payment_agent.png">
                <!-- <span class="payment-method-name">Pagseguro</span> -->
              </router-link>
            </div>
            <h6>
              <strong>* As retiradas no Brasil são realizadas por meio de DOC ou TED. Dessa forma, a transfêrencia poderá demorar até 3 dias utéis.</strong>
            </h6>
        </div>
    </div>
</template>


<script>
  export default {
    name: 'VcAgente',
    data() {
      return {

      }
    },
    compontens: {

    }
  }
</script>
