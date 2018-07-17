import state from './state'
import mutations from './mutations'
import actions from './actions'

export default{
	state,
	mutations,
	actions,
	getters: {
	    auth : state => {
	      	return state.authUser
	    },
	    authUser : state => {
	      	return state.authUser
	    }
  	}
}