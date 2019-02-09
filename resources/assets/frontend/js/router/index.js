import Vue from "vue";
import Router from "vue-router";
import MoneyComponent from "@c/MoneyComponent";
import MoneyBrComponent from "@c/MoneyBrComponent";
import VcDatePickerPtBr from "@c/VcDatePickerPtBr.vue";
import VcDatePickerEnUs from "@c/VcDatePickerEnUs.vue";
import VcDatePickerEsEs from "@c/VcDatePickerEsEs.vue";
import VcDateTimePickerPtBr from "@c/VcDateTimePickerPtBr";
import VcDateTimePickerEnUs from "@c/VcDateTimePickerEnUs";
//import routes from './routes/en_US';

Vue.use(Router);

import { domain } from "@/api_routes";

var url = "";
let routes = null;

switch (window.locale) {
  case "pt_BR": {
    routes = require("@/routes/pt_BR.js").default;
    url = "/#/pt_BR";
    //Vue.component('money-component', MoneyBrComponent);
    Vue.component("money-component", MoneyComponent);
    Vue.component("datepicker", VcDatePickerPtBr);
    Vue.component("datetimepicker", VcDateTimePickerPtBr);
    break;
  }
  case "es_ES": {
    routes = require("@/routes/es_ES.js").default;
    url = "/#/es_ES";
    Vue.component("money-component", MoneyComponent);
    Vue.component("datepicker", VcDatePickerPtBr);
    Vue.component("datetimepicker", VcDateTimePickerPtBr);
    break;
  }
  default: {
    routes = require("@/routes/en_US.js").default;
    url = "/#/";
    Vue.component("money-component", MoneyComponent);
    //Vue.component('datepicker', VcDatePickerEnUs);
    Vue.component("datepicker", VcDatePickerPtBr);
    Vue.component("datetimepicker", VcDateTimePickerPtBr);
    //Vue.component('datetimepicker', VcDateTimePickerEnUs);
    break;
  }
}

export const waitApplicationLoad = async () => {
  return new Promise(function(resolve, reject) {
    let time = setInterval(() => {
      if (window.VueInstance) {
        clearInterval(time);
        resolve();
      }
    });
  });
};

let router = new Router(routes);

router.onReady(to => {
  //Verificando se a página necessita de login e o usuário não está logado
  if (to.meta.requiresAuth && !window.VueInstance.auth) {
    window.VueInstance.$router.push({
      name: "home"
    });
  }
});

router.beforeEach(async (to, from, next) => {
  await waitApplicationLoad();
  let access_token = Cookies.get("access_token", { domain }) || null;
  if (!to.meta.requiresAuth) {
    next();
  } else if (
    to.meta.requiresAuth &&
    (!window.VueInstance.auth || !access_token)
  ) {
    toastr.info("Para acessar " + to.path + " é obrigatório estar logado.");
    next({ name: "home" });
  } else if (to.meta.requiresAuth && window.VueInstance.auth) {
    next();
  }
});

router.afterEach((to, from) => {
  ga("set", "page", to.path);
  ga("send", "pageview");

  let height = $("main").prop("scrollHeight");

  $("html, body").animate(
    {
      scrollTop: 0
    },
    300
  );

  setTimeout(() => {
    if (to.matched.length === 0) {
      window.VueInstance.$router.push({ name: "home" });
    }
  }, 200);

  //Fechando o modal de login
  $(".modal").modal("hide");

  var navMain = $("#navbarCollapse");
  navMain.collapse("hide");

  $(".tooltip-item-account").removeClass("open");
});

if (window.QueryString.locale) {
  window.history.pushState({}, "", url);
}

export default router;
