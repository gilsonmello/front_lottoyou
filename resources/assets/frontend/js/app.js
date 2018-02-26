
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue')

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

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
import DatepickerComponent from './components/DatepickerComponent'
import App from './components/App'

Vue.use(VueResource);

Vue.component('select2', Select2);
Vue.component('input-mask', InputMask);
Vue.component('datepicker', DatepickerComponent);

Vue.component('app', App);

const app = new Vue({
	router,
	store,
    el: '#app',
    render: h => h(App),
    created: function() {
    	
    },
    mounted: function() {
    	var header = $('.header')
    	$('body').css({
    		'padding-top': header[0].clientHeight
    	});
    }
});
