<template>
	<div class="container">
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
		</form>
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
			window.document.title = window.app.title +' | Login';
		},
		methods: {
			login: function() {
				const data = {
		            grant_type: 'password',
		            client_id: 2,
		            client_secret: 'XopBa1RHDizN1fFhB2UPAVM80VYCr1ekGF7CeGNM',
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
					
					if(response.status === 200){
			        	const authUser = {};
              			authUser.access_token = response.data.access_token
              			authUser.refresh_token = response.data.refresh_token
              			window.localStorage.setItem('authUser', JSON.stringify(authUser))
              			this.$router.push({name: 'users.account'});
	                  	window.location.reload();

              			/*var loginRequest = axios.create();
						//Fazendo busca do usuário logado, para setar na estrutura de dados
						loginRequest.get(routes.auth.user, { headers: {
							'Accept': 'application/json',
	    					'Authorization': 'Bearer ' + authUser.access_token
						}}).then(response_2 => {

				        	$(this.$el).find('[type="load"]').addClass('hide');
				        	$(this.$el).find('[type="submit"]').removeClass('hide');
				        	response_2.data['access_token'] = authUser.access_token;
							window.localStorage.setItem('authUser', JSON.stringify(response_2.data))
		                  	this.$router.push({name: 'users.account'});
		                  	window.location.reload();
		                }).catch((error_2) => {
							this.errors = {
								credentials: 'Usuário ou Senha inválidos'
							};
							$(this.$el).find('[type="load"]').addClass('hide');
		        			$(this.$el).find('[type="submit"]').removeClass('hide');
		                });*/
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
	
</style>