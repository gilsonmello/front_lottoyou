import Vue from 'vue'
import Router from 'vue-router'
import MoneyComponent from './components/MoneyComponent'
import MoneyBrComponent from './components/MoneyBrComponent'
import VcDatePickerPtBr from './components/VcDatePickerPtBr.vue';
import VcDatePickerEnUs from './components/VcDatePickerEnUs.vue';
import VcDatePickerEsEs from './components/VcDatePickerEsEs.vue';
import VcDateTimePickerPtBr from './components/VcDateTimePickerPtBr';
import VcDateTimePickerEnUs from './components/VcDateTimePickerEnUs';
Vue.use(Router)

var routes = {};
var url = '';

switch (window.locale) {
	case 'pt_BR': {
		routes = require('./routes/pt_BR.js');
		url = '/#/pt_BR';
		Vue.component('money-component', MoneyBrComponent);
		Vue.component('datepicker', VcDatePickerPtBr);
		Vue.component('datetimepicker', VcDateTimePickerPtBr);
		break;
	}
	case 'es_ES': {
		routes = require('./routes/es_ES.js');
		url = '/#/es_ES';
		Vue.component('money-component', MoneyComponent);
		Vue.component('datepicker', VcDatePickerEsEs);
		Vue.component('datetimepicker', VcDatePickerEnUs);
		break;
	}
	default: {
		routes = require('./routes/en_US.js');
		url = '/#/';
		Vue.component('money-component', MoneyComponent);
		Vue.component('datepicker', VcDatePickerEnUs);
		Vue.component('datetimepicker', VcDateTimePickerEnUs);
		break;
	}
}
export default new Router(routes.default);

if(window.QueryString.locale) {
	window.history.pushState({}, '', url);
}