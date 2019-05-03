<template>
  <div class="container">
    <h1 class="page-header text-justify" style="border: none; margin: 44px 0 0;">
      EASY MONEY
      <!--{{ trans('strings.how_to_play') }} {{ trans('strings.lottery') }}-->
      <h2 class="font-weight-bold">NUNCA FOI TÃO FÁCIL GANHAR!</h2>
    </h1>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>Na Easy Money, você pode transformar 2 reais em 80.000 reais todos os dias. Para tanto, basta acertar cinco (05) números em um universo de trinta e cinco (35). Tudo isso diretamente do conforto da sua casa, sem transtornos e simples como qualquer compra através da internet!</h6>
        <h6>A Easy Money se inspira na loteria Gana Diario realizada no Peru. Em vez de entrar no sorteio oficial dessa loteria, você aposta no resultado dela.</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h5 class="font-weight-bold">Como fazer?</h5>
        <h6>
          Os usuários deverão escolher cinco números entre 1 e 35, buscando acertar todos os cinco números para ganhar o prêmio máximo. O diferencial da EASY MONEY é que acertando 4, 3, 2 ou até mesmo 1 número você já recebe prêmios.
          As apostas podem ser realizadas até as 00:00 do dia do sorteio.
        </h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h5 class="font-weight-bold">Quando ocorrem?</h5>
        <h6>Os sorteios da EASY MONEY são realizados todos os dias às 02:15.</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h5 class="font-weight-bold">Como otimizar seu tempo e sua sorte</h5>
        <h6>Para participar de todos os sorteios da EASY MONEY da semana ou do mês, sem perder tempo, selecione todos os sorteios disponíveis na LOTTOYOU e garanta a sua participação nos concursos da Easy Money.</h6>
        <h6>Faça com que a sorte lhe encontre mais rápido!</h6>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>
import { mapGetters } from "vuex";
export default {
  metaInfo() {
    return {
      title: "Como jogar | " + this.trans("strings.lottoyou"),
      meta: [
        { name: "description", content: this.trans("strings.help") },
        {
          property: "og:title",
          content: "Como jogar | " + this.trans("strings.lottoyou"),
          vmid: "og:title"
        },
        {
          property: "og:description",
          content: "Como jogar",
          vmid: "og:description"
        }
      ]
    };
  },
  computed: {
    ...mapGetters(["getSystemCurrency"])
  },
  mounted() {}
};
</script>