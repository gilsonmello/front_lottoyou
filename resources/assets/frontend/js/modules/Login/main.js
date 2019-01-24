import state from './state';
import mutations from './mutations';
import actions from './actions';

export default {
	state,
	mutations,
	actions,
	getters: {
	    loginOptions: state => {
	      	return state.options;
	    }
  	}
};
