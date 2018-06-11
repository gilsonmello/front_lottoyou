<template>
	<load-component v-if="loading.component"></load-component>
	<div class="container" v-else>
		<h1 class="page-header text-center">Crie uma conta para desfrutar de infinitas possibilidades</h1>
		<form @submit.prevent="register">
			<div class="row">
				<div class="col-lg-9 col-12 col-sm-12 col-md-12" style="padding-right: 30px;">
					<div class="row">
						<div class="col-lg-4 col-12 col-sm-4 col-md-4">
							<div class="form-group">
								<label for="email">{{ trans('strings.email') }}*</label>
							    <input v-model="email" required type="email" class="form-control" id="email" aria-describedby="email" :placeholder="trans('strings.email')">
							    <div class="alert alert-danger" v-if="errors.email">
								  	<div v-for="email in errors.email" >{{ email }}</div>
								</div>
						  	</div>
						</div>
						<div class="col-lg-4 col-12 col-sm-4 col-md-4">
							<div class="form-group">
							    <label for="password">{{ trans('strings.password') }}*</label>
							    <input v-model="password" required type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
								<div class="alert alert-danger" v-if="errors.password">
								  	<div v-for="password in errors.password">
								  		{{ password }}
								  	</div>
								</div>
						  	</div>
						</div>
						<div class="col-lg-4 col-12 col-sm-4 col-md-4">
							<div class="form-group">
								<label for="confirm_password">{{ trans('strings.confirm_password') }}*</label>
							    <input v-model="confirm_password" required type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password" :placeholder="trans('strings.confirm_password')">
							    <div class="alert alert-danger" v-if="errors.confirm_password">
								  	<div v-for="confirm_password in errors.confirm_password">
								  	{{ confirm_password }}</div>
								</div>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-12 col-sm-4 col-md-4" style="padding-right: 0;">
							<div class="form-group">
								<label for="gender">&nbsp;</label>
							    <select v-model="gender" required class="form-control" id="gender" aria-describedby="gender" :placeholder="trans('strings.gender')">
							    	<option value="M" selected>Sr.</option>
							    	<option value="F">Srª</option>
							    </select>
						  	</div>
						</div>
						<div class="col-lg-4 col-12 col-sm-4 col-md-4">
							<div class="form-group">
								<label for="name">{{ trans('strings.name') }}*</label>
							    <input v-model="name" required type="text" class="form-control" id="name" aria-describedby="name" :placeholder="trans('strings.name')">
							    <div class="alert alert-danger" v-if="errors.name">
								  	<div v-for="name in errors.name" >{{ name }}</div>
								</div>
						  	</div>
						</div>
						<div class="col-lg-3 col-12 col-sm-4 col-md-4">
							<div class="form-group">
								<label for="last_name">{{ trans('strings.last_name') }}*</label>
							    <input v-model="last_name" required type="text" class="form-control" id="last_name" aria-describedby="last_name" :placeholder="trans('strings.last_name')">
							    <div class="alert alert-danger" v-if="errors.last_name">
								  	<div v-for="last_name in errors.last_name" >{{ last_name }}</div>
								</div>
						  	</div>
						</div>
						<div class="col-lg-3 col-12 col-sm-4 col-md-4">
							<div class="form-group">
								<label for="nickname">{{ trans('strings.user') }}*</label>
							    <input v-model="nickname" required type="text" class="form-control" id="nickname" aria-describedby="nickname" :placeholder="trans('strings.nickname')">
							    <div class="alert alert-danger" v-if="errors.nickname">
								  	<div v-for="nickname in errors.nickname" >{{ nickname }}</div>
								</div>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<label for="birth_day">Data nasc.*</label>
						</div>
						<div class="col-12 col-lg-6 no-mobile">
							<label for="birth_day">{{ trans('strings.country') }}</label>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12 col-sm-12 col-md-12">
							<div class="row">
								<div class="col-lg-4 col-sm-4 col-md-4 col-3">
									<div class="form-group">
										<!--<label for="birth_day">&nbsp;</label>-->
									    <select v-model="birth_day" class="form-control" id="birth_day">
									      	<option :value="day" v-for="day in days">
									      		{{ day }}
									      	</option>
									    </select>
									    <div class="alert alert-danger" v-if="errors.birth_day">
										  	<div v-for="birth_day in errors.birth_day" >{{ birth_day }}</div>
										</div>
								  	</div>
								</div>
								<div class="col-lg-4 col-sm-4 col-md-4 col-3">
									<div class="form-group">
										<!--<label for="birth_month">&nbsp;</label>-->
									    <select v-model="birth_month" class="form-control" id="birth_month" @change="changeBirthMonth">
									      	<option :value="month.value" :data-key="key" v-for="(month, key) in months">
									      		{{ month.name }}
									      	</option>
									    </select>
									    <div class="alert alert-danger" v-if="errors.birth_month">
										  	<div v-for="birth_month in errors.birth_month" >{{ birth_month }}</div>
										</div>
								  	</div>
								</div>
								<div class="col-lg-4 col-sm-4 col-md-4 col-6">
									<div class="form-group">
										<!--<label for="birth_year">&nbsp;</label>-->
									    <select v-model="birth_year" class="form-control" id="birth_year">
									      	<option :value="val" v-for="(val, index) in rangeYear(1900, date.getFullYear() - 18)">
									      		{{ val }}
									      	</option>
									    </select>
									    <div class="alert alert-danger" v-if="errors.birth_year">
										  	<div v-for="birth_year in errors.birth_year" >{{ birth_year }}</div>
										</div>
								  	</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12 col-sm-6 col-md-6">
							<div class="form-group">
								<label class="mobile" for="country">{{ trans('strings.country') }}</label>
							    <select v-model="country" class="form-control" id="country">
							    	<option :value="value.id" v-for="value in countries">
							    		{{ value.name }}
							    	</option>
							    </select>
							    <div class="alert alert-danger" v-if="errors.country">
								  	<div v-for="country in errors.country" >{{ country }}</div>
								</div>
						  	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-12 col-sm-12 col-md-4">
							<div class="form-group">
								<label class="" for="terms">
									<input type="checkbox" v-model="terms" name="terms" id="terms"> 
										Li e aceito os <a class="btn-link" href="/termos-principal.docx" target="_blank">
											Termos e Condições
										</a>
								</label>
								<div class="alert alert-danger" v-if="errors.terms">
								  	<div v-for="term in errors.terms" >{{ term }}</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-12 col-sm-12 col-md-12">
							<button type="submit" class="pull-right btn btn-md btn-primary">
								{{ trans('strings.save_button') }}
							</button>
							<button @click.prevent="" type="load" class="hide btn btn-md btn-primary">
								<i class="fa fa-refresh fa-spin"></i>
							</button>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-lg-3 col-12 col-md-4 col-sm-12 text-center" style="padding-left: 0px; padding-right: 0; margin-left: -15px;">
					<div class="banner" style="position: relative">
						<img class="img-fluid propaganda" src="/img/572x700_marca_22.png">
						<div class="content">
							<h1 class="" style="">
								Aqui<br> é mais<br> fácil
							</h1>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
    import {mapGetters} from 'vuex'
	export default {
		computed: {
            ...mapGetters([
                'auth'
            ]),
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
						value: '01'
					},
					{
						name: this.trans('strings.feb'),
						finalDay: this.leapYear ? 29 : 28,
						value: '02'
					},
					{
						name: this.trans('strings.mar'),
						finalDay: 31,
						value: '03'
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
				confirm_password: '',
				country: '',
				terms: false,
				gender: 'M',
				birth_day: 1,
				nickname: '',
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
			const countryRequest = axios.create();
			countryRequest.interceptors.request.use(config => {
				this.loading.component = true
				return config;
			});
			countryRequest.get(routes.countries.index, {}).then(response => {
				if(response.status === 200) {
	            	this.loading.component = false;
	            	this.countries = response.data;
	            	this.country = ''+this.countries[0].id;
	            	setTimeout(() => {
	            		this.loading.component = false
	            	}, 5000)
	            	
			    }
			}).catch((error) => {
				this.loading.component = false
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

				//Caso o mês selecionado tenha dias menor do que o mês anterior selecionado
				//Fazer troca de dia pelo último dia do mês selecionado
				this.birth_day = this.birth_day > this.days[this.days.length - 1] ? this.days[this.days.length - 1] : this.birth_day;
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
			login() {
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

                            this.name = '';
                            this.last_name = '';
                            this.email = '';
                            this.password = '';
                            this.birth_day = '';
                            this.birth_month = '';
                            this.birth_year = '';
                            this.country = '';
                            this.gender = '';
                            this.terms = '';
                            this.confirm_password = '';
                            response_2.data.access_token = access_token;

                            response_2.data.refresh_token = refresh_token;

                            var authUser = response_2.data;

                            window.localStorage.setItem('authUser', JSON.stringify(authUser));

                            this.$store.dispatch('setUserObject', response_2.data);

                            //window.location.reload();

                            this.$router.push({name: 'home'});

                            $('.modal-login').modal('hide');

                        }).catch((error_2) => {

                        });

                    }
                }).catch((error) => {
                    this.loading.login = false;
                    this.errors = {
                        credentials: 'Usuário ou Senha inválidos'
                    };
                });
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
					confirm_password: this.confirm_password,
					birth_day: this.birth_day,
					birth_month: this.birth_month,
					birth_year: this.birth_year,
					country: this.country,
					gender: this.gender,
					terms: this.terms,
					nickname: this.nickname
				})).then((response) => {
					if(response.status === 200) {

						//this.$router.push({name: 'home'});
						toastr.options.timeOut = 10000;
						toastr.options.newestOnTop = true;
						toastr.success(
							this.trans('alerts.users.create.success'),
							this.trans('strings.success')
						);

                       	this.login();
					}
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
				}).catch(error => {
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
					this.errors = error.response.data.errors
					toastr.error(
						this.trans('alerts.users.create.error'),
						this.trans('strings.error')
					);
				});
			}
		},
		watch: {
			birth_year: function(newValue, oldValue) {}
		},
		components: {
			LoadComponent
		}
	}

</script>

<style scoped>
	.form-group {
		position: relative;
	}

	.propaganda {
	    
	}

	.banner .content h1 {
	    font-family: "Interstate", sans-serif;
	    font-weight: bold;
	    color: #00448c;
    	text-transform: uppercase;
	}

	.banner .content {
	    left: 0;
	    right: 0;
	    top: 30%;
	    position: absolute;
	    -webkit-transform: translate(0, 20%);
	    transform: translate(0, 20%);
	    color: #000;
	    font-weight: bold;
	    font-family: sans-serif;
	}
	
</style>