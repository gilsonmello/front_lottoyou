<template>
  <load v-if="loading.component == true"></load>
  <div class="container" v-else>
    <div class="row page-header">
      <div class="col-lg-12 col-12 col-md-12 col-sm-12">
        <h1 style="display: inline">{{ trans('strings.cartoleando') }}</h1>
        <router-link
          :to="{ name: 'how_to_play_easy_money' }"
          class="btn btn-md btn-primary pull-right"
        >{{ trans('strings.how_to_play') }} {{ trans('strings.cartoleando') }}</router-link>
      </div>
    </div>

    <div class="row" v-if="leaguePackages.length == 0">
      <div class="col-lg-12">
        <h3>Nenhum pacote disponível no momento</h3>
      </div>
    </div>

    <div class="row">
      <div
        class="col-12 col-md-6 col-sm-6 col-lg-4 mb-4"
        v-for="(leaguePackage, index) in leaguePackages"
        :key="index"
        :index="index"
      >
        <div class="soccer-expert">
          <header class="soccer-expert-header">
            <div class="extras" v-if="leaguePackage.new == 1">
              <img :src="app.basePath+'img/new.png'" alt="new" class="game-badge">
            </div>
            <img
              class="header-image img-fluid"
              :alt="leaguePackage.name"
              :src="leaguePackage.bg_image_domain + '/' + leaguePackage.bg_image"
            >
            <div class="descript">
              <h2 class="ng-binding">{{ leaguePackage.name }}</h2>
              <p class="ng-binding">{{ leaguePackage.description }}</p>
            </div>
          </header>

          <div class="soccer-expert-body">
            <div class="amount">{{ leaguePackage.name }}</div>
            <div class="jackpot-table">
              <div class="row vcenter">
                <div class="col-lg-8 col-12 col-md-8 col-sm-12">
                  <a
                    href="#"
                    @click.prevent="handleJackpotTable(index, $event)"
                    class="btn description"
                  >
                    <i class="fa fa-money" aria-hidden="true"></i>
                    &nbsp;
                    Tabela de Premios
                  </a>
                </div>
              </div>
            </div>
          </div>

          <footer class="soccer-expert-footer">
            <div class="row vcenter" style="margin-top: 15px; background: none;">
              <div class="col-12 col-md-12 col-xs-12 col-sm-12 text-center">
                <router-link
                  :to="{ name: 'cartoleando.play', params: { slug: leaguePackage.slug } }"
                  class="btn btn-md btn-primary"
                >{{ trans('strings.play_now') }}</router-link>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>

    <!--  <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-4 col-12" v-for="(leaguePackage, index) in leaguePackages" :key="index" :index="index">
                <div class="card">
                    <img class="card-img-top" :src="leaguePackage.bg_image_domain+'/'+leaguePackage.bg_image" :alt="leaguePackage.description">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{ leaguePackage.name }}</h5>
                        <p class="card-text mb-2">{{ leaguePackage.description }}</p>
                        <a href="#" @click.prevent="handleJackpotTable(index)" class="btn btn-primary btn-xs description mb-2">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            &nbsp;
                            Tabela de Premios
                        </a>
                        <br>
                        <router-link :to="{ name: 'cartoleando.play', params: { slug: leaguePackage.slug } }" class="btn btn-md btn-primary">
                            {{ trans('strings.play_now') }}
                        </router-link>
                    </div>
                </div>
                <br>
            </div>
    </div>-->
    <!-- <vc-card v-for="(leaguePackage, index) in leaguePackages" :key="index" :leaguePackage="leaguePackage" :index="index" /> -->

    <portal to="cartoleando-index-modal">
      <div
        class="modal fade modal-jackpot-table"
        id="nivel1"
        data-backdrop="static"
        tabindex="-1"
        aria-labelledby="nivel1"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content" v-if="loading.modalJackpotTable == true">
            <div class="modal-body">
              <load></load>
            </div>
          </div>
          <div class="modal-content" v-else>
            <div
              class="modal-header"
              style="border-bottom: none;"
              v-if="leaguePackages[indexClicked]"
            >
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="row">
                  <div
                    class="col-lg-4 col-md-4 col-sm-12 col-12"
                    :style="bgImage()+' padding-right: 0; padding-left: 0; min-height: 106px;'"
                  ></div>
                  <div
                    class="col-lg-8 col-md-8 col-sm-12 col-12 items-center display-flex container-actions direction-column"
                  >
                    <h5>{{ getSystemCurrency.data.symbol }}{{ leaguePackages[indexClicked].value }}</h5>
                    <router-link
                      :to="{ name: 'cartoleando.play', params: {slug: leaguePackages[indexClicked].slug} }"
                      style="display: block"
                      class="btn btn-md btn-primary"
                    >{{ trans('strings.play_now') }}</router-link>
                  </div>
                </div>
              </div>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
              <load v-if="loading.leagues"/>
              <div id="accordion" v-else>
                <div class="card league" v-for="(league, index) in leagues" :key="index">
                  <div
                    :class="index == 0 ? 'card-header league-header' : 'card-header league-header collapsed'"
                    data-toggle="collapse"
                    :data-target="'#league_'+league.id"
                    :aria-expanded="index == 0 ? true : false"
                    :aria-controls="'league_'+league.id"
                  >
                    <h3 class="mb-0 cursor-pointer">{{ league.name }}</h3>
                    <small
                      v-if="league.context == 'classic'"
                    >{{ getMethodAward(league.classic.type_award_id) }}</small>
                  </div>

                  <div
                    :id="'league_'+league.id"
                    :class="index == 0 ? 'collapse show' : 'collapse'"
                    aria-labelledby="headingOne"
                    data-parent="#accordion"
                  >
                    <div class="card-body p-0">
                      <table class="table m-0">
                        <thead>
                          <tr class="text-center">
                            <th>{{ trans('strings.position') }}</th>
                            <th>{{ trans('strings.award') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(award, i) of league.awards" :key="i">
                            <td class="text-center">{{ award.position }}</td>
                            <td class="text-center">
                              <span
                                v-if="award.type == 1"
                              >{{ getSystemCurrency.data.symbol }}{{ award.value }}</span>
                              <span v-else-if="award.type == 2">{{ award.value }}%</span>
                              <span v-else-if="award.type == 3">{{ award.type_description }}</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </portal>

    <!-- <div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-body">
		  				<load></load>
		  			</div>
		  		</div>
		  		<div class="modal-content" v-else>
		  			
					
			      	<div class="modal-header" style="border-bottom: none;" v-if="leaguePackages[indexClicked]">
			        	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div class="col-lg-4 col-md-4 col-sm-12 col-12" :style="bgImage()+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-12 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<router-link :to="{ name: 'cartoleando.play', params: {slug: leaguePackages[indexClicked].slug} }" style="display: block" class="btn btn-md btn-primary">
						        					{{ trans('strings.play_now') }}
						        				</router-link>
						        			</div>
					        			</div>
					        			<div class="row">
						        			<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				
						        			</div>
						        		</div>
					        		</div>					        		
					        	</div>
		        			</div>
		        		</div>		        	
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<div class="modal-body" style="padding-top: 0;">
						<span v-if="leagues.length == 0">
							{{ trans('strings.loading') }}...
						</span>
                        <div id="accordion" v-else>
                            <div class="card" v-for="(league, index) in leagues" :key="index">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" :data-target="'#league_'+league.id" aria-expanded="true" :aria-controls="'league_'+league.id">
                                            {{ league.name }}
                                        </button>
                                    </h5>
                                </div>

                                <div :id="'league_'+league.id" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        {{ league.description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>-->
  </div>
</template>

<script>
import { routes } from "../../api_routes";
import { mapGetters } from "vuex";
import VcCard from "./VcCard";
export default {
  metaInfo() {
    return {
      title: this.trans("strings.cartoleando"),
      meta: this.metas
    };
  },
  data() {
    return {
      loading: {
        component: true,
        leagues: false,
        modalJackpotTable: false
      },
      leagues: [],
      leaguePackages: [],
      indexClicked: null,
      metas: [],
      awards: [],
      modal: null
    };
  },
  methods: {
    getMethodAward(method) {
      let methodAward = {
        "0": "",
        "1": "Por campeonato",
        "2": "Por mês",
        "3": "Por turno",
        "4": "Por patrimônio",
        "5": "Por rodada"
      };
      return methodAward[method];
    },
    handleJackpotTable(index) {
      let slug = this.leaguePackages[index].slug;
      let name = this.leaguePackages[index].name;
      this.indexClicked = index;
      this.loading.leagues = true;
      this.getLeaguesOfPackageBySlug(slug)
        .then(response => {
          this.loading.leagues = false;
          this.leagues = response.data;
        })
        .catch(error => {
          toastr.error(
            "Ocorreu um algum erro ao carregar as ligas do Pacote `{$name}`, por favor tente novamente."
          );
          this.loading.leagues = false;
        });
      this.modal.modal("toggle");
    },
    setModal() {
      let time = setInterval(() => {
        let modal = $(".modal-jackpot-table");
        if (modal.length > 0) {
          this.modal = modal;
          clearInterval(time);
        }
      }, 0);
    },
    bgImage() {
      let background =
        this.leaguePackages[this.indexClicked].bg_image_domain +
        "/" +
        this.leaguePackages[this.indexClicked].bg_image;
      return (
        "background-image: url(" +
        background.replace(" ", "%20") +
        "); background-size: 100% 100%;"
      );
    }
  },
  beforeDestroy() {
    this.$eventBus.$off("handleJackpotTable");
  },
  mounted() {
    //Setando o modal para a variável modal
    this.setModal();

    //Ajax para buscar todos pacotes que contém ligas
    this.getLeaguePackages()
      .then(response => {
        this.leaguePackages = response.data;
        this.loading.component = false;
        this.leaguePackages.forEach(element => {
          this.metas.push({
            name: "description",
            content: element.name
          });
        });
      })
      .catch(error => {
        this.loading.component = false;
      });
  },
  components: {
    VcCard
  },
  computed: {
    ...mapGetters(["getSystemCurrency"])
  }
};
</script>

<style lang="scss">
.card-img-top {
  width: initial;
  max-width: 100%;
}
.league-header.collapsed:after {
  content: "\f078";
}

.league-header:after {
  font-family: "FontAwesome";
  content: "\f077";
  position: absolute;
  right: 0;
  top: 50%;
  transform: translate(-50%, -50%);
}

.card {
  margin-bottom: 10px;
}

.league-header {
  position: relative;
}

.soccer-expert-footer label {
  padding: 13px 10px;
  margin: 0;
  width: 100%;
  cursor: pointer;
}

.soccer-expert-footer form .row {
  color: #666;
  background: rgba(255, 255, 255, 0.3);
  border-bottom: 1px solid #eee;
  font-size: 15px;
  cursor: pointer;
}

.soccer-expert-body .amount {
  background: linear-gradient(
    87.71deg,
    #1db2e0 0%,
    #6ad1ed 50.77%,
    #1db2e0 100%
  );
  height: 46px;
  color: #ffffff;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 15px;
  font-weight: bold;
  line-height: 46px;
  text-align: center;
  box-shadow: 0px -6px 5px -3px rgba(0, 0, 0, 0.3);
  position: relative;
}

.soccer-expert-body .jackpot-table {
  background: #0f546d;
  color: #fff;
  padding: 10px;
  font-size: 13px;
  font-weight: 700;
}
.soccer-expert-body .jackpot-table a.demo {
  display: block;
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 5px;
  color: #fff;
  font-weight: 700;
  -webkit-transition: border 0.3s ease-in-out;
  transition: border 0.3s ease-in-out;
  font-size: 13px;
  margin: 10px 0 10px 0;
}

.soccer-expert-body .jackpot-table a.description {
  cursor: pointer;
  color: #fff;
  margin: 10px 0 10px 0;
}
.soccer-expert-body .jackpot-table a.demo:hover {
  border: 2px solid #fff;
}

.soccer-expert-body .btn {
  padding: 0;
}

.soccer-expert-header {
  position: relative;
}

.soccer-expert-header .header-image {
  width: 100%;
}

.soccer-expert-header:hover .descript {
  opacity: 1;
}

.soccer-expert-header .descript {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(239, 239, 239, 0.95);
  z-index: 2;
  opacity: 0;
  -webkit-transition: opacity 0.3s ease-in-out;
  transition: opacity 0.3s ease-in-out;
  padding: 20px;
  text-align: center;
  color: #666;
}

.soccer-expert-header .extras img {
  position: absolute;
  top: -15px;
  left: -5px;
  z-index: 4;
}
</style>

