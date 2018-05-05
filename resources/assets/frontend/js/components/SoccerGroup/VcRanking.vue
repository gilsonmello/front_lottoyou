<template>
	<vc-load v-if="loading.component == true"></vc-load>
	<div class="container" v-else>

		<div class="sub-navigation">
			<router-link :to="{ name: 'soccer_expert.ranks', params: { id: category.id } }" class="show active" id="result-component">
                Rank 
           	</router-link>
		</div>

		<table class="table table-striped">
		  	<thead>
			    <tr>
			      	<th scope="col">Usuário</th>
			      	<th scope="col">Pontuação</th>
			    </tr>
		  	</thead>
		  	<tbody>
		    	<tr v-for="(bet, index) in bets">
			      	<th>
			      		{{ bet.owner.nickname }}
			      	</th>
			      	<th>
			      		{{ bet.pontuacao }}
			      	</th>
		   	 	</tr>
		  	</tbody>
		</table>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import VcLoad from '../Load'
	export default {
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.rankRequest();
        },
		data() {
			return {
				loading: {
					component: true,
					pagination: false
				},
				id: null,
				bets: [],
				category: {},
				group: {}
			}
		},
		mounted() {
			this.id = this.$route.params.id;
			this.showRequest();
			this.rankRequest();
		},
		components: {
			VcLoad
		},
		methods: {
			categoryRequest(category_id) {
				const showRequest = axios.create();
				showRequest.interceptors.request.use(config => {
		        	return config;
				});
				let url = routes.soccer_experts.find.replace('{id}', this.id);

				showRequest.get(url, {}, {}).then(response => {
					if(response.status === 200){
						this.category = response.data
					}
				}).catch((error) => {
					
				});
			},
			showRequest() {
				const showRequest = axios.create();
				showRequest.interceptors.request.use(config => {
		        	this.loading.component = true
				  	return config;
				});
				let url = routes.soccer_groups.find.replace('{id}', this.id);

				showRequest.get(url, {}, {}).then(response => {
					if(response.status === 200){
						this.group = response.data
					}
				}).catch((error) => {
					
				});
			},
			rankRequest() {

				const rankingRequest = axios.create();
				rankingRequest.interceptors.request.use(config => {
					return config;
				});

				let url = routes.soccer_groups.ranking.replace('{id}', this.id);

				rankingRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.bets = response.data;
						this.loading.component = false
					}
				}).catch((error) => {
					this.loading.component = false
				});
			}
		}
	}
</script>


<style scoped>
	
</style>