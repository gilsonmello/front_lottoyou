
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).on('hidden.bs.modal', '.modal', function (e) {
	if($('.modal').is(':visible')) {
		$('body').addClass('modal-open');
	}
});

Array.prototype.clone = function(){
  return this.slice(0);
}

window.Vue = require('vue');

require('./helpers');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueResource from 'vue-resource';
import VueCookies from 'vue-cookies';
import Meta from 'vue-meta'
import router from './router';
import store from './store';
import Select2 from './components/Select2Component';
import InputMask from './components/InputMaskComponent';
import VcCountries from './components/VcCountries';
import Load from './components/Load';
import {mapState, mapGetters} from 'vuex';

import App from './components/App';

Vue.use(VueCookies);
Vue.use(VueResource);
Vue.use(Meta);

Vue.component('select2', Select2);
Vue.component('inputmask', InputMask);
Vue.component('load', Load);

Vue.component('vc-countries', VcCountries);
Vue.component('app', App);

const app = new Vue({
	router,
	store,
    el: '#app',
	render: h => h(App),
	beforeMount() {
		$('#prerendered-content').remove();
	},
    created() {
		
    },
    mounted() {
    	//this.$cookies.set("locale", window.locale);
    },
    computed: {
		...mapState({
            User: state => state.User
        }),
        ...mapGetters([
            'auth', 'purchase'
        ])
	},
});

window.addEventListener('storage', function(event) {
    
    //Se foi tudo deletado
    if(event.storageArea.length == 0) {
    	window.location.reload();
    } else {
    	
    	if(app.auth && app.auth.access_token != event.newValue && event.key == 'access_token' && event.oldValue != '') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		} else if(app.auth && app.auth.refresh_token != event.newValue && event.key == 'refresh_token' && event.oldValue != '') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		} else if(app.auth && JSON.stringify(app.auth) != event.newValue && event.key == 'authUser' && event.oldValue != '') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		}

		
    	//Se deletou o token, removo o usuário logado
	    if((event.key == 'access_token' && event.newValue == null)) {
	    	window.localStorage.removeItem('refresh_token');
	    	window.localStorage.removeItem('authUser');
	        window.location.reload();
	    } else {

	    	//Se removeu o usuário
			if((event.key == "authUser") && (event.newValue == null)) {
		        window.location.reload();
		    }

		    //Se houve alguma alteração no usuário mas não está logado
		    if((event.key == "authUser") && event.newValue != null && app.auth == null) {
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
