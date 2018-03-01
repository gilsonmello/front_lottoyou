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
			        props: true,
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
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}