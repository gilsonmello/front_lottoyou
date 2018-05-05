export const protocol = "http://"
export const enviroment = "production";
export const host = window.location.protocol + '//'+ window.location.hostname + (location.port ? ':'+location.port: '');


export const routes = {
	auth: {
		login: host+'/oauth/token',
		user: host+'/api/user'
	},
	countries: {
		index: host+'/countries',
		find: host+'/find/{id}'
	},
	users: {
		index: host+'/users',
		create: host+'/users',
		edit: host+'/{id}/user',
		logged: host+'/users/logged',
		logout: host+'/users/logout',
		update: host+'/users/{id}'
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
		show: host+'/lotteries/{id}'
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