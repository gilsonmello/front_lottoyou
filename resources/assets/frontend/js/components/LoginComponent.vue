<template>
	<div class="modal fade modal-login" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
        <div class="modal-dialog modal-md">
        	<div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header items-center" style="border-bottom: none;">
                	<img src="/imgs/logo.png" style="width: 125px; height: 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body" v-if="loading.component == true">
                	{{ trans('strings.loading') }}...
                </div>
                <!-- Modal body -->
                <div class="modal-body" v-else>
                    <form @submit.prevent="login" class="login-form">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<h5 class="text-center">Faça login em sua conta</h5>
                    		</div>
                    	</div>
						<div class="row">
							<div class="col-12 col-lg-12" v-if="errors.credentials">
								<div class="alert alert-danger">
									{{ errors.credentials }}
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
								    <label for="email">{{ trans('strings.email') }}</label>
								    <input v-model="email" required type="email" class="form-control" id="email" aria-describedby="email" :placeholder="trans('strings.email')">
							  	</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group" style="position: relative;">
								    <label for="password">{{ trans('strings.password') }}</label>
								    <input v-model="password" required type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
								    <span class="fa fa-eye view-password" @click.prevent="viewPassword($event)">
								    	
								    </span>
							  	</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<router-link class="pull-right" :to="{ name: 'users.forgot_password' }">
									{{ trans('strings.I_forgot_my_password') }}
								</router-link>
								<router-link style="margin-right: 10px;" class="pull-right" :to="{ name: 'users.register' }">
									{{ trans('strings.register') }}
								</router-link>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">							
								<button v-if="loading.login" style="width: 100%;" @click.prevent="" type="load" class="btn btn-md btn-primary">
									<i class="fa fa-refresh fa-spin"></i>
								</button>
								<button v-else type="submit" class="btn btn-md btn-primary" style="width: 100%;">
									{{ trans('strings.to_enter') }}
								</button>
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer">
					<a class="btn btn-block btn-social btn-facebook" @click.prevent="loginFacebook">
						<span class="fa fa-facebook"></span> Entre com o facebook
					</a>
                </div>
            </div>
        </div>
    </div>
	<!-- <div class="container">
		<h1 class="page-header text-center">Faça login em sua conta</h1>
		<form @submit.prevent="login">
			<div class="row">
				<div class="col-lg-8 col-12 col-sm-12 col-md-8">
					<div class="row">
						<div class="col-12 col-lg-12" v-if="errors.credentials">
							<div class="alert alert-danger">
								{{ errors.credentials }}
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							    <label for="email">{{ trans('strings.email') }}</label>
							    <input v-model="email" required type="email" class="form-control" id="email" aria-describedby="email" :placeholder="trans('strings.email')">
						  	</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							    <label for="password">{{ trans('strings.password') }}</label>
							    <input v-model="password" required type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<button type="submit" class="pull-right btn btn-md btn-success">
								{{ trans('strings.login') }}
							</button>							
							<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-success">
								<i class="fa fa-refresh fa-spin"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12 col-md-4 col-sm-12 text-center">
					<img class="img-fluid" src="https://www.lottoland.com/cms/5a4ca7d90eb3587d99647503/br_yellow_homepage_286x406.jpg">
				</div>
			</div>
		</form>  -->
