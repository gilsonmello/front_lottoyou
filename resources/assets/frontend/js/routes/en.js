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
			        component: require('../components/User/GameComponent.vue')
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
			        component: require('../components/User/OrderComponent.vue')
			    },
			    {   
			  		path: 'users/transactions',
			        name: 'users.transactions',
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/User/TransactionComponent.vue')
			    },
			    {   
			  		path: 'scratch_cards',
			        name: 'scratch_cards.index', 
			        props: true,
			        component: require('../components/ScratchCard/IndexComponent.vue')
			    },
			    {   
			  		path: 'soccer_expert',
			        name: 'soccer_expert.index', 
			        props: true,
			        component: require('../components/SoccerExpert/IndexComponent.vue')
			    },
			    {   
			  		path: 'soccer_expert/:id/:hash?',
			        name: 'soccer_expert.show', 
			        props: true,
			        component: require('../components/SoccerExpert/ShowComponent.vue')
			    },
			    ,
			    {   
			  		path: 'soccer_expert/results/:id',
			        name: 'soccer_expert.results', 
			        props: true,
			        component: require('../components/SoccerExpert/ResultComponent.vue')
			    },
			    {   
			  		path: 'lotteries',
			        name: 'lotteries.index', 
			        props: true,
			        component: require('../components/Lottery/IndexComponent.vue')
			    },
			    {   
			  		path: 'lotteries/:id/:hash?',
			        name: 'lotteries.show', 
			        props: true,
			        component: require('../components/Lottery/ShowComponent.vue')
			    },
			    {   
			  		path: 'lotteries/results/:id',
			        name: 'lotteries.results', 
			        props: true,
			        component: require('../components/Lottery/ResultComponent.vue')
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
			        name: 'terms.index', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Balance/DepositComponent.vue')
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
			    },
			    {   
			  		path: '/orders/:id',
			        name: 'orders.show', 
			        props: true,
			        meta: { requiresAuth: true },
			        component: require('../components/Order/ShowComponent.vue')
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}