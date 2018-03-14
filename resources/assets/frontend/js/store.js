import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
const debug = process.env.NODE_ENV ==! 'production'

import User from './modules/User/main'


export default new Vuex.Store({
	modules: {
		User
	},
	strict: debug
})