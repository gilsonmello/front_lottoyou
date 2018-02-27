export default {
  	routes: [
  		{
  			path: '/es',
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
			  		path: 'cadastri',
			        name: 'users.register', 
			        props: true,
			        component: require('../components/User/RegisterComponent.vue')
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}