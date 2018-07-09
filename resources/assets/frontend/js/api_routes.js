export const protocol = "http://"
export const enviroment = "production";
export const host = window.location.protocol + '//'+ window.location.hostname + (location.port ? ':'+location.port: '')+'/api';


export const routes = {
	quotation_dolar: host+'/quotation_dolar',
	historic_balances: {
		of_the_user: host+'/historic_balances/of_the_user/{id}'
	},
	recaptcha: {
		check: host+'/recaptcha/check',
	},
	pagseguro: {

	},
	paypal: {
		payment: host+'/paypal/payment',
	},
	contacts: {
		create: host+'/contacts',
        categories: host+'/contacts/categories',
	},
	auth: {
		/*login: host+'/oauth/token',
		user: host+'/api/user'*/
		login: '/oauth/token',
		user: '/api/user'
	},
	countries: {
		index: host+'/countries',
		find: host+'/find/{id}'
	},
	orders: {
		show: host+'/orders/{id}',
		items: host+'/orders/{id}/items',
		generate_order: host+'/orders/generate_order',
	},
	order_items: {
		index: host+'/order_items/{user_id}',
	},
	users: {
		check_token_password_recovery: host+'/users/check_token_password_recovery/{hash}',
		check_token_forgot_password: host+'/users/check_token_forgot_password/{hash}',
		password_recovery: host+'/users/password_recovery/{hash}',
		forgot_password: host+'/users/forgot_password',
		index: host+'/users',
		create: host+'/users',
		edit: host+'/{id}/user',
		logged: host+'/users/logged',
		logout: host+'/users/logout',
		exists: host+'/users/exists',
		update: host+'/users/{id}',
		orders: host+'/users/{id}/orders',
		transactions: host+'/users/{id}/transactions',
		games: host+'/users/{id}/games',
		soccer_experts: host+'/users/{id}/soccer_experts',
		scratch_cards: host+'/users/{id}/scratch_cards',
		lotteries: host+'/users/{id}/lotteries',
		items: host+'/users/{id}/items',
		activate: host+'/users/activate/{hash}',
		check_token_activation: host+'/users/check_token_activation/{token}',
		create_from_facebook: host+'/users/create_from_facebook',
		disable: host+'/users/disable',
	},
	packages: {
		create: host+'/packages',
		index: host+'/packages',
		show: host+'/packages/{slug}',
		find: host+'/packages/find/{id}',
	},
	scratch_cards: {
		index: host+'/scratch_cards',
		jackpot_available: host+'/scratch_cards/{id}/jackpot_available',
	},
	scratch_card_themes: {
		index: host+'/scratch_card_themes',
		jackpot_available: host+'/scratch_card_themes/{id}/jackpot_available',
		demo: host+'/scratch_card_themes/{theme_id}/demo',
		scratch_card: host + '/scratch_card_themes/{theme_id}/scratch_card',
		show: host + '/scratch_card_themes/{theme_id}',
		play: host + '/scratch_card_themes/{theme_id}/{user_id}',
		change_scratch_card: host + '/scratch_card_themes/{scratch_card_id}/{theme_id}/{user_id}/change_scratch_card',
	},
	scratch_card_demo: {
		index: host+'/scratch_card_demo',
		find: host+'/scratch_card_demo/{id}',
	},
	soccer_experts: {
		index: host+'/soccer_experts',
		show: host+'/soccer_experts/{id}',
		results: host+'/soccer_experts/results/{id}',
		ranks: host+'/soccer_experts/ranks/{id}',
		find: host+'/soccer_experts/find/{id}',
	},
	soccer_categories: {
		index: host+'/soccer_categories',
		show: host+'/soccer_categories/{id}'
	},
	lotteries: {
		index: host+'/lotteries',
		show: host+'/lotteries/{id}',
		results: host+'/lotteries/results/{id}',
		find: host+'/lotteries/find/{id}',
		sweepstakes: host+'/lotteries/sweepstakes/{id}',
		sweepstake: host+'/lotteries/sweepstake/{sweepstake_id}',

	},
	carts: {
		store: host + '/carts',
		index: host + '/carts',
		add_scratch_cards: host + '/carts/add_scratch_cards',
		add_soccer_experts: host + '/carts/add_soccer_experts',
		add_lotteries: host + '/carts/add_lotteries',
		destroy: host + '/carts/{hash}',
		complete_purchase: host + '/carts/complete_purchase',
		validate: host + '/carts/validate',
        validate_soccer_expert_fast_payment: host + '/carts/validate_soccer_expert_fast_payment',
        complete_fast_payment_soccer_expert: host + '/carts/complete_fast_payment_soccer_expert',
        validate_lottery_fast_payment: host + '/carts/validate_lottery_fast_payment',
        complete_fast_payment_lottery: host + '/carts/complete_fast_payment_lottery',
	},
	soccer_tickets: {
		games: host + '/soccer_tickets/{ticket_id}/games',
	},
	soccer_rounds: {
		groups: host + '/soccer_rounds/{round_id}/groups',
	},
	soccer_groups: {
		ranking: host + '/soccer_groups/{id}/ranking',
		show: host + '/soccer_groups/{id}',
		find: host + '/soccer_groups/{id}/find',
	}
};