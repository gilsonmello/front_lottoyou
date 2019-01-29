export default {
	routes: [
		{
			path: '/',
      component: () => import(`@c/MainComponent.vue`),
			children: [
				{ 
					path: '', 
					name: 'home', 
					component: () => import(`@c/HomeComponent.vue`),
	        props: true
				},
				{   
		  		path: 'create_your_league',
	        name: 'create_your_league', 
	        props: true,
	        component: () => import(`@c/VcCreateYourLeague.vue`)
		    },
        {
          path: 'help',
          name: 'help',
          props: true,
          component: () => import(`@c/VcHelp.vue`)
        },
        {
          path: 'contacts/create',
          name: 'contacts.create',
          props: true,
          component: () => import(`@c/Contact/VcCreate`)
        },
        {
          path: 'privacy',
          name: 'privacy',
          props: true,
          component: () => import(`@c/VcPrivacy.vue`)
        },
        {
          path: 'player_protection',
          name: 'player_protection',
          props: true,
          component: () => import(`@c/VcPlayerProtection.vue`)
        },
        {
		  		path: 'how_to_play_soccer_expert',
	        name: 'how_to_play_soccer_expert', 
	        props: true,
	        component: () => import(`@c/VcHowToPlaySoccerExpert.vue`)
		    },
		    {   
		  		path: 'how_to_play_easy_money',
	        name: 'how_to_play_easy_money',
	        props: true,
	        component: () => import(`@c/VcHowToPlayEasyMoney.vue`)
		    },
		  	{   
		  		path: 'login',
	        name: 'login', 
	        props: true,
	        component: () => import(`@c/LoginComponent.vue`)
		    },  
		    {   
		  		path: 'register',
	        name: 'users.register', 
	        props: true,
	        component: () => import(`@c/User/RegisterComponent.vue`)
		    },
        {
            path: 'users/activate/:hash',
            name: 'users.activate',
            props: true,
            component: () => import(`@c/User/VcActivate.vue`)
        },
		    {   
		  		path: 'users/account',
	        name: 'users.account',
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/VcAccount.vue`)
				},
				{   
					path: 'users/forgot_password',
			  	name: 'users.forgot_password',
			  	props: true,
			  	meta: { },
			  	component: () => import(`@c/User/VcForgotPassword.vue`)
				},
				{   
					path: 'users/password_recovery/:hash',
			  	name: 'users.password_recovery',
			  	props: true,
			  	meta: { },
			  	component: () => import(`@c/User/VcPasswordRecovery`)
		  	},
		    {   
		  		path: 'users/games',
	        name: 'users.games',
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/Game/VcGame.vue`)
		    },
		    {   
		  		path: 'users/logout',
	        name: 'users.logout',
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/LogoutComponent.vue`)
		    },
		    {   
		  		path: 'users/orders',
	        name: 'users.orders', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/Order/VcIndex.vue`)
		    },
		    {   
		  		path: 'users/disable',
	        name: 'users.disable', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/VcDisable.vue`)
		    },
		    {   
		  		path: 'orders/show/:id',
	        name: 'orders.show', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/Order/VcShow.vue`)
		    },
		    {   
		  		path: 'users/transactions',
	        name: 'users.transactions',
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/User/Transaction/TransactionComponent.vue`)
		    },
		    {   
		  		path: 'scratch_cards',
	        name: 'scratch_cards.index', 
	        props: true,
	        component: () => import(`@c/ScratchCard/IndexComponent.vue`)
		    },
		    {   
		  		path: 'soccer_expert',
	        name: 'soccer_expert.index', 
	        component: () => import(`@c/SoccerExpert/IndexComponent.vue`)
		    },
		    {   
		  		path: 'soccer_expert/play/:slug',
	        name: 'soccer_expert.play', 
	        props: true,
	        component: () => import(`@c/SoccerExpert/ShowComponent.vue`)
		    },
		    {   
		  		path: 'soccer_expert/ranks/:slug',
	        name: 'soccer_expert.ranks', 
	        props: true,
	        component: () => import(`@c/SoccerExpert/VcRank.vue`)
		    },
		    {   
		  		path: 'soccer_expert/results/:slug',
	        name: 'soccer_expert.results', 
	        props: true,
	        component: () => import(`@c/SoccerExpert/ResultComponent.vue`)
		    },
		    {   
		  		path: 'soccer_groups/ranking/:id',
	        name: 'soccer_groups.ranking', 
	        props: true,
	        component: () => import(`@c/SoccerGroup/VcRanking.vue`)
		    },
		    {   
		  		path: 'lotteries',
	        name: 'lotteries.index', 
	        component: () => import(`@c/Lottery/IndexComponent.vue`)
		    },
		    {   
		  		path: 'lotteries/results/:slug',
	        name: 'lotteries.results', 
	        props: true,
	        component: () => import(`@c/Lottery/Result/VcIndex.vue`)
		    },
		    {   
		  		path: 'lotteries/play/:slug',
	        name: 'lotteries.play', 
					props: true,
	        component: () => import(`@c/Lottery/ShowComponent.vue`)
		    },
		    {   
		  		path: 'cart',
	        name: 'cart.index', 
	        props: true,
	        //meta: { requiresAuth: true },
	        component: () => import(`@c/Cart/IndexComponent.vue`)
		    },
		    {   
		  		path: 'balances',
	        name: 'balances.index', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/Balance/IndexComponent.vue`)
				},
				{   
					path: 'balances/withdraw',
					name: 'balances.withdraw', 
					props: true,
					meta: { requiresAuth: true },
					component: () => import(`@c/Balance/VcWithdraw.vue`)
				},
		    {   
		  		path: 'balances/deposit',
	        name: 'balances.deposit', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/Balance/DepositComponent.vue`)
				},
				{   
					path: 'balances/withdrawal',
			  	name: 'balances.withdrawal', 
			  	props: true,
			  	meta: { requiresAuth: true },
			  	component: () => import(`@c/Balance/VcWithdrawal.vue`)
		  	},
		    {   
		  		path: 'terms',
	        name: 'terms',
	        props: true,
	        component: () => import(`@c/VcTerms`)
		    },
        {
          path: 'ask',
          name: 'ask',
          props: true,
          component: () => import(`@c/VcAsk`)
        },
		    {   
		  		path: 'orders',
	        name: 'orders.index', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/Order/IndexComponent.vue`)
		    },
		    {   
		  		path: 'orders/finish',
	        name: 'orders.finish', 
	        props: true,
	        meta: { requiresAuth: true },
	        component: () => import(`@c/Order/FinishComponent.vue`)
				},
				{   
					path: 'leagues/:slug',
					name: 'leagues.show', 
					props: true,
					component: () => import(`@c/League/VcShow.vue`)
				},
				{   
					path: 'cartoleando',
					name: 'cartoleando.index', 
					component: () => import(`@c/Cartoleando/VcIndex.vue`)
				},
				{   
					path: 'cartoleando/play/:slug',
					name: 'cartoleando.play', 
					props: true,
					component: () => import(`@c/Cartoleando/VcPlay.vue`)
				},
				{   
					path: 'cartoleando/:slug/leagues',
					name: 'cartoleando.leagues', 
          props: true,
          component: require('@c/Cartoleando/VcLeague.vue')
				},
			]
		}
	],
  linkExactActiveClass: 'active',
  mode: 'history'
};
