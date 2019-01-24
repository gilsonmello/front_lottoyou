export default {
	SET_AUTH_USER (state, userObj) {
		state.authUser = userObj;
	},
	SET_TEAM_USER (state, team) {
		state.authUser.cartoleando_team = team;
	},
	CLEAR_AUTH_USER (state) {
		state.authUser = null;
	}
};
