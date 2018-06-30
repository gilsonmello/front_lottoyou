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
                	Carregando...
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
								<!--<router-link class="pull-right" :to="{ name: 'users.forgot_password' }">
									{{ trans('strings.I_forgot_my_password') }}
								</router-link>-->
								<router-link class="pull-right" :to="{ name: 'ask' }">
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
                <!-- Modal footer -->
                <div class="modal-footer">
                	<!-- <fb:login-button 
					  scope="public_profile,email"
					  onlogin="authLogin">
					</fb:login-button> -->
                    <button type="button" class="btn btn-info" @click="loginFacebook" data-dismiss="modal">
						Facebook
                    </button>
					<button type="button" class="btn btn-info" @click="logoutFacebook" data-dismiss="modal">
						Sair
                    </button>
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
	import {mapGetters} from 'vuex'
	import {routes} from '../api_routes'
	import LoadComponent from './Load'
	export default {
		data: function() {
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
                'auth'
            ])
		},
		watch: {
			facebook(newValue, oldValue) {
				if(newValue.status === 'connected') {
					console.log('connected')
					window.FB.api('/me?debug=all&fields=public_profile', (response) => {
						console.log(response);
					});
				} else if(newValue.status === 'not_authorized') {
					console.log('not_authorized')
				} else {
					console.log('error')
				}
			}
		},
		mounted: function() {
			this.loading.component = false;
			
			FB.getLoginStatus((response) => {
			    this.facebook = response;
			});
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
			logoutFacebook() {
				window.FB.logout((response) => {
					console.log(response)
				});
			},
			loginFacebook() {
				window.FB.login((response) => {
					this.facebook = response;
				});
			},
			authLogin() {
				console.log(this.facebook)
				if(this.facebook.status === 'connected') {

				} else if(this.facebook.status === 'not_authorized') {

				} else {

				}
			},
			viewPassword(event) {
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
			login: function() {
				const data = {
		            grant_type: 'password',
		            client_id: 2,
		            client_secret: '7UzbybHT5HsZ9x2CX09aZIBSx90KxUDhKdjznNjF',
		            username: this.email,
		            password: this.password,
		            scope: '',
		        };

		        var loginRequest = axios.create();
		        loginRequest.interceptors.request.use(config => {
		        	this.loading.login = true;
				  	return config;
				});

				loginRequest.post(routes.auth.login, qs.stringify(data)).then(response => {
					
					if(response.status === 200) {

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

			        	
			        	var access_token = response.data.access_token;
              			var refresh_token = response.data.refresh_token;
              			
              			var loginRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						loginRequest.get(routes.auth.user, { headers: {
							'Accept': 'application/json',
	    					'Authorization': 'Bearer ' + access_token
						}}).then(response_2 => {
							this.email = '';
							this.password = '';
							this.errors = {};
				        	response_2.data.access_token = access_token;

		        			response_2.data.refresh_token = refresh_token;

		        			var authUser = response_2.data;

							window.localStorage.setItem('authUser', JSON.stringify(authUser));

							this.$store.dispatch('setUserObject', response_2.data);
		                  	
		                  	//window.location.reload();

		                  	this.$router.push({name: 'home'});

		                  	$('.modal-login').modal('hide');
		                
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
					this.errors = {
						credentials: 'Usuário ou Senha inválidos'
					};
				});
			}
		},
		activated: function() {

		},
		components: {
			LoadComponent
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