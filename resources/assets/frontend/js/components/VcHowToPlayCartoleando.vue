<template>
  <div class="container">
    <h1
      class="page-header text-justify"
      style="border: none; margin: 44px 0 0;"
    >{{ trans('strings.how_to_play') }} {{ trans('strings.cartoleando') }}</h1>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>
          Cartoleando é um produto do Lottoyou.bet onde o usuário mostra seu conhecimento do campeonato brasileiro de futebol. Neste produto, o nosso usuário participa de pacotes e ligas utilizando o nome do cartoleiro, time e e-mail cadastrado no site oficial do fantasy game Cartola
          <a
            href="https://globoesporte.globo.com/cartola-fc"
            target="_blank"
          >https://globoesporte.globo.com/cartola-fc</a>.
          <strong>Na Lottoyou.bet, você não precisa ser Cartoleiro PRO para participar de várias ligas.</strong>
        </h6>
        <h6>Os pacotes e ligas oferecidas pela Lottoyou.bet são as seguintes:</h6>
        <h6>1. Pacote Premium – Contem as seguintes ligas:</h6>
        <ul>
          <li>Liga pontos corridos do Brasileirão</li>
          <li>Liga pontos corridos do Turno</li>
          <li>Liga pontos corridos do Returno</li>
          <li>Um torneio mata-mata</li>
          <li>Ligas mensais</li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>2. Liga Turno: Liga pontos corridos do Turno do campeonato brasileiro.</h6>
        <h6>3. Liga Returno: Liga pontos corridos do Returno do campeonato brasileiro.</h6>
        <h6>4. Liga Rodada: Liga de cada rodada do campeonato brasileiro.</h6>
        <h6>5. Torneios Mata–Mata: Torneio com 4, 8, 16 ou 32 times</h6>
        <h6>6. Um contra Um: Você disputará a rodada contra um único adversário</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>Participe e ganhe muitos prêmios com o Brasileirão!</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>
          <strong>Regras e Premiação do Cartoleando:</strong>
          <br>
        </h6>
        <h6>
          1. Cadastre seu nome do cartoleiro, time e e-mail utilizado no site oficial do fantasy game Cartola
          <a
            href="https://globoesporte.globo.com/cartola-fc"
            target="_blank"
          >https://globoesporte.globo.com/cartola-fc</a>
        </h6>
        <h6>2. O nosso sistema automaticamente estará puxando as informações do seu time no site do Cartola. Dessa forma, você deverá escalar* seu time no site oficial do cartola.</h6>
        <h6>
          <strong>* Lottoyou.bet não se responsabiliza se o usuário não atualizar o seu time no site oficial, já que o nosso sistema só puxará a pontuação (parcial ou total) do time cadastrado.</strong>
        </h6>
        <h6>3. Adicione um dos pacotes ou ligas no carrinho de compras</h6>
        <h6>4. Finalize a compra.</h6>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-justify">
        <h6>
          Para estar de acordo ao nosso slogan “Aqui é mais fácil”, o sistema de premiação, referencialmente, seguirá a seguinte estrutura: (Quanto mais inscritos nas ligas, a quantidade de cartoleiros premiados aumentará)
          <br>
        </h6>
        <h6>
          <strong>
            Para efeitos de recebimento dos prêmios, o usuário da Lottoyou.bet deverá aceitar o convite realizado no site oficial do cartola
            <a
              href="https://globoesporte.globo.com/cartola-fc"
              target="_blank"
            >https://globoesporte.globo.com/cartola-fc</a> para participar da liga: “Liga Verificação Lottoyou”
          </strong>
        </h6>
        <h6>
          <strong>Cabe salientar que o sistema de premiação pode variar sem prévio aviso e de forma unilateral por parte da Lottoyou.</strong>
        </h6>
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
      title:
        this.trans("strings.how_to_play") +
        " " +
        this.trans("strings.cartoleando") +
        " | " +
        this.trans("strings.lottoyou"),
      meta: [
        { name: "description", content: this.trans("strings.help") },
        {
          property: "og:title",
          content:
            this.trans("strings.how_to_play") +
            " " +
            this.trans("strings.cartoleando") +
            " | " +
            this.trans("strings.lottoyou"),
          vmid: "og:title"
        },
        {
          property: "og:description",
          content:
            this.trans("strings.how_to_play") +
            " " +
            this.trans("strings.cartoleando"),
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