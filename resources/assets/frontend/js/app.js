/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

$(document).on("hidden.bs.modal", ".modal", function(e) {
  if ($(".modal").is(":visible")) {
    $("body").addClass("modal-open");
  }
});

Array.prototype.clone = function() {
  return this.slice(0);
};

window.Vue = require("vue");

require("./helpers");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Meta from "vue-meta";
import VueModal from "vue-js-modal";

import router from "./router";
import store from "./store";
import Select2 from "./components/Select2Component";
import InputMask from "./components/InputMaskComponent";
import VcCountries from "./components/VcCountries";
import Load from "./components/Load";
import VcProductCard from "./components/VcProductCard";
import { mapGetters } from "vuex";

import App from "./components/App";
//import Teste from './components/Teste';
import PortalVue from "portal-vue";

import { domain, getHeaders, routes } from "./api_routes";
Vue.use(Meta);
Vue.use(VueModal);
Vue.use(PortalVue);

Vue.component("select2", Select2);
Vue.component("inputmask", InputMask);
Vue.component("load", Load);
Vue.component("vc-product-card", VcProductCard);
//Vue.component('teste', Teste);

Vue.component("vc-countries", VcCountries);

let rsp;

// Busca usuário logado
const autheticationRequest = async () => {
  //Token de acesso
  let access_token = Cookies.get("access_token", { domain }) || null;
  access_token = access_token != null ? access_token : null;

  //Token para refresh
  let refresh_token = Cookies.get("refresh_token", { domain }) || null;
  refresh_token = refresh_token != null ? refresh_token : "";

  // Se existe token de acesso
  if (access_token) {
    const rq = window.axios.create();
    try {
      // Tenta buscar o usuário logado
      rsp = await rq.get(routes.auth.user, getHeaders());
    } catch (error) {
      rsp = error;
    }
  }

  return new Promise(function(resolve, reject) {
    if (rsp && rsp.status === 200) {
      resolve(rsp);
    } else {
      resolve(null);
    }
  });
};

let app;

autheticationRequest().then(response => {
  // Seta o usuário no repositório
  response && store.dispatch("setUserObject", response.data);

  // Cria instância vue
  app = window.VueInstance = new Vue({
    el: "#app",
    render: h => h(App),
    router,
    store,
    computed: {
      ...mapGetters(["auth", "purchase"])
    },
    created() {
      $("#prerendered-content").remove();
      if (this.auth) {
        window.axios.defaults.headers.common = getHeaders().headers;
      }
    },
    mounted() {
      Cookies.set("test", "Random value", { domain });
    }
  });
});

window.addEventListener("storage", function(event) {
  //Se foi tudo deletado
  if (event.storageArea.length == 0) {
    window.location.reload();
  } else {
    if (
      app.auth &&
      app.auth.access_token != event.newValue &&
      event.key == "access_token" &&
      event.oldValue != ""
    ) {
      window.localStorage.removeItem("access_token");
      window.localStorage.removeItem("refresh_token");
      window.localStorage.removeItem("authUser");
      window.location.reload();
    } else if (
      app.auth &&
      app.auth.refresh_token != event.newValue &&
      event.key == "refresh_token" &&
      event.oldValue != ""
    ) {
      window.localStorage.removeItem("access_token");
      window.localStorage.removeItem("refresh_token");
      window.localStorage.removeItem("authUser");
      window.location.reload();
    } else if (
      app.auth &&
      JSON.stringify(app.auth) != event.newValue &&
      event.key == "authUser" &&
      event.oldValue != ""
    ) {
      window.localStorage.removeItem("access_token");
      window.localStorage.removeItem("refresh_token");
      window.localStorage.removeItem("authUser");
      window.location.reload();
    }

    //Se deletou o token, removo o usuário logado
    if (event.key == "access_token" && event.newValue == null) {
      window.localStorage.removeItem("refresh_token");
      window.localStorage.removeItem("authUser");
      window.location.reload();
    } else {
      //Se removeu o usuário
      if (event.key == "authUser" && event.newValue == null) {
        window.location.reload();
      }

      //Se houve alguma alteração no usuário mas não está logado
      if (
        event.key == "authUser" &&
        event.newValue != null &&
        app.auth == null
      ) {
        window.location.reload();
      }
    }
  }
});

/* window.onload = function() {
	alert('onload');
};

window.onbeforeunload = function() {
	alert('onbeforeunload');
};

window.onunload = function () {
    alert('onunload');
}

window.addEventListener('popstate', function(e) {
	alert('popstate');
});

window.addEventListener('hashchange', function(e) {
	alert('hashchange');
}); */
