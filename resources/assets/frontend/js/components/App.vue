<template>
	<load-component v-if="loading.component == true"></load-component>
	<main role="main" v-else>
		<header-component></header-component>
		<section class="content">
			<transition name="fade" mode="out-in">
	            <keep-alive>
					<router-view></router-view>
				</keep-alive>
			</transition>
		</section>
		<br>
		<footer-component></footer-component>

	</main>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import FooterComponent from './FooterComponent'
	import router from '../router'
	import LoadComponent from './Load'
	import {routes} from '../api_routes'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				},
				modal: {
					param: null,
					type: ''					
				}
			}
		},
		methods: {
			openModal() {
				console.log('s');
			}
		},
		watch: {

		},
		beforeCreate: function() {
			
		},
		beforeMount: function() {
			this.loading.component = true
		},
		created: function() {
			
		},
		mounted: function() {

			this.loading.component = false

			router.onReady(() => {
				let authUser = JSON.parse(window.localStorage.getItem('authUser'));
				
				this.$store.dispatch('setUserObject', authUser);


				//Requisição para pegar os itens do carrinho salvo
				let cartRequest = axios.create();

				//Executando a requisição
				cartRequest.get(routes.carts.index, {
					params: {
						id: authUser != null ? authUser.id : null
					}
				}).then((response) => {
					if(response.status === 200) {
						//Caso encontrou algum item
						//Seto os items na estruta
						if(response.data.items.length > 0)
		            		this.$store.dispatch('setItems', response.data.items)
					}
				}).catch((error) => {

				})

				if(this.$router.history.current.name == "orders.finish") {
					this.$router.push({
						name: 'orders.index'
					})
				}
			});
			
			router.beforeEach((to, from, next) => {
				//Pegando os dados do usuário no localstorage
				const authUser = JSON.parse(window.localStorage.getItem('authUser'));

				//Se a rota depende de login
				if(to.meta.requiresAuth == true) {

					//Verificando se é diferente da rota para edição de conta do usuário
					//Pois se não o fizer, a requisição será executada 2 vezes, porque
					//Dentro do component UserAcount é executada uma requisição para pegar os dados
					//Do usuário atualizado
					if(to.name != 'users.account') {
						let authUser = JSON.parse(window.localStorage.getItem('authUser'));
						authUser = authUser != null ? authUser : {access_token: '', refresh_token: ''}

						var loginRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						loginRequest.get(routes.auth.user, { headers: {
							'Accept': 'application/json',
							'Authorization': 'Bearer ' + authUser.access_token
						}}).then(response => {

				        	response.data.access_token = authUser.access_token
				        	
				        	response.data.refresh_token = authUser.refresh_token

							window.localStorage.setItem('authUser', JSON.stringify(response.data))

							this.$store.dispatch('setUserObject', response.data);

							next()
		                  	
		                }).catch((error) => {
							next({
				                name: 'login'
				            });
		                });
		            }else {
		            	//Se a rota não for para o component UserAccount,
		            	//Verifica se o usuário está logado
		            	//Se estiver logado, deixa passar,
		            	//Se não, redireciona para o login
			            if(authUser){
				            next()
				        }else{
				            next({
				                name: 'login'
				            })
				        }
				    }
			    }
			    //Se estou logado e estou tentando acessar a rota de login
		        if(to.name == 'login' && authUser){
			        toastr.info('Você já está logado.');
			        next({
			            name: 'home'
			        });
			    }else{
			        next();
			    }
			});

			router.afterEach((to, from) => {
			    var height = $('main').prop('scrollHeight');
			    $('html, body').animate({
			        scrollTop: 0
			    },  300);
			    setTimeout(() => {
			    	if(to.matched.length == 0) {
				    	this.$router.push({name: 'home'});
					}
			    }, 200)
			});			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent,
			FooterComponent,
			LoadComponent
		}
	}
</script>

<style>
	
	

</style>