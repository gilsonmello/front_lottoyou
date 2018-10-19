export default {
	setItemLottery: ({state, commit}, items) => {
		commit('SET_ITEM_LOTTERY', items);
	},
	removeItemLottery: ({commit}, items) => {
		commit('REMOVE_ITEM_LOTTERY', items);
	},
	clearLotteies: ({commit}) => {
		commit('CLEAR_LOTTERIES');
	},
	setItemSoccerExpert: ({state, commit}, items) => {
		commit('SET_ITEM_SOCCER_EXPERT', items);
	},
	removeItemSoccerExpert: ({commit}, items) => {
		commit('REMOVE_ITEM_SOCCER_EXPERT', items);
	},
	clearSoccerExpert: ({commit}) => {
		commit('CLEAR_SOCCER_EXPERT');
	},
	setItemScratchCard: ({state, commit}, items) => {
		commit('SET_ITEM_SCRATCH_CARD', items);
	},
	setItemCartoleando: ({state, commit}, items) => {
		commit('SET_ITEM_CARTOLEANDO', items);
	},
	removeItemCartoleando: ({commit}, items) => {
		commit('REMOVE_ITEM_CARTOLEANDO', items);
	},
	clearCartoleando: ({commit}) => {
		commit('CLEAR_CARTOLEANDO');
	},
	removeItemScratchCard: ({commit}, items) => {
		commit('REMOVE_ITEM_SCRATCH_CARD', items);
	},
	clearScratchCard: ({commit}) => {
		commit('CLEAR_SCRATCH_CARD');
	},
	clearPurchase: ({commit}) => {
		commit('CLEAR_PURCHASE');
	},
	setItems: ({state, commit}, items) => {
		commit('SET_ITEMS', items);
	},
};
