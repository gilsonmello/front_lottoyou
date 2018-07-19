<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		teste
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
				lottery: {},
				id: '',
				active_tab: ''
			}
		},
		mounted: function() {
			
		},
		activated: function() {
			const playRequest = axios.create();
			this.id = this.$route.params.id;
			playRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			playRequest.get(routes.lotteries.play.replace('{id}', this.id), {}, {}).then(response => {
				if(response.status === 200){
					this.lottery = response.data
					this.loading.component = false
				}
			}).catch((error) => {
				
			});
		},
		beforeRouteUpdate (to, from, next) {
		    
	  	},
		methods: {

		},
		computed: {

		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	
</style>