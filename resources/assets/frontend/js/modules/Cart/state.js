const date = new Date();
const month = ((date.getMonth() + 1) < 10) ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1)
export default{
	purchase: {
		quantity: 0,
		total: 0.00,
		coupon: {},
		user_id: null,
		sub_total: 0.00,
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
}