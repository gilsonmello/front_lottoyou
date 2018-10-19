export default {
	setUserObject: ({commit}, userObj) => {
		commit('SET_AUTH_USER', userObj);
	},
	setTeamUser: ({commit}, team) => {
		commit('SET_TEAM_USER', team);
	},
	clearAuthUser: ({commit}) => {
		commit('CLEAR_AUTH_USER');
	} 
};
