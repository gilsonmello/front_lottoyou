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
		jackpot_available: host+'/scratch_cards/{id}/jackpot_available'
	},
	scratch_card_themes: {
		index: host+'/scratch_card_themes',
		jackpot_available: host+'/scratch_card_themes/{id}/jackpot_available',
		demo: host+'/scratch_card_themes/{theme_id}/demo'
	},
	scratch_card_demo: {
		index: host+'/scratch_card_demo',
		find: host+'/scratch_card_demo/{id}',
	},
	soccer_expert: {
		index: host+'/soccer_expert',
		show: host+'/soccer_expert/{id}',
		results: host+'/soccer_expert/results/:id'
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
		store: host+'/carts'
	}
};