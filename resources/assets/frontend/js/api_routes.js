export const protocol = "http://"
export const enviroment = "local";
export const host = enviroment == "production" ? "http://pi.mirandafitness.com.br" : "http://localhost:8000";

export const routes = {
	auth: {
		login: host+'/oauth/token',
		user: host+'/api/user'
	},
	users: {
		create: host+'/users',
		edit: host+'/{id}/user',
		logged: host+'/users/logged',
		logout: host+'/users/logout'
	},
	packages: {
		create: host+'/packages',
		index: host+'/packages',
		show: host+'/packages/{slug}',
		find: host+'/packages/find/{id}',
	},
	scratch_cards: {
		index: host+'/scratch_cards'
	},
	scratch_card_themes: {
		index: host+'/scratch_card_themes'
	}
};