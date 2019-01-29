<template>
  <load v-if="loading.component == true"></load>
  <div class="container" v-else>
    <div class="sub-navigation">
      <router-link :to="{ name: 'cartoleando.play', params: { slug: leaPackage.slug } }" class="show">
        {{ trans('strings.play_on_the') }} {{ leaPackage.name }}
      </router-link>
      <router-link :to="{ name: 'cartoleando.leagues', params: { slug: leaPackage.slug } }" class="show active" id="result-component">
        {{ trans('strings.leagues') }} {{ leaPackage.name }}
      </router-link>
    </div>

    <div class="row">
      <div class="col-lg-12 col-12 col-md-12 col-sm-12">
        <h1 class="page-header" style="border: none; margin: 0">
          {{ trans('strings.leagues') }} {{ leaPackage.name }}
        </h1>
      </div>
      <!-- <div class="col-lg-6 col-6 col-md-6 col-sm-6">
          <router-link :to="{ name: 'cartoleando.index' }" class="btn btn-md btn-back btn-primary">
              <i class="fa fa-arrow-left"></i>
              {{ trans('strings.back') }}
          </router-link>
      </div> -->
    </div>

    <load v-if="loading.leagues" />
    <div v-else class="card" v-for="(league, index) in leaPackage.leagues" :key="index" @click="$router.push({name: 'leagues.show', params: {slug: league.slug}})">
      <div class="card-header">
        <!-- <h6 data-toggle="collapse" :data-target="'#league_'+league.id" aria-expanded="true" :aria-controls="'league_'+league.id">
            {{ league.name }}
        </h6> -->
        <div class="row vcenter">
          <div class="col-lg-2 col-4 col-sm-2 col-md-2">
            <img class="img-fluid" :src="league.bg_image_domain+'/'+league.bg_image" :alt="league.name">
          </div>
          <div class="col-lg-10 col-8 col-sm-10 col-md-10">
            <h3 class="">{{league.name}}</h3>
            <span>
              {{ trans('strings.league') }} {{ league.modality }}
            </span>
            <br>
            <h5>{{ league.small_description }}</h5>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
import { routes } from '../../api_routes';
import { mapGetters } from 'vuex';
export default {
  methods: {
    init () {
      if (this.$route.params.slug != undefined) {
        this.leaPackage.name = this.trans('strings.loading');
        let slug = this.$route.params.slug;
        this.getLeaguePackagesBySlug(slug)
          .then((response) => {
            this.leaPackage = response.data;
            this.meta.push({
              name: 'description',
              content: this.leaPackage.name,
            });
            this.loading.component = false;
          })
          .catch((error) => {
            this.loading.component = false;
          });

          /* this.loading.leagues = true;
          this.getLeaguesOfPackageBySlug(slug)
              .then((response) => {
                  this.$set(this.leaPackage, 'leagues', response.data);
                  this.loading.leagues = false;
              })
              .catch((error) => {
                  this.loading.leagues = false;
              }); */

      }
    }
  },
  metaInfo () {
    return {
      title: this.leaPackage.name + ' | ' + this.trans('strings.lottoyou'),
      meta: this.meta
    };
  },
  data () {
    return {
      form: null,
      loading: {
        component: true,
        paying: false,
        leagues: false,
        adding: false
      },
      leaPackage: {
          leagues: []
      },
      indexClicked: null,
      meta: [],
      awards: [],
      step: 0
    };
  },
  mounted () {
    this.init();
  },
  beforeRouteUpdate (to, from, next) {
    next();
    this.init();
  },
  computed: {
    ...mapGetters([
      'auth',
      'purchase',
      'loginOptions',
      'getSystemCurrency'
    ])
  },
  watch: {

  }
};
</script>

<style scoped>
.card {
  margin-bottom: 10px;
  cursor: pointer;
}
.card .card-header {
  background-color: initial;
}
.card:last {
  margin-bottom: 0;
}

.card:hover {
  background-color: #f5f5f5;
  box-shadow: 0 2px 0 0 rgba(0,0,0,.4);
}
</style>
