<template>
	<vc-load v-if="loading.component == true"></vc-load>
	<div class="container" v-else>

		<h1 class="page-header">
			{{ trans('strings.rank') }} - Grupo {{ group.identificacao }}
		</h1>

		<form @submit.prevent="filter" class="form-filter">
			<div class="row">
			  	<div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="nickname">{{ trans('strings.nickname') }}</label>
	                    <input v-model="query.nickname" type="text" class="form-control" id="nickname" aria-describedby="nickname" name="nickname" :placeholder="trans('strings.nickname')">
	                </div>
	            </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-md btn-primary">
                        {{ trans('strings.filter') }}
                    </button>
                    <button @click.prevent="" type="load" class="hide btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>
                </div>
            </div>
		</form>
        
        <br>

		<table class="table table-striped text-center table-ranking">
		  	<thead>
			    <tr>
			    	<th @click="toggle('id')">
						<span>
	    					Posição
	    				</span>			    		
						<span v-if="'id' === query.column">
			    			<span v-if="query.direction === 'desc'">
			    				&darr;
				    		</span>
				    		<span v-else>
			    				&uarr;
				    		</span>
			    		</span>
			    	</th>
			    	<th>
			    		<span>
	    					Foto
	    				</span>
	    				<span v-if="'photo' === query.column">
			    			<span v-if="query.direction === 'desc'">
			    				&darr;
				    		</span>
				    		<span v-else>
			    				&uarr;
				    		</span>
			    		</span>
			    	</th>
			      	<th @click="toggle('owner_id')">
			      		<span>
			      			Usuário
			      		</span>
			      		<span v-if="'owner_id' === query.column">
			    			<span v-if="query.direction === 'desc'">
			    				&darr;
				    		</span>
				    		<span v-else>
			    				&uarr;
				    		</span>
			    		</span>
			      	</th>
			      	<th @click="toggle('pontuacao')">
			      		<span>
			      			Pontos
			      		</span>
			      		<span v-if="'pontuacao' === query.column">
			    			<span v-if="query.direction === 'desc'">
			    				&darr;
				    		</span>
				    		<span v-else>
			    				&uarr;
				    		</span>
			    		</span>
			      	</th>
			    </tr>
		  	</thead>
		  	<tbody v-if="loading.pagination">
		  		<tr>
		  			<td colspan="4">
		  				<vc-load></vc-load>
		  			</td>
		  		</tr>
		  	</tbody>
		  	<tbody v-else>
		    	<tr v-for="(bet, index) in bets">
		    		<td style="width: 20%;">
			      		{{ index + 1 }}
			      	</td>
			      	<td style="width: 10%;">
			      		<img :src="bet.owner.photo" style="width: 100%; height: 50px;">
			      	</td>
			      	<td>
			      		{{ bet.owner.nickname }}
			      	</td>
			      	<td>
			      		{{ bet.pontuacao }}
			      	</td>
		   	 	</tr>
		  	</tbody>
		</table>

		<div class="row no-margin">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="pull-left">
                    <br>
                    <label>{{ model.from }} - {{ model.to }} de {{ model.total }} de linhas</label>
                </div>
                <div class="pull-right">
                	<br>
                	<vc-pagination :source="model" @paginate="paginate"></vc-pagination>
                </div>
            </div>
        </div>

	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import VcLoad from '../Load'
	import VcPagination from '../VcPagination'
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
				total: 0,
				category: {},
				group: {},
				model: {},
				query: {
					page: 1,
					column: 'pontuacao',
					direction: 'desc',
					nickname: '',
					valor: '',
					data_termino: '',
				}
			}
		},
		mounted() {
			this.id = this.$route.params.id;
			this.groupRequest();
			this.rankRequest();
		},
		components: {
			VcLoad,
			VcPagination
		},
		methods: {
			filter(event) {				
                $(event.target).find('[type="load"]').removeClass('hide');
                $(event.target).find('[type="submit"]').addClass('hide');
				this.rankRequest();
			},
			paginate(page) {
				this.query.page = page;
				this.rankRequest();
			},
			toggle(column) {
				if(this.query.column == column) {
					if(this.query.direction == 'desc') {
						this.query.direction = 'asc';
					} else {
						this.query.direction = 'desc';
					}
				} else {
					this.query.column = column
					this.query.direction = 'asc';
				}

				this.rankRequest();
			},
			prev() {
				if(this.model.prev_page_url) {
					this.query.page--;
					this.rankRequest();
				}
			},
			next() {
				if(this.model.next_page_url) {
					this.query.page++;
					this.rankRequest();
				}
			},
			groupRequest(category_id) {
				const groupRequest = axios.create();
				groupRequest.interceptors.request.use(config => {
		        	return config;
				});
				let url = routes.soccer_groups.find.replace('{id}', this.id);

				groupRequest.get(url, {}, {}).then(response => {
					if(response.status === 200){
						this.group = response.data
					}
				}).catch((error) => {
					
				});
			},
			rankRequest() {

				const rankingRequest = axios.create();
				rankingRequest.interceptors.request.use(config => {
					this.loading.pagination = true;
					return config;
				});

				let url = routes.soccer_groups.ranking.replace('{id}', this.id);
				url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;
				url += "&nickname="+this.query.nickname;

				rankingRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.model = response.data;
						this.total = this.model.total;
						this.bets = response.data.data;
						this.loading.component = false
						this.loading.pagination = false

                        $(this.$el).find('.form-filter [type="load"]').addClass('hide');
                        $(this.$el).find('.form-filter [type="submit"]').removeClass('hide');
					}
				}).catch((error) => {
					this.loading.component = false;
					this.loading.pagination = false;
				});
			}
		}
	}
</script>


<style scoped>
	.table-ranking thead th {
		cursor: pointer;
	}
</style>