</template>
<script>
	import { mapGetters } from 'vuex';
	import { routes, getHeaders } from '../api_routes';
	export default {
		data () {
			return {
				email: '',
				password: '',
				errors: {},
				loading: {
					component: true,
					login: false
				},
				facebook: {}
			}
		},
		watch: {

		},
		computed: {
            ...mapGetters([
				'auth',
				'loginOptions'
            ])
		},
		watch: {
			facebook (newValue, oldValue) {
				if(newValue.status === 'connected') {
					window.FB.api('/me', {
						fields: 'id,email,first_name,last_name,middle_name,name,name_format,picture,short_name',
						debug: 'all'
					}, (responseF) => {
						//this.userExistsRequest(responseF);
						var registerRequest = axios.create();
						registerRequest.interceptors.request.use(config => {
							return config;
						});
						//Fazendo requisição para criar o usuário
						registerRequest.post(routes.users.create_from_facebook, qs.stringify({
							name: responseF.first_name,
							last_name: responseF.last_name,
							email: responseF.email,
							short_name: responseF.short_name,
						})).then((response) => {
							if(response.status === 200) {
								window.localStorage.setItem('access_token', JSON.stringify(response.data.access_token));
								window.localStorage.setItem('refresh_token', JSON.stringify(response.data.refresh_token));
								this.refreshAuth();
								$('.modal-login').modal('hide');
								//window.location.reload();
								this.$router.push({name: 'home'});
							}
						}).catch((error) => {

						});
					});
				} else {
					this.$store.dispatch('clearAuthUser');
					window.localStorage.removeItem('authUser');
					window.localStorage.removeItem('access_token');
					window.localStorage.removeItem('refresh_token');
				}
			}
		},
		mounted () {
			this.loading.component = false;
			/* FB.getLoginStatus((response) => {
			    this.facebook = response;
			}); */
			var interval = setInterval(() => {
				if($('.modal-login').length > 0) {
					clearInterval(interval);
					$('.modal-login').on('shown.bs.modal', (event) => {
						this.loading.component = false;
					});

					$('.modal-login').on('hidden.bs.modal', (event) => {
						this.email = '';
						this.password = '';
						this.errors = {};
						this.loading.component = true;
					});
				}
			})
		},
		methods: {
			userExistsRequest (responseF) {
				let userExistsRequest = axios.create();
				userExistsRequest.interceptors.request.use(config => {
					return config;
				});
				let url = routes.users.exists;
				//Fazendo requisição para criar o usuário
				userExistsRequest.post(url, {
					email: responseF.email
				}).then((response) => {
					if (response.status === 200) {
						window.localStorage.setItem('access_token', JSON.stringify(response.data.access_token));
						window.localStorage.setItem('refresh_token', JSON.stringify(response.data.refresh_token));
						let access_token = response.data.access_token;
						let refresh_token = response.data.refresh_token;
						
						let loginRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						loginRequest.get(routes.auth.user, { headers: {
							'Content-Type' : 'application/json',
							'Accept' : 'application/json',
	    					'Authorization': 'Bearer ' + access_token
						}}).then(response_2 => {
				        	response_2.data.access_token = access_token;
							response_2.data.refresh_token = refresh_token;

                            let authUser = response_2.data;
							//window.localStorage.setItem('authUser', JSON.stringify(authUser));
							this.$store.dispatch('setUserObject', authUser);
		                  	
		                  	//window.location.reload();
							$('.modal-login').modal('hide');
		                  	this.$router.push({name: 'home'});
		                
		                }).catch((error_2) => {

		                });
					}
				}).catch((error) => {
					var registerRequest = axios.create();
					registerRequest.interceptors.request.use(config => {
						return config;
					});
					//Fazendo requisição para criar o usuário
					registerRequest.post(routes.users.create_from_facebook, qs.stringify({
						name: response.first_name,
						last_name: response.last_name,
						email: response.email,
						short_name: response.short_name,
					})).then((response2) => {
						if(response2.status === 200) {
							//window.localStorage.setItem('authUser', JSON.stringify(response2.data));
							this.$store.dispatch('setUserObject', response2.data);
							//$('.modal-login').modal('hide');
							//window.location.reload();
							this.$router.push({name: 'home'});
						}
					}).catch((error) => {

					});
				});
			},
			logoutFacebook () {
				window.FB.logout((response) => {
					
				});
			},
			loginFacebook () {
				window.FB.login((response) => {
					this.facebook = response;
				}, {scope: 'public_profile,email,user_birthday'});
			},
			viewPassword (event) {
				var target = $(event.target);
				
				target.removeClass('animate-zoom');

				var input = $(this.$el).find('#password');
				if(input.attr('type') == 'password') {
					input.attr('type', 'text');
					target
						.removeClass('fa-eye')
						.addClass('fa-lock');
				} else {
					input.attr('type', 'password');
					target.removeClass('fa-lock')
						.addClass('fa-eye');
				}

				var interval = setInterval(() => {
					if(!target.hasClass('animate-zoom')) {
						target.addClass('animate-zoom');
						clearInterval(interval);
					}
				})
				
			},
			login () {
				const data = {
		            grant_type: 'password',
		            client_id: 2,
		            client_secret: 'FFBwHK6RqXUjcLoaSGFpb7b2gUU3aMNdkXqgL4EJ',
		            username: this.email,
		            password: this.password,
		            scope: '*',
		        };

				//Emitindo um evento 'Fazendo login'
				this.$eventBus.$emit('signingIn', true);
		        var loginRequest = axios.create();
		        loginRequest.interceptors.request.use(config => {
		        	this.loading.login = true;
				  	return config;
				});

				loginRequest.post(routes.auth.login, qs.stringify(data)).then(response => {
					
					if (response.status === 200) {

						window.localStorage.setItem('access_token', JSON.stringify(response.data.access_token));
						window.localStorage.setItem('refresh_token', JSON.stringify(response.data.refresh_token));

						//this.$router.push({name: 'users.account'});

						let time = setInterval(() => {
							if(this.auth) {
								var header = $('.header');
								$('body').css({
					    			'padding-top': header[0].clientHeight - 1
						    	});
						    	clearInterval(time);
					    	}
						});
			        	
			        	let access_token = response.data.access_token;
                        let refresh_token = response.data.refresh_token;

						let userRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						userRequest.get(routes.auth.user, getHeaders())
							.then(response_2 => {
								this.email = '';
								this.password = '';
								this.errors = {};
								this.loading.login = false;
								response_2.data.access_token = access_token;
								response_2.data.refresh_token = refresh_token;

								let authUser = response_2.data;
								
								window.axios.defaults.headers.common = getHeaders().headers;
								
								//window.localStorage.setItem('authUser', JSON.stringify(authUser));

								this.$store.dispatch('setUserObject', authUser);
								
								//window.location.reload();

								$('.modal-login').modal('hide');

								this.$eventBus.$emit('signingIn', false);
								this.$store.dispatch('setTeamUser', teamRequestResponse.data);

								if(this.loginOptions.redirectToHome === true) {
									this.$router.push({name: 'home'});
								}
							
							}).catch((error_2) => {
								this.loading.login = false;
								this.password = '';
								this.errors = {
									credentials: 'Usuário ou Senha inválidos'
								};
							});
					}
				}).catch((error) => {
					this.loading.login = false;
					if(error.response.data.message != null && error.response.data.message != '') {
						toastr.error(
							error.response.data.message,
							this.trans('strings.error')
						);
					} else {
						this.errors = {
							credentials: 'Usuário ou Senha inválidos'
						};
					}
				});
			}
		},
		activated () {

		},
		components: {
			
		}
	}
</script>

<style scoped>
	.login-form {
	}

	.view-password {
	    position: absolute;
	    right: 1%;
	    /* top: 0; */
	    font-size: 20px;
	    bottom: 14%;
	    opacity: 0.9;
	    cursor: pointer;
	}
</style>