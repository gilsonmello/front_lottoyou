<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
        <!-- <h3 class="">&nbsp;</h3> -->
        
		<div class="sub-navigation">
			<router-link :to="{ name: 'soccer_expert.show', params: { id: category.id } }" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ category.nome }} 
            </router-link>
            <router-link :to="{ name: 'soccer_expert.results', params: { id: category.id } }" class="show" id="result-component">
                Resultado 
           	</router-link>
           	<router-link :to="{ name: 'soccer_expert.ranks', params: { id: category.id } }" class="show active" id="result-component">
                Rank 
           	</router-link>
		</div>

		<form @submit.prevent="filter">
			<div class="row">
			  	<div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="nome">{{ trans('strings.ticket_name') }}</label>
	                    <input v-model="query.nome" type="text" class="form-control" id="nome" aria-describedby="nome" name="nome" :placeholder="trans('strings.name')">
	                </div>
	            </div>
	            <div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="valor">{{ trans('strings.value') }}</label>
	                    <input v-model="query.valor" type="text" class="form-control" id="valor" aria-describedby="valor" :placeholder="trans('strings.value')">
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
        
        
        <div class="row no-margin ticket">
	    	<div class="col-lg-2" @click="toggle(column)" v-for="(column, index) in columns">
	    		<span v-if="column === 'nome'">
	    			{{ trans('strings.name') }}
	    		</span>
	    		<span v-else-if="column === 'valor'">
	    			{{ trans('strings.value') }}
	    		</span>
	    		<span v-else-if="column === 'data_termino'">
	    			{{ trans('strings.date_end') }}
	    		</span>
	    		<span v-if="column === query.column">
	    			<span v-if="query.direction === 'desc'">
	    				&darr;
		    		</span>
		    		<span v-else>
	    				&uarr;
		    		</span>
	    		</span>
	    	</div>
	    </div>
        
	    <load-component v-if="loading.pagination == true"></load-component>
    	<vc-ticket v-else v-for="(ticket, index) in tickets" :index="index" :key="index" :ticket="ticket" :category="category">
    	</vc-ticket>

    	<div class="row no-margin">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="pull-left">
                    <br>
                    <label>{{ model.from }} - {{ model.to }} de {{ model.total }} de linhas</label>
                </div>
                <div class="pull-right">
                	<br>
                	<vc-pagination :source="model" @paginate="paginate"></vc-pagination>
                    <!-- <button class="btn btn-xs" @click="prev()">&laquo;</button>
                    <button class="btn btn-xs" @click="next()">&raquo;</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import VcPagination from '../VcPagination'
	import VcTicket from './Rank/VcTicket'
	export default {
		methods: {
			paginate(page) {
				this.query.page = page;
				this.rankRequest();
			},
			toggle(column) {
				if(this.query.column === column) {
					if(this.query.column === 'desc') {
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
			rankRequest() {

				const rankRequest = axios.create();
				rankRequest.interceptors.request.use(config => {
					this.loading.pagination = true
		        	return config;
				});

				let url = routes.soccer_experts.ranks.replace('{id}', this.id);
				url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;

				rankRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.model = response.data;
						this.tickets = response.data.data;
						this.loading.component = false
						this.loading.pagination = false
					}
				}).catch((error) => {
					this.loading.component = false
					this.loading.pagination = false
				});
			}
		},
		data: function() {
			return {
				loading: {
					component: true,
					pagination: false
				},
				category: {},
				columns: ['nome', 'valor', 'data_termino'],
				id: '',
				results: [],
				bets: [],
				tickets: [],
				model: {},
				users: [],
				query: {
					page: 1,
					column: 'nome',
					direction: 'asc',
					nome: '',
					valor: '',
					data_termino: '',
				}
			}
		},
		mounted: function() {
			const categoryRequest = axios.create();
			this.id = this.$route.params.id;
			categoryRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			let url = routes.soccer_experts.find.replace('{id}', this.id);

			categoryRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.category = response.data
				}
			}).catch((error) => {
				
			});

			/*const userRequest = axios.create();
			userRequest.interceptors.request.use(config => {
	        	return config;
			});

			url = routes.users.index;
			categoryRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.users = response.data
				}
			}).catch((error) => {
				
			});*/

			this.rankRequest();
		},
		activated: function() {
			
		},
		components: {
			LoadComponent,
			VcPagination,
			VcTicket
		},
		watch: {
			'query.page': function(newValue, oldValue) {}
		}
	}
</script>

<style scoped>
	.ticket {
	    color: #fff;	
	    background-color: #212529;
	    border-color: #32383e;
		border-bottom: 2px solid #dee2e6;
		padding: 10px 0 10px 0;
	}
</style>