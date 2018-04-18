
function refreshState (state) {
	//Total de items
	state.quantity = state.lotteries.items.length + state.scratch_cards.items.length + state.soccer_expert.items.length
	
	//Total em dinheiro das loterias
	var amountLotteries = 0;

	//Total em dinheiro dos soccer expert
	var amount_soccer_expert = 0;

	//Total em dinheiro das raspadinhas
	var amount_scratch_card = 0;

	//Filtrando e somando todos os totais das loterias
	state.lotteries.items.filter(function(val) {
		if(typeof val.total == 'string') {
			amountLotteries += parseFloat(val.total);	
		}
		else if(typeof val.total == 'float' || typeof val.total == 'double' || typeof val.total == 'number') {
			amountLotteries += val.total;	
		}
	});

	//Filtrando e somando todos os totais dos soccer experts
	state.soccer_expert.items.filter(function(val) {
		if(typeof val.total == 'string') {
			amount_soccer_expert += parseFloat(val.total);	
		}
		else if(typeof val.total == 'float' || typeof val.total == 'double' || typeof val.total == 'number') {
			amount_soccer_expert += val.total;	
		}
	});

	//Filtrando e somando todos os totais das raspadinhas
	state.scratch_cards.items.filter(function(val) {
		if(typeof val.total == 'string') {
			amount_scratch_card += parseFloat(val.total);	
		}
		else if(typeof val.total == 'float' || typeof val.total == 'double' || typeof val.total == 'number') {
			amount_scratch_card += val.total;	
		}
	});

	//Total da loteria
	state.lotteries.total = amountLotteries;

	//Total do soccer expert
	state.soccer_expert.total = amount_soccer_expert;

	//Total da raspadinha
	state.scratch_cards.total = amount_scratch_card;

	//Total de todos os itens
	state.total = state.lotteries.total + state.scratch_cards.total + state.soccer_expert.total;

	//Novo estado
	return state;
}

