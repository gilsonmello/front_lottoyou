<template>
	<app-load-component v-if="loading.component == true"></app-load-component>
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

		<login-component></login-component>

		<vc-modal></vc-modal>
	</main>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import FooterComponent from './FooterComponent'
	import LoginComponent from './LoginComponent'
	import VcModal from './VcModal'
	import router from '../router'
	import LoadComponent from './Load'
	import AppLoadComponent from './AppLoad'
	import {routes} from '../api_routes'
	export default {
		data() {
			return {
				loading: {
					component: true
				},
				modal: {
					param: null,
					type: ''					
				},
				auth: ''
			}
		},
		methods: {
			init() {
				//Pegando os dados do usuário no localstorage
				var access_token = JSON.parse(window.localStorage.getItem('access_token'));
				access_token = access_token != null ? access_token : null;

				//Token para refresh
				var refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
				refresh_token = refresh_token != null ? refresh_token : '';

				if(access_token) {
					this.refreshAuthPromise()
					.then(response => {
						if(response.status === 200) {
							response.data.access_token = access_token;
				        	response.data.refresh_token = refresh_token;
							window.localStorage.setItem('authUser', JSON.stringify(response.data));
							this.$store.dispatch('setUserObject', response.data);
						}
				    }).catch((error) => {
						
				    });
				}


				this.authUser = JSON.parse(window.localStorage.getItem('authUser'));
				this.$store.dispatch('setUserObject', this.authUser);

				//Requisição para pegar os itens do carrinho salvo
				let cartRequest = axios.create();

				cartRequest.interceptors.request.use(config => {
					this.loading.component = true;
				  	return config;
				});

				//Executando a requisição
				cartRequest.get(routes.carts.index, {
					params: {
						id: this.authUser != null ? this.authUser.id : null
					}
				}).then((response) => {
					if(response.status === 200) {
						//Caso encontrou algum item
						//Seto os items na estruta
						if(response.data.items.length > 0)
		            		this.$store.dispatch('setItems', response.data.items)

		            	this.loading.component = false
					}
				}).catch((error) => {
					this.loading.component = false
				});

				this.onReady();
				this.beforeEach();
			},
			onReady() {
				router.onReady(() => {

					//Verificando se está tentando acessar a página de fininalização de pedido
					if(this.$router.history.current.name == "orders.finish") {
						this.$router.push({
							name: 'orders.index'
						})
					}

					//Verificando se a página necessita de login,
					if(this.$router.history.current.meta.requiresAuth && this.authUser == null) {
						this.$router.push({
							name: 'home'
						})
					}
					
				});
			},
			beforeEach() {
				router.beforeEach((to, from, next) => {
					this.loading.component = true;
					//Pegando os dados do usuário no localstorage
					var access_token = JSON.parse(window.localStorage.getItem('access_token'));
					access_token = access_token != null ? access_token : null;

				    if(to.meta.requiresAuth == true && access_token) {
				    	next();
				    }

				    //Se a rota depende de login
					if(to.meta.requiresAuth == true && access_token == null) {

						//Verificando se é diferente da rota para edição de conta do usuário
						//Pois se não o fizer, a requisição será executada 2 vezes, porque
						//Dentro do component UserAcount é executada uma requisição para pegar os dados
						//Do usuário atualizado
						/*if(to.name != 'users.account') {					

							let refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
							refresh_token = refresh_token != null ? refresh_token : '';

							var loginRequest = axios.create();

							loginRequest.interceptors.request.use(config => {
								this.loading.component = true;
							  	return config;
							});
							//Fazendo busca do usuário logado, para setar na estrutura de dados
							loginRequest.get(routes.auth.user, { headers: {
								'Accept': 'application/json',
								'Authorization': 'Bearer ' + access_token
							}}).then(response => {

								if(response.status === 200) {
						        	response.data.access_token = access_token
						        	
						        	response.data.refresh_token = refresh_token

									window.localStorage.setItem('authUser', JSON.stringify(response.data))

									this.$store.dispatch('setUserObject', response.data);

									this.loading.component = false;

									next();
								}
			                  	
			                }).catch((error) => {
								next({
					                name: 'login'
					            });
			                });
			            } else {
			            	//Se a rota não for para o component UserAccount,
			            	//Verifica se o usuário está logado
			            	//Se estiver logado, deixa passar,
			            	//Se não, redireciona para o login

			            	console.log(access_token)
				            if(access_token) {
					            next()
					        } else {
					            toastr.info('Você já está logado.');
						        next({
						            name: 'home'
						        });
					        }
					    }*/

					    toastr.info('Você precisa está logado.');
				        next(false);
				        this.loading.component = false;
  					} 

				    if(!to.meta.requiresAuth) {
				    	next();
				    }

				});
			}
		},
		watch: {

		},
		beforeCreate() {
			
		},
		beforeMount() {
			
		},
		created() {
			
		},
		mounted() {		
			this.init();		

			router.afterEach((to, from) => {
				this.loading.component = false;
			    var height = $('main').prop('scrollHeight');
			    $('html, body').animate({
			        scrollTop: 0
			    },  300);
			    setTimeout(() => {
			    	if(to.matched.length == 0) {
				    	this.$router.push({name: 'home'});
					}
			    }, 200);

			    //Fechando o modal de login
			    $('.modal').modal('hide');

                var navMain = $("#navbarCollapse");
                navMain.collapse('hide');
			});			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent,
			FooterComponent,
			LoadComponent,
			LoginComponent,
			AppLoadComponent,
			VcModal
		}
	}
</script>

<style>
	
	

</style>