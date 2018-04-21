<template>
	<div class="modal fade modal-login" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header items-center" style="border-bottom: none;">
                	<img src="/imgs/logo.png" style="width: 125px; height: 50;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
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
								    <span class="fa fa-eye view-password animate-zoom" @click.prevent="viewPassword($event)">
								    	
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
								<button type="submit" class="btn btn-md btn-success" style="width: 100%;">
									{{ trans('strings.to_enter') }}
								</button>							
								<button style="width: 100%;" @click.prevent="" type="load" class="hide btn btn-md btn-success">
									<i class="fa fa-refresh fa-spin"></i>
								</button>
							</div>
						</div>
					</form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">
                        {{ trans('strings.to_close') }}
                    </button> -->
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
	</div>
</template>
<script>
	import {routes} from '../api_routes'
	export default {
		data: function() {
			return {
				email: '',
				password: '',
				errors: []
			}
		},
		watch: {

		},
		mounted: function() {
			
		},
		methods: {
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
		            client_secret: 'e0ik4iiagLtSCWXMAym6rNOo0vS3oOvwHFpn2gEa',
		            username: this.email,
		            password: this.password,
		            scope: '',
		        };
		        var loginRequest = axios.create();
		        loginRequest.interceptors.request.use(config => {
		        	$(this.$el).find('[type="load"]').removeClass('hide');
		        	$(this.$el).find('[type="submit"]').addClass('hide');
				  	return config;
				});

				loginRequest.post(routes.auth.login, qs.stringify(data)).then(response => {
					
					if(response.status === 200) {

						window.localStorage.setItem('access_token', JSON.stringify(response.data.access_token));
						window.localStorage.setItem('refresh_token', JSON.stringify(response.data.refresh_token));

						this.$router.push({name: 'users.account'});
			        	/*
			        	var access_token = response.data.access_token
              			var refresh_token = response.data.refresh_token
              			
              			var loginRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						loginRequest.get(routes.auth.user, { headers: {
							'Accept': 'application/json',
	    					'Authorization': 'Bearer ' + access_token
						}}).then(response_2 => {

				        	response_2.data.access_token = access_token
		        	
		        			response_2.data.refresh_token = refresh_token

		        			var authUser = response_2.data;

							window.localStorage.setItem('authUser', JSON.stringify(authUser));

							this.$store.dispatch('setUserObject', response_2.data);
		                  	
		                  	//window.location.reload();

		                  	this.$router.push({name: 'users.account'});
		                  	
		                  	
		                
		                }).catch((error_2) => {
							this.errors = {
								credentials: 'Usuário ou Senha inválidos'
							};
							$(this.$el).find('[type="load"]').addClass('hide');
		        			$(this.$el).find('[type="submit"]').removeClass('hide');
		                });
		                */
					}
				}).catch((error) => {
					$(this.$el).find('[type="load"]').addClass('hide');
        			$(this.$el).find('[type="submit"]').removeClass('hide');
					this.errors = {
						credentials: 'Usuário ou Senha inválidos'
					};
				});
			}
		},
		activated: function() {

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