<template>
	<load-component v-if="loading.component"></load-component>
	<div class="container" v-else>
        <h2 class="page-header">{{ trans('strings.I_forgot_my_password') }}</h2>
		<form id="forgot-password">
			<div class="row">
                <div class="col-lg-4 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                         <label for="forgot-password-email">{{ trans('strings.email') }}*</label>
                        <input name="email" v-model="email" type="email" class="form-control" id="forgot-password-email" aria-describedby="email" :placeholder="trans('strings.email')">
                    </div>
                </div>
				<div class="col-lg-4 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="forgot-password-birth_date">{{ trans('strings.email') }}*</label>
                        <datepicker :options="{language: 'pt-br', zIndexOffset: 1030}" autocomplete="off" id="forgot-password-birth_date" name="birth_date" v-model="birth_date" class="form-control" :placeholder="trans('strings.birth_date')" ></datepicker>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <button type="submit" v-if="!loading.submit" class="btn btn-md btn-primary">
                        {{ trans('strings.to_recovery') }}
                    </button>
                    <button v-else @click.prevent="" type="submit" class="btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>
                </div>
            </div>
		</form>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
    import LoadComponent from '../Load'
	export default {
		name: "VcForgotPassword",
		data() {
            return {
				email: '',
				birth_date: '',
                loading: {
                    component: true,
                    submit: false,
                },
            }
        },
		methods: {
			requestForgotPassword() {
				let requestForgotPassword = axios.create();
				requestForgotPassword.interceptors.request.use(config => {
					this.loading.submit = true;
					return config;
				});
				requestForgotPassword.post(routes.users.forgot_password, 
					{
						name: this.name,
						birth_date: this.birth_date
					}
				).then((response) => {
					if(response.status === 200) {
						toastr.options.timeOut = 5000;
						toastr.options.newestOnTop = true;
						if(response.data.message != null && response.data.message != '') {
							toastr.error(
								error.response.data.message,
								this.trans('strings.error')
							);
						} else {
							toastr.success(
								this.trans('alerts.users.forgot_password.success'),
								this.trans('strings.success')
							);
						}						
						this.submit = false;
						this.email = '';
						this.birth_date = '';
					}
				}).catch((response) => {
					this.submit = false;
					this.email = '';
					this.birth_date = '';
					toastr.options.timeOut = 5000;
					toastr.options.newestOnTop = true;
					if(error.response.data.message != null && error.response.data.message != '') {
						toastr.error(
							error.response.data.message,
							this.trans('strings.error')
						);
					} else {
						toastr.error(
							this.trans('alerts.users.forgot_password.error'),
							this.trans('strings.error')
						);
					}
				});
			}
		},
		mounted() {
			window.document.title = this.trans('crud.users.I_forgot_my_password');
			this.loading.component = false;
			let vm = this;
			let time = setInterval(() => {
                if($('#forgot-password').length > 0) {
                    clearInterval(time);
					let form = $('#forgot-password');
                    form.validate({
                        rules: {
                            email: {
                                required: true,
                                email: true,
							},
							birth_date: {
								required: true,
							}
                        },
                        messages: {
                            birth_date: {
                                required: vm.trans('strings.field_required'),
                            },
                            email: {
                                required: vm.trans('strings.field_required'),
                                email: vm.trans('validation.user.create.email.email'),
                            }
                        },
                        highlight: function (input) {
                            $(input).addClass('error');
                            $(input).parents('.form-control').addClass('error');
                        },
                        unhighlight: function (input) {
                            $(input).removeClass('error');
                            $(input).parents('.form-control').removeClass('error');
                        },
                        errorPlacement: function (error, element) {
                            $(element).parents('.input-group').append(error);
                            $(element).parents('.form-group').append(error);
                        }
                    });
                    form.on('submit', function(e) {
                        vm.submit = true;
                        var isvalid = form.valid();
                        if (isvalid) {
                            e.preventDefault();
                            vm.requestForgotPassword();
                        }
                    });
                }
            })
		},
		components: {
            LoadComponent
        }
	}
</script>

<style scoped>
	
</style>