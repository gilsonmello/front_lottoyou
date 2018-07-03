<template>
	<load-component v-if="loading.component"></load-component>
	<div class="container" v-else>
        <h2 class="page-header">{{ trans('strings.password_recovery') }}</h2>
		<form id="password-recovery">
			<div class="row">
				<div class="col-lg-4 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="password-recovery-password">{{ trans('strings.password') }}*</label>
                        <input name="password" v-model="password" type="password" class="form-control" id="password-recovery-password" aria-describedby="password" :placeholder="trans('strings.password')">
                    </div>
                </div>
				<div class="col-lg-4 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label for="password-recovery-confirm_password">{{ trans('strings.confirm_password') }}*</label>
                        <input name="confirm_password" v-model="confirm_password" type="password" class="form-control" id="password-recovery-confirm_password" aria-describedby="password" :placeholder="trans('strings.confirm_password')">
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
		name: "VcPasswordRecovery",
		data() {
            return {
				email: '',
				password: '',
				confirm_password: '',
				birth_date: '',
                loading: {
                    component: true,
                    submit: false,
                },
            }
        },
		methods: {
			requestCheckTokenPasswordRecovery() {
				let requestCheckTokenPasswordRecovery = axios.create();
				requestCheckTokenPasswordRecovery.interceptors.request.use(config => {
					return config;
				});
				let url = routes.users.check_token_password_recovery.replace('{hash}', this.$route.params.hash);
				requestCheckTokenPasswordRecovery.post(url)
				.then((response) => {
					if(response.status === 200) {
						//this.password = '';
						//this.confirm_password = '';
					}
				}).catch((error) => {
					toastr.error(
						this.trans('strings.invalid_token'),
						this.trans('strings.error')
					);
					this.$router.push({name: 'home'});
				});
			},
			requestPasswordRecovery() {
				let requestPasswordRecovery = axios.create();
				requestPasswordRecovery.interceptors.request.use(config => {
					this.loading.submit = true;
					return config;
				});
				let url = routes.users.password_recovery.replace('{hash}', this.$route.params.hash);
				requestPasswordRecovery.post(url, 
					{
						password: this.password
					}
				).then((response) => {
					if(response.status === 200) {
						if(response.data.message != null && response.data.message != '') {
							swal({
								showCloseButton: true,
								type: 'success',
								title: this.trans('strings.success'),
								html: `<p style="text-align: left">${response.data.message}</p>`,
								showConfirmButton: true,
							});
						} else {
							swal({
								showCloseButton: true,
								type: 'success',
								title: this.trans('strings.success'),
								html: `<p style="text-align: left">${this.trans('alerts.users.change_password.success')}</p>`,
								showConfirmButton: true,
							});
						}
						this.$router.push({name: 'home'});				
						this.loading.submit = false;
						this.password = '';
						this.confirm_password = '';
					}
				}).catch((error) => {
					this.loading.submit = false;
					this.password = '';
					this.confirm_password = '';
					if(error.response.data.message != null && error.response.data.message != '') {
						swal({
							showCloseButton: true,
							type: 'error',
							title: this.trans('strings.success'),
							html: `<p style="text-align: left">${error.response.data.message}</p>`,
							showConfirmButton: true,
						});
					} else {
						swal({
							showCloseButton: true,
							type: 'error',
							title: this.trans('strings.success'),
							html: `<p style="text-align: left">${this.trans('alerts.users.change_password.error')}</p>`,
							showConfirmButton: true,
						});
					}
				});
			}
		},
		mounted() {
			window.document.title = this.trans('strings.password_recovery');
			this.loading.component = false;
			let vm = this;
			this.requestCheckTokenPasswordRecovery();
			let time = setInterval(() => {
                if($('#password-recovery').length > 0) {
                    clearInterval(time);
					let form = $('#password-recovery');
                    form.validate({
                        rules: {
                            password: {
								required: true,
								minlength: 6,
							},
							confirm_password: {
								equalTo: '[name="password"]',
								minlength: 6,
								required: true
							},
                        },
                        messages: {
							password: {
								required: vm.trans('strings.field_required'),
								minlength: vm.trans('strings.minimum_size')+' 6',
							},
							confirm_password: {
								minlength: vm.trans('strings.minimum_size')+' 6',
								required: vm.trans('strings.field_required'),
								equalTo: vm.trans('strings.the_field_confirm_the_password_must_be_the_same_as_the_password_field')
							},
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
                        var isvalid = form.valid();
                        if (isvalid) {
                        	vm.loading.submit = true;
                            e.preventDefault();
                            vm.requestPasswordRecovery();
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