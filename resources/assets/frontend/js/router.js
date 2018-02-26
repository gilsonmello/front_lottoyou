import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

var routes = {};
switch (window.locale) {
	case 'pt_BR': {
		routes = require('./routes/pt_BR.js');
		break;
	}
	case 'es_ES': {
		routes = require('./routes/es_ES.js');
		break;
	}
	default: {
		routes = require('./routes/en.js');
		break;
	}
}
export default new Router(routes.default)