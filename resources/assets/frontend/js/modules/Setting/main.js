import state from './state'
import mutations from './mutations'
import actions from './actions'

export default{
	state,
	mutations,
	actions,
	getters: {
	    systemSettings: state => {
	      	return state.settings;
		},
		getSystemCurrency (state) {
			if(state.settings.length != 0) {
				let index = undefined;
				let currency = state.settings.filter((element, i) => {					
					if(element.name === 'currency') {
						index = i;
						return true;
					}
					return false;
				});
				currency[index].data = JSON.parse(currency[index].data);
				return currency[index];
			}
			return {
				name: 'currency',
				data: {
					"value": "BRL", 
					"symbol": "R$"
				}
			};
		}
  	}
}