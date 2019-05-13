<template>
  <load v-if="loading.teams"/>
  <div v-else>
    <br>
    <vc-podium v-if="league.classic.show_podium" :league="league"/>

    <div v-if="teams.length > 0" class="row">
      <div class="col-12">
        <h1 style="display: inline-block">Ranking</h1>
        <select
          v-model="rankingOrder"
          class="form-control"
          style="display: inline-block; width: initial;"
        >
          <option :value="'p_c'">do campeonato</option>
          <option :value="'p_t'">do turno</option>
          <option :value="'p_m'">do mês</option>
          <option :value="'p_r'">da última rodada</option>
          <option :value="'p_p'">por patrimônio</option>
        </select>
      </div>
    </div>

    <br>
    <div
      v-if="teams.length > 0"
      class="row row-team no-margin"
      style="padding-left: 30px; padding-right: 30px;"
    >
      <div class="col-4 col-sm-4 col-md-4 col-lg-8 col-4">
        <strong>{{ trans('strings.team') }}</strong>
      </div>
      <div class="col-lg-2 col-4 col-sm-4 col-md-4 vcenter-end">
        <strong>{{ trans('strings.punctuation') }}</strong>
      </div>
      <div class="col-lg-2 col-4 col-sm-4 col-md-4 vcenter-end">
        <strong>{{ trans('strings.position') }}</strong>
      </div>
    </div>

    <div
      v-if="teams.length > 0"
      class="row vcenter row-team no-margin"
      v-for="(team, index) of teams"
      :key="index"
    >
      <div class="col-4 col-sm-4 col-md-4 col-lg-8 vcenter" v-if="team.team && team.team.time">
        <div class="cartola-shield">
          <img
            class="shield"
            v-if="team.team"
            :src="team.team.time.url_escudo_svg != '' ? team.team.time.url_escudo_svg : 'https://cartolafc.globo.com/dist/4.6.2/img/placeholder_perfil.png'"
            :alt="team.team.time.nome"
          >
          <img
            class="photo"
            v-if="team.team"
            :src="team.team.time.foto_perfil != '' ? team.team.time.foto_perfil : 'https://cartolafc.globo.com/dist/4.6.2/img/placeholder_perfil.png'"
            :alt="team.team.time.nome"
          >
        </div>
        <div class="cartola-cartoleiro">
          <h4>
            <strong>{{ team.team.time.nome }}</strong>
          </h4>
          <h4>{{ team.team.time.nome_cartola }}</h4>
        </div>
      </div>
      <div
        class="col-4 col-sm-4 col-md-4 col-lg-2 vcenter-end"
      >{{ team[rankingOrder] == null ? '-' : parseFloat(team[rankingOrder]).toFixed(2) }}</div>
      <div
        class="col-4 col-sm-4 col-md-4 col-lg-2 vcenter-end"
      >{{ team.position == null ? '-' : team.position }}</div>
    </div>

    <div class="row vcenter" v-if="teams.length == 0">
      <div class="col-12">
        <h1>Ainda não há nenhum time cadastrado nesta liga</h1>
      </div>
    </div>
  </div>
</template>

<script>
import { hostAPI } from "../../../api_routes.js";
import VcPodium from "./VcPodium";
import _ from "lodash";
export default {
  methods: {
    getTeams() {
      let req = axios.create();
      let url = hostAPI + "/leagues/" + this.slug + "/classic/teams";
      this.loading.teams = true;
      req
        .get(url)
        .then(response => {
          this.loading.teams = false;
          this.teams = response.data;
        })
        .catch(error => {
          this.loading.teams = false;
        });
    }
  },
  name: "VcClassic",
  created() {
    this.getTeams();
  },
  mounted() {},
  data() {
    return {
      rankingOrder: "p_c",
      teams: [],
      loading: {
        component: false,
        teams: false
      }
    };
  },
  watch: {
    rankingOrder(newValue, oldValue) {
      let len = this.teams.length;
      let teams = _.cloneDeep(this.teams);
      let aux = null;
      for (let i = 0; i < len; i++) {
        for (let j = i + 1; j < len; j++) {
          if (parseFloat(teams[i][newValue]) < parseFloat(teams[j][newValue])) {
            aux = teams[i];
            teams[i] = teams[j];
            teams[j] = aux;
          }
        }
      }
      this.teams = teams;
    }
  },
  props: ["league", "slug"],
  components: {
    VcPodium
  }
};
</script>

<style scoped>
.row-team {
  padding: 18px 30px;
  background-color: #ececec;
  margin-top: 6px;
  border-radius: 4px;
}

.row-team:last {
  margin-top: 0;
}

.cartola-shield {
  display: inline-block;
  height: 54px;
  width: 64px;
  position: relative;
}

.cartola-shield .shield {
  width: 45px;
  height: 50px;
}

.cartola-shield .photo {
  right: 0;
  bottom: 6%;
  width: 32px;
  height: 32px;
  position: absolute;
  border: 2px solid #fff;
  border-radius: 50%;
}

.cartola-cartoleiro {
  margin-left: 27px;
}

.cartola-cartoleiro h4 {
  margin: 0;
  line-height: 1;
}
</style>
