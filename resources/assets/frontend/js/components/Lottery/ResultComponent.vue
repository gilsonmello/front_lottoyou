<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
        <!-- <h3 class="">&nbsp;</h3> -->
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ lottery.sorteio }} 
	                </router-link>
	                <router-link :to="{ name: 'lotteries.results', params: { id: lottery.id } }" class="show active" id="result-component">
	                    {{ trans('strings.results') }}
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
				lottery: {},
				id: '',
				active_tab: ''
			}
		},
		mounted: function() {
			const showRequest = axios.create();
			this.id = this.$route.params.id;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			showRequest.get(routes.lotteries.show.replace('{id}', this.id), {}, {}).then(response => {
				if(response.status === 200){
					this.lottery = response.data
					this.loading.component = false
				}
			}).catch((error) => {
				
			});
		},
		activated: function() {
			const resultRequest = axios.create();
			this.loading.component = false;
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	
</style>