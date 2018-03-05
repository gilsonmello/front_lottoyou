<template>
	<div class="container">
		<h1 class="page-header text-center">Crie uma conta para jogar nas melhores loterias do mundo</h1>
		<form @submit.prevent="register">
			<div class="row">
				<div class="col-lg-8 col-12 col-sm-12 col-md-8">
					<div class="row">
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<div class="alert alert-danger" v-if="errors.email">
								  	<div v-for="email in errors.email" >{{ email }}</div>
								</div>
							    <label for="email">{{ trans('strings.email') }}</label>
							    <input v-model="email" required type="email" class="form-control" id="email" aria-describedby="email" :placeholder="trans('strings.email')">
						  	</div>
						</div>
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<div class="alert alert-danger" v-if="errors.password">
								  	<div v-for="password in errors.password" >{{ password }}</div>
								</div>
							    <label for="password">{{ trans('strings.password') }}</label>
							    <input v-model="password" required type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<div class="alert alert-danger" v-if="errors.name">
								  	<div v-for="name in errors.name" >{{ name }}</div>
								</div>
							    <label for="name">{{ trans('strings.name') }}</label>
							    <input v-model="name" required type="name" class="form-control" id="name" aria-describedby="name" :placeholder="trans('strings.name')">
						  	</div>
						</div>
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<div class="alert alert-danger" v-if="errors.last_name">
								  	<div v-for="last_name in errors.last_name" >{{ last_name }}</div>
								</div>
							    <label for="last_name">{{ trans('strings.last_name') }}</label>
							    <input v-model="last_name" required type="last_name" class="form-control" id="last_name" aria-describedby="last_name" :placeholder="trans('strings.last_name')">
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12 col-sm-6 col-md-12">
							<div class="row">
								<div class="col-lg-4 col-sm-6 col-md-4 col-6">
									<div class="form-group">
										<div class="alert alert-danger" v-if="errors.birth_day">
										  	<div v-for="birth_day in errors.birth_day" >{{ birth_day }}</div>
										</div>
									    <label for="birth_day">{{ trans('strings.day') }}</label>
									    <select v-model="birth_day" class="form-control" id="birth_day">
									      	<option :value="day" v-for="day in days">
									      		{{ day }}
									      	</option>
									    </select>
								  	</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-md-4 col-6">
									<div class="form-group">
										<div class="alert alert-danger" v-if="errors.birth_month">
										  	<div v-for="birth_month in errors.birth_month" >{{ birth_month }}</div>
										</div>
									    <label for="birth_month">{{ trans('strings.month') }}</label>
									    <select v-model="birth_month" class="form-control" id="birth_month" @change="changeBirthMonth">
									      	<option :value="month.value" :data-key="key" v-for="(month, key) in months">
									      		{{ month.name }}
									      	</option>
									    </select>
								  	</div>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-12 col-12">
									<div class="form-group">
										<div class="alert alert-danger" v-if="errors.birth_year">
										  	<div v-for="birth_year in errors.birth_year" >{{ birth_year }}</div>
										</div>
									    <label for="birth_year">{{ trans('strings.year') }}</label>
									    <select v-model="birth_year" class="form-control" id="birth_year">
									      	<option :value="val" v-for="(val, index) in rangeYear(1900, date.getFullYear() - 18)">
									      		{{ val }}
									      	</option>
									    </select>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<div class="alert alert-danger" v-if="errors.country">
								  	<div v-for="country in errors.country" >{{ country }}</div>
								</div>
							    <label for="country">{{ trans('strings.country') }}</label>
							    <select v-model="country" class="form-control" id="country">
							    	<option :value="value.id" v-for="value in countries">
							    		{{ value.name }}
							    	</option>
							    </select>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-12 col-sm-12 col-md-12">
							<button type="submit" class="pull-right btn btn-md btn-success">
								{{ trans('strings.save_button') }}
							</button>
							<button type="load" class="hide pull-right btn btn-md btn-success">
								<i class="fa fa-refresh fa-spin"></i>
							</button>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-lg-4 col-12 col-md-4 col-sm-12 text-center">
					<img class="img-fluid" src="https://www.lottoland.com/cms/5a4ca7d90eb3587d99647503/br_yellow_homepage_286x406.jpg">
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	export default {
		computed: {
			leapYear: function() {
				var date = this.date;
				if((date.getFullYear() % 4 == 0) && (date.getFullYear() % 100 != 0) || (date.getFullYear() % 400 == 0)){
					return true;
				}
				return false;
			}
		},
		data: function() {
			return {
				countries: [],
				months: [
					{
						name: this.trans('strings.jan'),
						finalDay: 31,
						value: '01',
						index: 0
					},
					{
						name: this.trans('strings.feb'),
						finalDay: this.leapYear ? 29 : 28,
						value: '02',
						index: 1
					},
					{
						name: this.trans('strings.mar'),
						finalDay: 31,
						value: '03',
						index: 2
					},
					{
						name: this.trans('strings.apr'),
						finalDay: 30,
						value: '04'
					},
					{
						name: this.trans('strings.ma'),
						finalDay: 31,
						value: '05'
					},
					{
						name: this.trans('strings.jun'),
						finalDay: 30,
						value: '06'
					},
					{
						name: this.trans('strings.jul'),
						finalDay: 31,
						value: '07'
					},
					{
						name: this.trans('strings.aug'),
						finalDay: 31,
						value: '08'
					},
					{
						name: this.trans('strings.sep'),
						finalDay: 30,
						value: '09'
					},
					{
						name: this.trans('strings.oct'),
						finalDay: 31,
						value: '10'
					},
					{
						name: this.trans('strings.nov'),
						finalDay: 30,
						value: '11'
					},
					{
						name: this.trans('strings.dec'),
						finalDay: 31,
						value: '12'
					}
				],
				date: new Date(),
				birth_month: null,
				birth_year: null,
				name: '',
				last_name: '',
				email: '',
				password: '',
				country: '',
				birth_day: 1,
				days: [],
				errors: [],
				loading: {
					component: true
				}
			}
		},
		mounted: function() {
			window.document.title = window.app.title +' | '+ this.trans('strings.register');
			this.birth_year = this.date.getFullYear() - 18;
			this.birth_month = this.months[0].value;
			this.days = this.rangeDay();
			const instance = axios.create();
			instance.get(routes.countries.index, {})
			.then(response => {
				if(response.status === 200) {
	            	this.loading.component = false;
	            	this.countries = response.data;
	            	this.country = ''+this.countries[0].id;
			    }
			}).catch((error) => {

			});
		},
		methods: {
			changeBirthMonth: function(el) {
				var index = $('option:selected', el.target).attr('data-key');
				//var index = el.target.getAttribute('data-key');
				this.days = [];
				for(var i = 1; i <= this.months[index].finalDay; i++){
					this.days.push(i);
				}
				this.birth_day = this.days[0]
			},
			rangeDay: function() {
				var result = [];
				for(var i = 1; i <= this.months[0].finalDay; i++) {
					result.push(i);
				}
				return result;
			},
			rangeMonth: function (){
				var result = [];
				for (var i = 0; i < this.months.length; i++) {
					result.push(i);
				}
				return result;
			},
			rangeYear: function(begin, end) {
	            var offset = begin > end ? end : begin;
	            var delta = Math.abs(end - begin);
	            var result = [];
	            for (var i = 0; i <= delta; i++) {
	                result.push(i + offset);
	            };
	            return result.reverse();
	        },
			register: function() {
				var registerRequest = axios.create();
				registerRequest.interceptors.request.use(config => {
		        	$(this.$el).find('[type="load"]').removeClass('hide');
		        	$(this.$el).find('[type="submit"]').addClass('hide');
				  	return config;
				});
				//Fazendo requisição para criar o usuário
				registerRequest.post(routes.users.create, qs.stringify({
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
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
				}).catch(error => {
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
					this.errors = error.response.data.errors
				});
			}
		},
		watch: {
			birth_year: function(newValue, oldValue) {}
		}
	}

</script>

<style scoped>
	
</style>