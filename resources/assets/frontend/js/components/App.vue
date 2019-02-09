<template>
  <app-load-component v-if="loading.component"/>
  <main role="main" v-else>
    <header-component></header-component>
    <section class="content">
      <transition name="fade" mode="out-in">
        <keep-alive>
          <router-view></router-view>
        </keep-alive>
      </transition>
    </section>
    <br>
    <footer-component></footer-component>

    <login-component></login-component>

    <portal-target name="destination">
      <!--
			This component can be located anwhere in your App.
			The slot content of the above portal component will be rendered here.
      -->
    </portal-target>

    <portal-target name="cartoleando-index-modal">
      <!--
			This component can be located anwhere in your App.
			The slot content of the above portal component will be rendered here.
      -->
    </portal-target>
  </main>
</template>

<script>
import HeaderComponent from "./HeaderComponent";
import SliderComponent from "./SliderComponent";
import CarouselComponent from "./CarouselComponent";
import FooterComponent from "./FooterComponent";
import LoginComponent from "./LoginComponent";
import VcModal from "./VcModal";
import router from "../router";
import AppLoadComponent from "./AppLoad";
import { routes, getHeaders, domain } from "../api_routes";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      loading: {
        component: true
      },
      modal: {
        param: null,
        type: ""
      }
    };
  },
  methods: {
    cartRequest() {
      //Requisição para pegar os itens do carrinho salvo
      let cartRequest = axios.create();

      cartRequest.interceptors.request.use(config => {
        //this.loading.component = true;
        return config;
      });
      //Executando a requisição
      cartRequest
        .get(routes.carts.index, {
          params: { id: (this.authUser && this.authUser.id) || null }
        })
        .then(response => {
          if (response.status === 200) {
            //Caso encontrou algum item
            //Seto os items na estrura
            if (response.data.items.length > 0) {
              this.$store.dispatch("setItems", response.data.items);
            }

            this.loading.component = false;
          }
        })
        .catch(error => {
          this.loading.component = false;
        });
    },
    init() {
      this.cartRequest();
      this.getSystemSettings()
        .then(response => {
          this.$store.dispatch("setSystemSettings", response.data);
        })
        .catch(error => {});
    }
  },
  watch: {
    //
  },
  beforeCreate() {
    //
  },
  beforeMount() {
    //
  },
  created() {
    this.init();
  },
  mounted() {
    //
  },
  components: {
    HeaderComponent,
    SliderComponent,
    CarouselComponent,
    FooterComponent,
    LoginComponent,
    AppLoadComponent,
    VcModal
  },
  computed: {
    ...mapGetters(["authUser", "auth", "systemSettings"])
  }
};
</script>

<style>
</style>