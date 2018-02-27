import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

var routes = {};
var url = '';

switch (window.locale) {
	case 'br': {
		routes = require('./routes/pt_BR.js');
		url = '/#/br';
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
		break;
	}
}
export default new Router(routes.default);

if(window.QueryString.locale) {
	window.history.pushState({}, '', url);
}