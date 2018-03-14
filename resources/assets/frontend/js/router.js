import Vue from 'vue'
import Router from 'vue-router'
import MoneyComponent from './components/MoneyComponent'
import MoneyBrComponent from './components/MoneyBrComponent'
Vue.use(Router)

var routes = {};
var url = '';

switch (window.locale) {
	case 'br': {
		routes = require('./routes/pt_BR.js');
		url = '/#/br';
		Vue.component('money-component', MoneyBrComponent);
		break;
	}
	case 'es': {
		routes = require('./routes/es_ES.js');
		url = '/#/es';
		break;
	}
	default: {
		routes = require('./routes/en.js');
		url = '/#/';
		Vue.component('money-component', MoneyComponent);
		break;
	}
}
export default new Router(routes.default);

if(window.QueryString.locale) {
	window.history.pushState({}, '', url);
}