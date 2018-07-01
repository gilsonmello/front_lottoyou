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
                    console.log(response)
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