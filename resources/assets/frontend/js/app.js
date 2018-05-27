
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

Number.prototype.format = function(n, x) {
    var re = '(\\d)(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$1,');
};

Vue.prototype.makeid = function() {
  	var text = "";
  	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  	for (var i = 0; i < 15; i++){
    	text += possible.charAt(Math.floor(Math.random() * possible.length));
  	}
	return text;
};

Vue.prototype.$eventBus = new Vue();

Vue.prototype.src = function(src) {
	return src.replace(' ', '%20');
};

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

Vue.prototype.app = window.app;

Vue.prototype.app.reload = function() {
	window.location.reload();
}


require('./helpers');


export function getTrans(key) {
	var keys = key.split('.');
	var value = '';
	var obj = window.trans;
	var keyAux = '';

	if(keys.length > 0){
		for(var i = 0; i < keys.length; i++){
			keyAux = keys[i];
			obj = obj[keyAux];
			if(typeof obj === 'string'){
				value = obj
			}
		}
	}	
	return value;
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueResource from 'vue-resource'
import router from './router'
import store from './store'
import Select2 from './components/Select2Component'
import InputMask from './components/InputMaskComponent'
import VcDatePicker from './components/VcDatePicker'
import VcDateTimePicker from './components/VcDateTimePicker'
import Load from './components/Load'
import {mapState, mapGetters} from 'vuex'

import App from './components/App'

Vue.use(VueResource);

Vue.component('select2', Select2);
Vue.component('inputmask', InputMask);
Vue.component('datepicker', VcDatePicker);
Vue.component('datetimepicker', VcDateTimePicker);
Vue.component('load', Load);

Vue.component('app', App);

const app = new Vue({
	router,
	store,
    el: '#app',
    render: h => h(App),
    created: function() {
    	
    },
    mounted: function() {
    	
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

	    /*else if(app.auth && app.auth.access_token != event.newValue && event.key == 'access_token') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		} else if(app.auth && app.auth.refresh_token != event.newValue && event.key == 'refresh_token') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		} else if(app.auth && JSON.stringify(app.auth) != event.newValue && event.key == 'authUser') {
	    	window.localStorage.removeItem('access_token');
			window.localStorage.removeItem('refresh_token');
			window.localStorage.removeItem('authUser');
			window.location.reload();
		}*/
	}


    

});
