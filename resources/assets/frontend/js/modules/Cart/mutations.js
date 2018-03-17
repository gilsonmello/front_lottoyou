
function refreshState (state) {
	//Total de items
	state.quantity = state.lotteries.items.length + state.scratch_cards.items.length + state.soccer_expert.items.length
	
	//Total em dinheiro das loterias
	var amountLotteries = 0;

	state.lotteries.items.filter(function(val) {
		amountLotteries += val.total;
	});

	state.lotteries.total = amountLotteries;

	state.total = state.lotteries.total + state.scratch_cards.total + state.soccer_expert.total;

	return state;
}

export default {
	SET_ITEM_LOTTERY(state, items){

		state.purchase.lotteries.items = state.purchase.lotteries.items.filter(function(val){
			return val.hash != items.hash
		})
		
		state.purchase.lotteries.items.push(items)



		state.purchase = refreshState(state.purchase);
		//state.purchase.lotteries.total = state.purchase.lotteries.items.betting.length
		//state.purchase.quantity = state.purchase.lotteries.items.betting.length + 
		//	state.purchase.scratch_cards.items.length +
		//	state.purchase.soccer_expert.items.length;
	},
	REMOVE_ITEM_LOTTERY(state, items){
		state.purchase.lotteries.items = state.purchase.lotteries.items.filter(function(val){
			return val.hash != items.hash
		})

		state.purchase = refreshState(state.purchase);
	},
	CLEAR_LOTTERIES(state){
		state.purchase.items.lotteries = []
	},
	CLEAR_ITEM_LOTTERY(state, name){
		
	},
	SET_ITEM_SOCCER_EXPERT(state, items){
		
	},
	REMOVE_ITEM_SOCCER_EXPERT(state, items){
		
	},
	CLEAR_SOCCER_EXPERT(state, name){
		
	}
}