<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
        <!-- <h3 class="">&nbsp;</h3> -->
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'soccer_expert.show', params: { id: soccer_expert.id } }" class="show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ soccer_expert.nome }} 
	                </router-link>
	                <router-link :to="{ name: 'soccer_expert.results', params: { id: soccer_expert.id } }" class="show active" id="result-component">
	                    Resultado 
	               	</router-link>
        		</div>
        	</div>
        </div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				},
				soccer_expert: {},
				id: '',
			}
		},
		mounted: function() {
			const showRequest = axios.create();
			this.id = this.$route.params.id;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			showRequest.get(routes.soccer_expert.show.replace('{id}', this.id), {}, {}).then(response => {
				if(response.status === 200){
					this.soccer_expert = response.data
					this.loading.component = false
				}
			}).catch((error) => {
				
			});
		},
		activated: function() {
			
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	
</style>