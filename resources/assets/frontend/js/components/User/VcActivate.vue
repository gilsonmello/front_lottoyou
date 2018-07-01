<template>
    <load-component v-if="loading.component"></load-component>
    <div class="container" v-else>
        <h1>Ativado</h1>
    </div>
</template>

<script>
import LoadComponent from '../Load'
import {routes} from '../../api_routes'
export default {
    name: "VcActivate",
    methods: {
        activateRequest() {
            var activateRequest = axios.create();
            activateRequest.interceptors.request.use(config => {
                return config;
            });
            let url = routes.users.activate.replace('{hash}', this.$route.params.hash);
            //Fazendo requisição para criar o usuário
            activateRequest.post(url, {}, {})
                .then((response) => {
                    
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
                        this.loading.login = false;
                        response_2.data.access_token = access_token;

                        response_2.data.refresh_token = refresh_token;

                        var authUser = response_2.data;

                        window.localStorage.setItem('authUser', JSON.stringify(authUser));

                        this.$store.dispatch('setUserObject', response_2.data);
                        
                        //window.location.reload();

                        this.$router.push({name: 'home'});
                    
                    }).catch((error_2) => {
                        
                    });

                })
                .catch((response) => {

                })
        }
    },
    mounted() {
        this.activateRequest();
    },
    data() {
        return {
            loading: {
                component: true
            }
        }
    },
    components: {
        LoadComponent
    }
}
</script>

<style scoped>

</style>