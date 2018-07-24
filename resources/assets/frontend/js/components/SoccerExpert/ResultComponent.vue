<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
        <!-- <h3 class="">&nbsp;</h3> -->
        
		<div class="sub-navigation">
			<router-link :to="{ name: 'soccer_expert.play', params: { slug: category.slug } }" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ category.nome }} 
            </router-link>
            <router-link :to="{ name: 'soccer_expert.results', params: { slug: category.slug } }" class="show active" id="result-component">
                {{ trans('strings.results') }}
           	</router-link>
           	<router-link :to="{ name: 'soccer_expert.ranks', params: { slug: category.slug } }" class="show" id="result-component">
                {{ trans('strings.rank') }}
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
        
        
        <div class="table text-center">
        	<div class="row no-margin table-head">
				<div class="col-lg-4 col-4 col-sm-4 col-md-4 table-column" @click="toggle('nome')">
	        		<span>
						{{ trans('strings.name') }}
					</span>
					<span v-if="'nome' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
				</div>
				<div class="col-lg-3 col-3 col-sm-3 col-md-3 table-column" @click="toggle('valor')">
	        		<span>
						{{ trans('strings.value') }}
					</span>
					<span v-if="'valor' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
				</div>
				<div class="col-lg-4 col-4 col-sm-4 col-md-4 table-column" @click="toggle('data_termino')">
	        		<span>
		      			{{ trans('strings.date_end') }}
		      		</span>
					<span v-if="'data_termino' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
				</div>

		    </div>

		    <div class="row no-margin table-body" v-if="loading.pagination">
	        	<div class="col-lg-12">
	        		<load-component></load-component>
	        	</div>
	        </div>

	        <div class="row no-margin table-body" v-else>
	        	<ticket-component v-for="(ticket, index) in tickets" :index="index" :key="index" :ticket="ticket" :category="category"></ticket-component>
	        </div>
	    </div>
        
	    
		<div class="row no-margin">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="pull-left">
                    <br>
                    <label style="text-transform: lowercase;">
                    	{{ trans('strings.page') }} {{ model.from }}/{{ model.to }} - {{ trans('strings.total') }}
                    </label>
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
	import TicketComponent from './Result/TicketComponent'
	export default {
		metaInfo () {
			return {
				title: this.trans('strings.result')+' '+this.category.nome,
				meta: [
		          	{ 
		          		name: 'description', 
		          		content: this.trans('strings.result')+' '+this.category.nome 
		          	}
		        ]
		    }
		},
		methods: {
			paginate(page) {
				this.query.page = page;
				this.resultRequest();
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

				this.resultRequest();
			},
			prev() {
				if(this.model.prev_page_url) {
					this.query.page--;
					this.resultRequest();
				}
			},
			next() {
				if(this.model.next_page_url) {
					this.query.page++;
					this.resultRequest();
				}
			},
			resultRequest() {

				const resultRequest = axios.create();
				resultRequest.interceptors.request.use(config => {
					this.loading.pagination = true
		        	return config;
				});

				this.$router.replace({
                    query: Object.assign(this.query)
                })

				let url = routes.soccer_experts.results.replace('{slug}', this.slug);
				url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;

				resultRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.model = response.data;
						this.tickets = response.data.data;
						this.loading.component = false
						this.loading.pagination = false;
						//this.scrollToTop();
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
				tickets: [],
				model: {},
				query: {
					id: '',
					slug: '',
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
			if(this.$route.query.slug) {
                this.query.slug = this.$route.query.slug
            } 
            if(this.$route.query.page) {
                this.query.page = this.$route.query.page
            }           
            if(this.$route.query.column) {
                this.query.column = this.$route.query.column
            }
            if(this.$route.query.direction) {
                this.query.direction = this.$route.query.direction
            }
            if(this.$route.query.nome) {
                this.query.nome = this.$route.query.nome
            }
            if(this.$route.query.valor) {
                this.query.valor = this.$route.query.valor
            }
            if(this.$route.query.data_termino) {
                this.query.data_termino = this.$route.query.data_termino
            }

			const showRequest = axios.create();
			this.slug = this.$route.params.slug;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			let url = routes.soccer_experts.find.replace('{slug}', this.slug);

			showRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.category = response.data;
				}
			}).catch((error) => {
				
			});

			this.resultRequest();
		},
		activated() {
			
		},
		components: {
			LoadComponent,
			TicketComponent,
			VcPagination
		},
		watch: {
			'query.page': function(newValue, oldValue) {}
		}
	}
</script>

<style scoped>
	
</style>