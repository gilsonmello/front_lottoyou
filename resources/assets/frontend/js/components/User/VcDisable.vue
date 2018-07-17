<style scoped>
	
</style>

<template>
	<load v-if="loading.component == true"></load>
	<div class="container no-padding" v-else>
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.my_games') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                    <!-- <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link> -->
                </div>
            </div>
        </div>
        <h2 class="page-header" style="margin-bottom: 22px; margin-top: 10px">
        	{{ trans('strings.disable_account') }}
        </h2>
        <div class="row no-margin">
    		<div class="col-lg-12 no-padding">
    			<form @submit.prevent="submitFormDisable()">
    				<div class="row">
    					<div class="col-lg-4 col-sm-4 col-md-4 col-12">
    						<div class="form-group">
								<label for="type_exclusion">Tempo de Exclusão</label>
							    <select v-model="type_exclusion" class="form-control" id="type_exclusion">
							      	<option value="0">
							      		1 {{ trans('strings.month') }}
							      	</option>
							      	<option value="1">
							      		3 {{ trans('strings.months') }}
							      	</option>
							      	<option value="2">
							      		6 {{ trans('strings.months') }}
							      	</option>
							      	<option value="3">
							      		1 {{ trans('strings.year') }}
							      	</option>
							      	<option value="4">
							      		{{ trans('strings.definitive') }}
							      	</option>
							    </select>
						  	</div>
    					</div>
    				</div>
    				<div class="row">
                        <div class="col-lg-12">
                            <button @click.prevent="" v-if="loading.submit" type="load" class="btn btn-md btn-primary">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                            <button type="submit" v-else class="btn btn-md btn-primary">
                                {{ trans('strings.to_disable') }}
                            </button>
                        </div>
                    </div>
    			</form>
    		</div>
        </div>
    </div>
</template>

<script>
	import {routes} from '../../api_routes';
	import {mapGetters} from 'vuex';
	export default {
		name: 'VcDisable',
		data () {
			return {
				loading: {
                    component: true,
                    submit: false
                },
                type_exclusion: '0',
			}
		},
		computed: {
            ...mapGetters([
                'auth'
            ])
        },
		mounted () {
            this.loading.component = false;
		},
		methods: {
			submitFormDisable() {
				swal({
				  	title: 'Deseja continuar?',
				  	text: "",
				  	type: 'warning',
				  	showCancelButton: true,
				  	confirmButtonColor: '#3085d6',
				  	cancelButtonColor: '#d33',
				  	confirmButtonText: this.trans('strings.yes'),
				  	cancelButtonText: this.trans('strings.cancel')
				}).then((result) => {
				  	if(result.dismiss) {
			  			
				  	} else {
				  		this.disableRequest();
				  	}
				});
			},
			disableRequest () {
				let disableRequest = axios.create();
				disableRequest.interceptors.request.use(config => {
					this.loading.submit = true;
					return config;
				});
				disableRequest.post(routes.users.disable, {
					owner_id: this.auth.id,
					type_exclusion: this.type_exclusion
				}).then((response) => {
					this.loading.submit = false;
		            if(response.status === 200) {
		            	if(response.data.message) {
							toastr.success(response.data.message);
			        	}

			        	window.localStorage.removeItem('authUser');
						window.localStorage.removeItem('access_token');
						window.localStorage.removeItem('refresh_token');
						this.$store.dispatch('clearAuthUser');
						this.$router.push({
							name: 'home'
						});
					}
		        }).catch((error) => {
		        	if(error.response.data.message) {
						toastr.error(error.response.data.message);
		        	}
		        	this.loading.submit = false;
		        });
			}
		}
	}
</script>