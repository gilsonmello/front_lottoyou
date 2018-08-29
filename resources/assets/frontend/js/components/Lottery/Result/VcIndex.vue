<template>
	<load v-if="loading.component == true"></load>
	<section class="container" v-else>
		<div class="sub-navigation">
			<router-link :to="{ name: 'lotteries.play', params: { slug: slug } }" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ category.nome }} 
            </router-link>
            <router-link :to="{ name: 'lotteries.results', params: { slug: slug } }" class="show active" id="result-component">
                {{ trans('strings.results') }}
           	</router-link>
		</div>

		<form @submit.prevent="filter" class="form-filter">
			<div class="row">
			  	<div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="sweepstake">{{ trans('strings.sweepstake') }}</label>
	                    <input v-model="query.sorteio" type="text" class="form-control" id="sweepstake" aria-describedby="sweepstake" :placeholder="trans('strings.sweepstake')">
	                </div>
	            </div>
	            <div class="col-lg-4 col-12 col-sm-4 col-md-4 container_date_end">
	                <div class="form-group">
					    <label for="date_end">{{ trans('strings.date_end') }}</label>
					    <datepicker id="date_end" :placeholder="trans('strings.date_end')" v-model="query.data_fim" class="form-control" />
				  	</div>
	            </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" v-if="!loading.pagination" class="btn btn-md btn-primary">
                        {{ trans('strings.filter') }}
                    </button>
                    <button @click.prevent="" v-else class="btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>
                </div>
            </div>
		</form>
        
        <br>



		<div class="table text-center">
        	<div class="row no-margin table-head">
		    	<div class="col-lg-2" @click="toggle(column)" v-for="(column, index) in columns">
		    		<span v-if="column === 'sorteio'">
		    			{{ trans('strings.sweepstake') }}
		    		</span>
		    		<span v-else-if="column === 'premio'">
		    			{{ trans('strings.jackpot') }}
		    		</span>
		    		<span v-else-if="column === 'data_fim'">
		    			{{ trans('strings.date_end') }}
		    		</span>
		    		<span v-else-if="column === 'concurso'">
		    			{{ trans('strings.contest') }}
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

		    <div class="row no-margin table-body" v-if="loading.pagination">
	        	<div class="col-lg-12">
	        		<load />
	        	</div>
	        </div>

	        <div class="row no-margin table-body" v-else>
	        	<vc-sweepstake v-for="(sweepstake, index) in sweepstakes" :key="index" :index="index" :sweepstake="sweepstake" />
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
                	<vc-pagination :source="model" @paginate="paginate" />
                </div>
            </div>
        </div>

	</section>
</template>

<style scoped>
	
</style>

<script>
	import {routes} from '../../../api_routes'
	import VcPagination from '../../VcPagination'
	import VcSweepstake from './VcSweepstake'
	export default {
		metaInfo () {
			return {
				title: this.trans('strings.results')+' '+this.category.nome+ ' | '+ this.trans('strings.lottoyou'),
				meta: this.metas
		    }
		},
		methods: {
			filter (event) {				
				this.resultRequest();
			},
			paginate (page) {
				this.query.page = page;
				this.resultRequest();
			},
			toggle (column) {
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
			prev () {
				if(this.model.prev_page_url) {
					this.query.page--;
					this.resultRequest();
				}
			},
			next () {
				if(this.model.next_page_url) {
					this.query.page++;
					this.resultRequest();
				}
			},
			findRequest () {
				const findRequest = axios.create();
				
				findRequest.interceptors.request.use(config => {
					return config;
				});

				let url = routes.lotteries.find.replace('{slug}', this.slug);

				findRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.id = response.data.id;
						this.category = response.data;

						this.metas.push({
	            			name: 'description',
	            			content: this.category.nome,
	            		});
	            		this.metas.push({
	            			name: 'description',
	            			content: this.category.slug,
	            		});
					}
				}).catch((error) => {
					
				});
			},
			resultRequest () {

				const resultRequest = axios.create();
				resultRequest.interceptors.request.use(config => {
					this.loading.pagination = true
		        	return config;
				});

				this.$router.replace({
                    query: Object.assign(this.query)
                })

				let url = routes.lotteries.results.replace('{slug}', this.slug);
				url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;
				url += "&sorteio="+this.query.sorteio;
				url += "&data_fim="+this.query.data_fim;

				resultRequest.get(url, {}, {}).then(response => {
					if(response.status === 200) {
						this.model = response.data;
						this.sweepstakes = response.data.data;
						this.loading.component = false;
						this.loading.pagination = false;
						setTimeout(() => {
                            window.prerenderReady = true;
                        }, 1000);
					}
				}).catch((error) => {
					this.loading.component = false;
					this.loading.pagination = false;
                    setTimeout(() => {
                        window.prerenderReady = true;
                    }, 1000);
				});
			}
		},
		data () {
			return {
				loading: {
					component: true,
					pagination: false
				},
				category: {},
				columns: ['sorteio', 'concurso', 'premio', 'data_fim'],
				id: '',
				results: [],
				sweepstakes: [],
				slug: '',
				metas: [],
				model: {},
				query: {
					page: 1,
					column: 'sorteio',
					direction: 'asc',
					id: '',
					sorteio: '',
					premio: '',
					data_fim: '',
				}
			}
		},
		mounted () {
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
            if(this.$route.query.sorteio) {
                this.query.sorteio = this.$route.query.sorteio
            }
            if(this.$route.query.premio) {
                this.query.premio = this.$route.query.premio
            }
            if(this.$route.query.data_fim) {
                this.query.data_fim = this.$route.query.data_fim
            }
			this.slug = this.$route.params.slug;
			this.findRequest();
			this.resultRequest();
			this.category.nome = this.trans('strings.loading');
		},
		components: {
			VcPagination,
			VcSweepstake
		}
	}
</script>
