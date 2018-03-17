import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
const debug = process.env.NODE_ENV ==! 'production'

import User from './modules/User/main'
import Cart from './modules/Cart/main'


export default new Vuex.Store({
	modules: {
		User,
		Cart
	},
	strict: debug
})