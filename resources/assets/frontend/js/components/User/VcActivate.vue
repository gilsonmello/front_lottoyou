<template>
    <load v-if="loading.component" />
    <div class="container" v-else>
        
    </div>
</template>

<script>
import { routes } from '../../api_routes';
export default {
    name: "VcActivate",
    methods: {
        activateRequest () {
            var activateRequest = axios.create();
            activateRequest.interceptors.request.use(config => {
                this.loading.component = true;
                return config;
            });
            let url = routes.users.activate.replace('{hash}', this.$route.params.hash);
            //Fazendo requisição para criar o usuário
            activateRequest.post(url, {}, {})
                .then((response) => {

                    toastr.success(
						this.trans('alerts.users.account_active'),
						this.trans('strings.success')
					);
                    
                    var access_token = response.data.access_token;
                    var refresh_token = response.data.refresh_token;
                    window.localStorage.setItem('access_token', JSON.stringify(access_token));
                    window.localStorage.setItem('refresh_token', JSON.stringify(refresh_token));
                    
                    var loginRequest = axios.create();
                    //Fazendo busca do usuário logado, para setar na estrutura de dados
                    loginRequest.get(routes.auth.user, { headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + access_token
                    }}).then(response_2 => {
                        this.email = '';
                        this.password = '';
                        this.errors = {};
                        this.loading.login = false;
                        response_2.data.access_token = access_token;
                        response_2.data.refresh_token = refresh_token;
                        var authUser = response_2.data;
                        //window.localStorage.setItem('authUser', JSON.stringify(authUser));

                        this.$store.dispatch('setUserObject', response_2.data);
                        
                        //window.location.reload();

                        this.$router.push({name: 'home'});
                    
                    }).catch((error_2) => {
                        
                    });
                })
                .catch((response) => {
					this.$store.dispatch('clearAuthUser');
					window.localStorage.removeItem('authUser');
					window.localStorage.removeItem('access_token');
					window.localStorage.removeItem('refresh_token');
                    this.$router.push({name: 'home'});
                    toastr.warning(
						this.trans('alerts.users.activated'),
						this.trans('strings.warning')
					);
                })
        }
    },
    mounted() {
        this.activateRequest();
    },
    data () {
        return {
            loading: {
                component: true
            }
        }
    },
    components: {
        
    }
}
</script>

<style scoped>

</style>