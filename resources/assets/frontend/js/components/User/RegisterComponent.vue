<template>
	<div class="container">
		<h1 class="page-header text-center">Crie uma conta para jogar nas melhores loterias do mundo</h1>
		<form @submit.prevent="register">
			<div class="row">
				<div class="col-lg-4">
					<img class="img-fluid" src="https://www.lottoland.com/cms/5a4ca7d90eb3587d99647503/br_yellow_homepage_286x406.jpg">
				</div>
				<div class="col-lg-8">
					<div class="row">
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
						<div class="col-lg-6">
							<div class="form-group">
							    <label for="name">{{ trans('strings.name') }}</label>
							    <input v-model="name" required type="name" class="form-control" id="name" aria-describedby="name" :placeholder="trans('strings.name')">
						  	</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							    <label for="last_name">{{ trans('strings.last_name') }}</label>
							    <input v-model="last_name" required type="last_name" class="form-control" id="last_name" aria-describedby="last_name" :placeholder="trans('strings.last_name')">
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
									    <label for="birth_day">{{ trans('strings.day') }}</label>
									    <select v-model="birth_day" class="form-control" id="birth_day">
									      	<option>1</option>
									      	<option>2</option>
									      	<option>3</option>
									      	<option>4</option>
									      	<option>5</option>
									    </select>
								  	</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
									    <label for="birth_month">{{ trans('strings.month') }}</label>
									    <select v-model="birth_month" class="form-control" id="birth_month">
									      	<option value="01">1</option>
									      	<option value="02">2</option>
									      	<option value="03">3</option>
									      	<option value="04">4</option>
									      	<option value="05">5</option>
									    </select>
								  	</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
									    <label for="birth_year">{{ trans('strings.year') }}</label>
									    <select v-model="birth_year" class="form-control" id="birth_year">
									      	<option value="01">1</option>
									      	<option value="02">2</option>
									      	<option value="03">3</option>
									      	<option value="04">4</option>
									      	<option value="05">5</option>
									    </select>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							    <label for="country">{{ trans('strings.country') }}</label>
							    <select v-model="country" class="form-control" id="country">
							      	<option value="01">1</option>
							      	<option value="02">2</option>
							      	<option value="03">3</option>
							      	<option value="04">4</option>
							      	<option value="05">5</option>
							    </select>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<button type="submit" class="pull-right btn btn-md btn-success">
								{{trans('strings.save_button')}}
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	export default {
		data: function() {
			return {
				name: '',
				last_name: '',
				email: '',
				password: '',
				country: '',
				birth_day: '',
				birth_month: '',
				birth_year: '',
				errors: []
			}
		},
		mounted: function() {
			window.document.title = window.app.title +' | '+ this.trans('strings.register');
		},
		methods: {
			register: function() {
				axios.interceptors.request.use(config => {
		        	$(this.$el).find('[type="load"]').removeClass('hide');
		        	$(this.$el).find('[type="submit"]').addClass('hide');
				  	return config;
				});
				//Fazendo requisição para criar o usuário
				axios.post(routes.users.create, qs.stringify({
					name: this.name,
					last_name: this.last_name,
					email: this.email,
					password: this.password,
					birth_day: this.birth_day,
					birth_month: this.birth_month,
					birth_year: this.birth_year,
					country: this.country
				})).then((response) => {
					if(response.status === 200){
						this.name = '';						
						this.last_name = '';
						this.email = '';
						this.password = '';
						this.birth_day = '';
						this.birth_month = '';
						this.birth_year = '';
						this.country = '';
				
						this.$router.push({name: 'home'})
						toastr.options.timeOut = 10000;
						toastr.options.newestOnTop = true
						toastr.options.positionClass = 'toast-top-full-width'
						toastr.success(
							'Verifique sua caixa de e-mail', 
							'Enviamos e-mail de confirmação'
						);
						/*const authUser = {};
              			authUser.access_token = response.data
						window.localStorage.setItem('authUser', JSON.stringify(authUser))
						//Fazendo busca do usuário logado, para setar na estrutura de dados authUser
						axios.get(rt.users.logged, {headers: getHeader()}).then(response => {
							this.name = '';
							this.email = '';
							this.password = '';
							this.confirm_password = '';
							this.birth_date = '';
							this.errors = [];
							this.user_load_create = false;
		                  	authUser.email = response.data.email
		                  	authUser.name = response.data.name
		                  	window.localStorage.setItem('authUser', JSON.stringify(authUser))
		                  	this.$store.dispatch('setUserObject', authUser)
		                  	//this.$router.push({name: 'dashboard'})
							toastr.success('Cadastrado com sucesso');
		                })*/
					}
				}).catch(error => {
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
					this.errors = error.response.data.errors
				})
			}
		}
	}

</script>

<style scoped>
	
</style>