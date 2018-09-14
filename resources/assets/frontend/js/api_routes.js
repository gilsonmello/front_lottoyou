export const protocol = "http://"
export const enviroment = "production";
export const host = window.location.protocol + '//'+ window.location.hostname + (location.port ? ':'+location.port: '')+'/api';
const base = window.location.protocol + '//'+ window.location.hostname + (location.port ? ':'+location.port: '');

export const routes = {
	base: base,
	quotation_dolar: host+'/quotation_dolar',
	historic_balances: {
		of_the_user: host+'/historic_balances/of_the_user'
	},
	balance: {
		agent_withdraw: host+'/balances/agent_withdraw',
		paypal_withdraw: host+'/balances/paypal_withdraw',
	},
	recaptcha: {
		check: host+'/recaptcha/check',
	},
	pagseguro: {
		payment: host+'/pagseguro/payment'
	},
	paypal: {
		payment: host+'/paypal/payment',
		feedback: host+'/paypal/feedback',
		cancel: host,
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
		items: host+'/users/items',
		activate: host+'/users/activate/{hash}',
		check_token_activation: host+'/users/check_token_activation/{token}',
		create_from_facebook: host+'/users/create_from_facebook',
		disable: host+'/users/disable',
		add_team: host+'/users/add_team',
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
		show: host+'/soccer_experts/{slug}',
		play: host+'/soccer_experts/play/{slug}',
		results: host+'/soccer_experts/results/{slug}',
		ranks: host+'/soccer_experts/ranks/{slug}',
		find: host+'/soccer_experts/find/{slug}',
	},
	soccer_categories: {
		index: host+'/soccer_categories',
		show: host+'/soccer_categories/{id}'
	},
	lotteries: {
		index: host+'/lotteries',
		show: host+'/lotteries/{slug}',
		play: host+'/lotteries/play/{slug}',
		results: host+'/lotteries/results/{slug}',
		find: host+'/lotteries/find/{slug}',
		awards: host+'/lotteries/awards/{id}',
		sweepstakes: host+'/lotteries/sweepstakes/{slug}',
		sweepstake: host+'/lotteries/sweepstake/{sweepstake_id}',
	},
	carts: {
		store: host + '/carts',
		index: host + '/carts',
		add_scratch_cards: host + '/carts/add_scratch_cards',
		add_soccer_experts: host + '/carts/add_soccer_experts',
		add_cartoleandos: host + '/carts/add_cartoleandos',
		add_lotteries: host + '/carts/add_lotteries',
		destroy: host + '/carts/{hash}',
		complete_purchase: host + '/carts/complete_purchase',
		validate: host + '/carts/validate',
        validate_soccer_expert_fast_payment: host + '/carts/validate_soccer_expert_fast_payment',
        complete_fast_payment_soccer_expert: host + '/carts/complete_fast_payment_soccer_expert',
        validate_lottery_fast_payment: host + '/carts/validate_lottery_fast_payment',
        complete_fast_payment_lottery: host + '/carts/complete_fast_payment_lottery',
        complete_fast_payment_cartoleando: host + '/carts/complete_fast_payment_cartoleando',
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
	},
	leagues: {
		create: host+'/leagues',
		index: host+'/leagues',
		findBySlug: host+'/packages/findBySlug/{slug}',
		find: host+'/leagues/find/{id}',
		awards: host+'/leagues/awards/{slug}',
	},
	fantasy_game: {
		packages: host+'/',
	},
	league_packages: {
		index: host+'/league_packages',
		findBySlug: host+'/league_packages/findBySlug/{slug}',
		find_leagues_by_slug: host+'/league_packages/find_leagues_by_slug/{slug}',
	},
	leagues: {
		index: host+'/leagues',
		show: host+'/leagues/{slug}',
	},
	cartola: {
		find_team_by_slug:  host+'/cartola/find_team_by_slug',
	},
	system: {
		settings: {
			index: host+'/system/settings',
		}
	}
};