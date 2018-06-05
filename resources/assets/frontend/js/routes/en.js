export default {
  	routes: [
  		{
  			path: '/',
	        component: require('../components/MainComponent.vue'),
  			children: [
  				{ 
  					path: '', 
  					name: 'home', 
  					component: require('../components/HomeComponent.vue'),
			        props: true
  				},
  				{   
			  		path: 'create_your_league',
			        name: 'create_your_league', 
			        props: true,
			        component: require('../components/VcCreateYourLeague.vue')
			    },
                {
                    path: 'help',
                    name: 'help',
                    props: true,
                    component: require('../components/VcHelp.vue')
                },
                {
                    path: 'privacy',
                    name: 'privacy',
                    props: true,
                    component: require('../components/VcPrivacy.vue')
                },
                {
                    path: 'play_protection',
                    name: 'play_protection',
                    props: true,
                    component: require('../components/VcPlayerProtection.vue')
                },
                {
			  		path: 'how_to_play_soccer_expert',
			        name: 'how_to_play_soccer_expert', 
			        props: true,
			        component: require('../components/VcHowToPlaySoccerExpert.vue')
			    },
			    {   
			  		path: 'how_to_play_easy_money',
			        name: 'how_to_play_easy_money',
			        props: true,
			        component: require('../components/VcHowToPlayEasyMoney.vue')
			    },
			  	{   
			  		path: 'login',
			        name: 'login', 
			        props: true,
			        component: require('../components/LoginComponent.vue')
			    },  
			    {   
			  		path: 'register',
			        name: 'users.register', 
			        props: true,
			        component: require('../components/User/RegisterComponent.vue')
			    },  
			    {   
			  		path: 'users/forgot_password',
			        name: 'users.forgot_password', 
			        props: true,
			        component: require('../components/User/ForgotPasswordComponent.vue')
			    }, 
			    {   
			  		path: 'users/account',
			        name: 'users.account',
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/AccountComponent.vue')
			    },
			    {   
			  		path: 'users/games',
			        name: 'users.games',
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/Game/VcGame.vue')
			    },
			    {   
			  		path: 'users/logout',
			        name: 'users.logout',
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/LogoutComponent.vue')
			    },
			    {   
			  		path: 'users/orders',
			        name: 'users.orders', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/Order/VcIndex.vue')
			    },
			    {   
			  		path: 'orders/show/:id',
			        name: 'orders.show', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Order/VcShow.vue')
			    },
			    {   
			  		path: 'users/transactions',
			        name: 'users.transactions',
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/Transaction/TransactionComponent.vue')
			    },
			    {   
			  		path: 'scratch_cards',
			        name: 'scratch_cards.index', 
			        props: true,
			        component: require('../components/ScratchCard/IndexComponent.vue')
			    },
			    {   
			  		path: '/soccer_expert',
			        name: 'soccer_expert.index', 
			        component: require('../components/SoccerExpert/IndexComponent.vue')
			    },
			    {   
			  		path: 'soccer_expert/show/:id/:hash?',
			        name: 'soccer_expert.show', 
			        props: true,
			        component: require('../components/SoccerExpert/ShowComponent.vue')
			    },
			    {   
			  		path: '/soccer_expert/ranks/:id',
			        name: 'soccer_expert.ranks', 
			        props: true,
			        component: require('../components/SoccerExpert/VcRank.vue')
			    },
			    {   
			  		path: '/soccer_expert/results/:id',
			        name: 'soccer_expert.results', 
			        props: true,
			        component: require('../components/SoccerExpert/ResultComponent.vue')
			    },
			    {   
			  		path: '/soccer_groups/ranking/:id',
			        name: 'soccer_groups.ranking', 
			        props: true,
			        component: require('../components/SoccerGroup/VcRanking.vue')
			    },
			    {   
			  		path: 'lotteries',
			        name: 'lotteries.index', 
			        component: require('../components/Lottery/IndexComponent.vue')
			    },
			    {   
			  		path: 'lotteries/show/:id/:hash?',
			        name: 'lotteries.show', 
			        props: true,
			        component: require('../components/Lottery/ShowComponent.vue')
			    },
			    {   
			  		path: 'lotteries/results/:id',
			        name: 'lotteries.results', 
			        props: true,
			        component: require('../components/Lottery/Result/VcIndex.vue')
			    },
			    {   
			  		path: 'cart',
			        name: 'cart.index', 
			        props: true,
			        //meta: { requiresAuth: true },
			        component: require('../components/Cart/IndexComponent.vue')
			    },
			    {   
			  		path: 'balances',
			        name: 'balances.index', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Balance/IndexComponent.vue')
			    },
			    {   
			  		path: 'balances/deposit',
			        name: 'balances.deposit', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Balance/DepositComponent.vue')
			    },
			    {   
			  		path: 'terms',
			        name: 'terms',
			        props: true,
			        component: require('../components/VcTerms')
			    },
			    {   
			  		path: '/orders',
			        name: 'orders.index', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Order/IndexComponent.vue')
			    },
			    {   
			  		path: '/orders/finish',
			        name: 'orders.finish', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Order/FinishComponent.vue')
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}