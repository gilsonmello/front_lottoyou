<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<!-- <h3 class="">&nbsp;</h3> -->
		<div class="container">
	        <div class="row">
	        	<div class="col-lg-12">
	        		<div class="sub-navigation">
	        			<router-link :to="{ name: 'soccer_expert.show', params: { id: soccer_expert.id } }" class="active show" id="play-component">
		                    {{ trans('strings.play_on_the') }} {{ soccer_expert.nome }}
		                </router-link>
		                <router-link :to="{ name: 'soccer_expert.results', params: { id: soccer_expert.id } }" class="show" id="result-component">
		                    Resultado 
		               	</router-link>
	        		</div>
	        	</div>
	        </div>	
		</div>
		<div class="row">
        	<div class="col-lg-12">
        		<h4 class="page-header" style="margin-top: 0;">{{ soccer_expert.nome }}</h4>
        	</div>
        </div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import {mapState, mapGetters} from 'vuex'
	export default {
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
        data: function() {
        	return {
        		loading: {
					component: true
				},
				soccer_expert: {},
				id: '',
				columns: [0],
				total: 0.00,
				item: {
					hash: null,
					id: null,
					value: null,
					name: '',
					betting: [
				 		{
				 			column: 0,
					 		complete: false,
					 		completeExtras: false,
					 		numbers: [],
					 		numbersExtras: []
					 	},
					]
				}
        	}
        },
        methods: {
			//Funão executada ao carregar
			init: function() {
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
			}
		},
		mounted: function() {
			this.init();
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	
</style>