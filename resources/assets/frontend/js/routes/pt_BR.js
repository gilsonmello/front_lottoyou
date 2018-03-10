//import {getTrans} from '../app.js'
export default {
  	routes: [
  		{
  			path: '/br',
	        component: require('../components/MainComponent.vue'),
  			children: [
  				{ 
  					path: '',
  					name: 'home',
  					component: require('../components/HomeComponent.vue'),
			        props: true,
  				},
			  	{   
			  		path: 'login',
			        name: 'login', 
			        props: true,
			        component: require('../components/LoginComponent.vue')
			    },  
			    {   
			  		path: 'cadastro',
			        name: 'users.register', 
			        props: true,
			        component: require('../components/User/RegisterComponent.vue')
			    },
			    {   
			  		path: 'raspadinhas',
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
			  		path: 'loterias',
			        name: 'lotteries.index', 
			        props: true,
			        component: require('../components/Lottery/IndexComponent.vue')
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}