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
        
        <div class="row">
        	<ticket-component v-for="(ticket, index) in tickets" :key="index" :ticket="ticket"></ticket-component>
        </div>


	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import TicketComponent from './Result/TicketComponent'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				},
				soccer_expert: {},
				id: '',
				results: [],
				tickets: []
			}
		},
		mounted: function() {
			const showRequest = axios.create();
			this.id = this.$route.params.id;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			let url = routes.soccer_experts.find.replace('{id}', this.id);

			showRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.soccer_expert = response.data
				}
			}).catch((error) => {
				
			});

			const resultRequest = axios.create();

			resultRequest.interceptors.request.use(config => {
	        	return config;
			});

			url = routes.soccer_experts.results.replace('{id}', this.id);

			resultRequest.get(url, {}, {}).then(response => {
				if(response.status === 200) {
					this.tickets = response.data;
					this.loading.component = false
				}
			}).catch((error) => {
				this.loading.component = false
			});

		},
		activated: function() {
			
		},
		components: {
			LoadComponent,
			TicketComponent
		}
	}
</script>

<style scoped>
	
</style>