export default {
	SET_ITEM_LOTTERY(state, items){

		//Caso o usuário faça 1 aposta e adicione no carrinho e depois faça outra cartela, preciso atualizar o item
		//Removendo o item com base no hash

		var arr = []

		let idx = null

		if(state.purchase.lotteries.items.length == 0) {
			state.purchase.lotteries.items.unshift(items);
		}else {

			state.purchase.lotteries.items.map(function( elem, index, array ) {
				if(elem.hash == items.hash) {
					idx = index
				}
			});

			if(idx == null) {
				state.purchase.lotteries.items.unshift(items);
			}else {
				state.purchase.lotteries.items[idx] = items	
			}

		}


		idx = null
		if(state.purchase.items.length == 0) {
			state.purchase.items.unshift({
				type: 'lottery',
				lottery: items
			});
		}else {

			state.purchase.items.map(function( elem, index, array ) {
				if(elem.lottery != undefined) {
					if(elem.lottery.hash == items.hash) {
						idx = index
					}	
				}
			});

			if(idx == null) {
				state.purchase.items.unshift({
					type: 'lottery',
					lottery: items
				});
			}else {
				state.purchase.items[idx] = {
					type: 'lottery',
					lottery: items
				};	
			}
		}
			
		//Atualizando os dados como totais, quantidades
		state.purchase = refreshState(state.purchase);
		
	},
	REMOVE_ITEM_LOTTERY(state, items){

		state.purchase.lotteries.items = state.purchase.lotteries.items.filter((val) => {
			return val.hash != items.hash
		})

		state.purchase.items = state.purchase.items.filter((val) => {
			if(val.type == 'lottery') {
				if(val.lottery.hash != items.hash) {
					return true
				}else{
					return false
				}
			}else {
				return true;
			}
		});

		state.purchase = refreshState(state.purchase);
	},
	CLEAR_LOTTERIES(state){
		state.purchase.lotteries = [];
	},
	CLEAR_ITEM_LOTTERY(state, name){
		state.purchase.lotteries = [];

		state.purchase.items = state.purchase.items.filter((val) => {
			if(val.type == 'lottery')
				return false
			else
				return true;
		});

		state.purchase = refreshState(state.purchase);
	},
	SET_ITEM_SOCCER_EXPERT(state, items) {
		
		let idx = null

		if(state.purchase.soccer_expert.items.length == 0) {
			state.purchase.soccer_expert.items.unshift(items);
		}else {

			state.purchase.soccer_expert.items.map(function( elem, index, array ) {
				if(elem.hash == items.hash) {
					idx = index
				}
			});

			if(idx == null) {
				state.purchase.soccer_expert.items.unshift(items);
			}else {
				state.purchase.soccer_expert.items[idx] = items	
			}

		}

		idx = null
		if(state.purchase.items.length == 0) {
			state.purchase.items.unshift({
				type: 'soccer_expert',
				soccer_expert: items
			});
		}else {

			state.purchase.items.map(function( elem, index, array ) {
				if(elem.soccer_expert != undefined) {
					if(elem.soccer_expert.hash == items.hash) {
						idx = index
					}
				}
			});

			if(idx == null) {
				state.purchase.items.unshift({
					type: 'soccer_expert',
					soccer_expert: items
				});
			}else {
				state.purchase.items[idx] = {
					type: 'soccer_expert',
					soccer_expert: items
				};	
			}
		}

		//Atualizando os dados como totais, quantidades
		state.purchase = refreshState(state.purchase);

		//console.log(state.purchase.items)
	},
	REMOVE_ITEM_SOCCER_EXPERT(state, items){
		
		//Removendo o item com base no hash
		state.purchase.soccer_expert.items = state.purchase.soccer_expert.items.filter((val) => {
			return val.hash != items.hash
		});

		state.purchase.items = state.purchase.items.filter((val) => {
			if(val.type == 'soccer_expert') {
				if(val.soccer_expert.hash != items.hash) {
					return true
				}else{
					return false
				}
			}
			return true;
		});

		
		//Atualizando os dados como totais, quantidades
		state.purchase = refreshState(state.purchase);
	},
	CLEAR_SOCCER_EXPERT(state, name){
		state.purchase.soccer_expert = [];

		state.purchase = refreshState(state.purchase);
	},
	SET_ITEM_SCRATCH_CARD(state, items) {
		
		let idx = null

		if(state.purchase.scratch_cards.items.length == 0) {
			state.purchase.scratch_cards.items.unshift(items);
		}else {

			state.purchase.scratch_cards.items.map(function( elem, index, array ) {
				if(elem.hash == items.hash) {
					idx = index
				}
			});

			if(idx == null) {
				state.purchase.scratch_cards.items.unshift(items);
			}else {
				state.purchase.scratch_cards.items[idx] = items	
			}

		}

		idx = null

		//Verificando se existe algum item
		if(state.purchase.items.length == 0) {
			//Caso não tenha, faço inserção do item do tipo raspadinha
			state.purchase.items.unshift({
				type: 'scratch_card',
				scratch_card: items
			});
		}else {

			//Se não é porque já possui item
			//Verifico se o item passado no array existe
			state.purchase.items.map(function( elem, index, array ) {
				//
				if(elem.scratch_card != undefined) {
					if(elem.scratch_card.hash == items.hash) {
						idx = index
					}
				}
			});

			//Se não encontrou nenhum item com o mesmo hash, é porque não existe e então insiro 
			//O novo item de raspadinha
			if(idx == null) {
				state.purchase.items.unshift({
					type: 'scratch_card',
					scratch_card: items
				});
			}else {
				//Se não faço alteração do item com base no indice que encontrei na verificação dos hash's
				state.purchase.items[idx] = {
					type: 'scratch_card',
					scratch_card: items
				};	
			}
		}

		//Atualizando os dados como totais, quantidades
		state.purchase = refreshState(state.purchase);
	},
	REMOVE_ITEM_SCRATCH_CARD(state, items){
		
		//Removendo o item com base no hash
		state.purchase.scratch_cards.items = state.purchase.scratch_cards.items.filter((val) => {
			return val.hash != items.hash
		});

		state.purchase.items = state.purchase.items.filter((val) => {
			if(val.type == 'scratch_card') {
				if(val.scratch_card.hash != items.hash) {
					return true
				}else{
					return false
				}
			}
			return true;
		});
		
		//Atualizando os dados como totais, quantidades
		state.purchase = refreshState(state.purchase);
	},
	CLEAR_SCRATCH_CARD(){
		state.purchase.soccer_expert = [];

		state.purchase = refreshState(state.purchase);
	},
	CLEAR(state) {
		state = {
			purchase: {
				quantity: 0,
				total: 0.00,
				lotteries: {
					total: 0.00,
					items: []
				},
				scratch_cards: {
					total: 0.00,
					items: []
				},
				soccer_expert: {
					total: 0.00,
					items: []
				},
				items: []
			}
		};
	},
	SET_ITEMS(state, items) {
		
		items.map((elem, index, array) => {
			if(elem.type == 'soccer_expert') {
				state.purchase.items.push({
					type: elem.type,
					soccer_expert: JSON.parse(elem.data)
				})
				state.purchase.soccer_expert.items.push(JSON.parse(elem.data))
			}else if(elem.type == 'lottery') {
				state.purchase.items.push({
					type: elem.type,
					lottery: JSON.parse(elem.data)
				})
				state.purchase.lotteries.items.push(JSON.parse(elem.data))
			}else {
				state.purchase.items.push({
					type: elem.type,
					scratch_card: JSON.parse(elem.data)
				})
				state.purchase.scratch_cards.items.push(JSON.parse(elem.data))
			}
		})

		state.purchase = refreshState(state.purchase);
	}
}