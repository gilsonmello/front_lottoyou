//import {getTrans} from '../app.js'
export default {
  	routes: [
  		{
  			path: '/br',
	        component: require('../components/App.vue'),
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
			    }
  			]
  		}
  	],
    linkExactActiveClass: 'active'
}