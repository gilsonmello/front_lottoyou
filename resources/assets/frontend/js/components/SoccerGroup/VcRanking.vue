<template>
	<vc-load v-if="loading.component == true"></vc-load>
	<div class="container" v-else>

		<h1 class="page-header" v-if="group">
		  	<span style="display: block;">{{ group.round.category.nome }} - {{ group.round.nome }}</span>
		  	<span>{{ trans('strings.ranking') }} - Grupo {{ group.identificacao }}</span>
		</h1>


		<form @submit.prevent="filter" class="form-filter">
			<div class="row">
			  	<div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="nickname">{{ trans('strings.user') }}</label>
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

        <div class="table text-center">
        	<div class="row no-margin table-head">
        		<div class="col-lg-2 table-column" @click="toggle('posicao')">
	        		<span>
						{{ trans('strings.positions') }}
					</span>			    		
					<span v-if="'posicao' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
	        	</div>
	        	<div class="col-lg-2 table-column">
	        		<span>
						{{ trans('strings.photo') }}
					</span>
					<span v-if="'photo' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
	        	</div>
	        	<div class="col-lg-2 table-column" @click="toggle('owner_id')">
	        		<span>
		      			{{ trans('strings.user') }}
		      		</span>
		      		<span v-if="'owner_id' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
	        	</div>
	        	<div class="col-lg-2 table-column" @click="toggle('pontuacao')">
	        		<span>
		      			{{ trans('strings.points') }}
		      		</span>
		      		<span v-if="'pontuacao' === query.column">
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
	        		<vc-load></vc-load>
	        	</div>
	        </div>

	        <div class="row no-margin table-body" v-else>
	        	<vc-ticket v-for="(ticket, index) in tickets" :key="index" :index="index" :ticket="ticket">
			    	
			    </vc-ticket>
	        </div>
        </div>

        

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
	import VcTicket from './VcTicket'
	export default {
		beforeRouteUpdate: function(to, from, next) {
			
			next();
			if(this.id != to.params.id) {
				this.init();
			}
			
        },
		data() {
			return {
				loading: {
					component: true,
					pagination: false
				},
				id: null,
				tickets: [],
				total: 0,
				category: {},
				group: {},
				model: {},
				bet: {},
				query: {
					id: '',
					page: 1,
					column: 'posicao',
					direction: 'asc',
					nickname: '',
					valor: '',
					data_termino: '',
				}
			}
		},
		mounted() {
			this.init();
		},
		components: {
			VcLoad,
			VcPagination,
			VcTicket
		},
		methods: {
			init() {
				this.id = this.$route.params.id;
				if(this.$route.query.id) {
	                this.query.id = this.$route.query.id
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
	            if(this.$route.query.nickname) {
	                this.query.nickname = this.$route.query.nickname
	            }
	            if(this.$route.query.valor) {
	                this.query.valor = this.$route.query.valor
	            }
	            if(this.$route.query.data_termino) {
	                this.query.data_termino = this.$route.query.data_termino
	            }

				this.groupRequest();
				this.rankRequest();
			},
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

				console.log('lsjfks')
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

				this.$router.replace({
                    query: Object.assign(this.query)
                })

				let url = routes.soccer_groups.ranking.replace('{id}', this.id);
				url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;
				url += "&nickname="+this.query.nickname;

				rankingRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.model = response.data;
						this.total = this.model.total;
						this.tickets = response.data.data;
						this.loading.component = false
						this.loading.pagination = false

                        $(this.$el).find('.form-filter [type="load"]').addClass('hide');
                        $(this.$el).find('.form-filter [type="submit"]').removeClass('hide');
                        this.scrollToTop();
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
	
</style>