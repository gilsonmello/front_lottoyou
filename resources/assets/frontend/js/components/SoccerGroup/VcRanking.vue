<template>
	<vc-load v-if="loading.component == true"></vc-load>
	<div class="container" v-else>


		<div class="row">
			<div class="col-lg-12 col-12 col-md-12 col-sm-12">
				<h3 class="page-header" v-if="group" style="border: none; margin-bottom: 0;">
					<span style="display: block;">{{ group.round.category.nome }} - {{ group.round.nome }}</span>
					<span>{{ trans('strings.ranking') }} - Grupo {{ group.identificacao }}</span>
					<router-link class="btn btn-md btn-back pull-right btn-primary" :to="{name: 'soccer_expert.ranks', params: { id: group.round.category.id }}">
						<i class="fa fa-arrow-left"></i>
						{{ trans('strings.back') }}
					</router-link>
				</h3>
			</div>
		</div>


		<form @submit.prevent="filter" class="form-filter">
			<div class="row">
			  	<div class="col-lg-4 col-12 col-sm-4 col-md-4">
	                <div class="form-group">
	                    <label for="nickname">{{ trans('strings.user') }}</label>
	                    <input v-model="query.nickname" type="text" class="form-control" id="nickname" aria-describedby="nickname" name="nickname" :placeholder="trans('strings.nickname')">
	                </div>
	            </div>
	            <div class="col-lg-4 col-12 col-sm-4 col-md-4">
	            	<label>&nbsp;</label>
	            	<button style="display: block" type="submit" class="btn btn-md btn-primary">
                        {{ trans('strings.search') }}
                    </button>
                    <button style="display: block" @click.prevent="" type="load" class="hide btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>
	            </div>
            </div>
		</form>
        
        <div class="row">
        	<div class="col-lg-12">
        		<small>Pts = pontos;</small>&nbsp;
        		<small>PBL = pontos bola lottoyou;</small>&nbsp;
        		<small>AP = número de acerto de placares;</small>&nbsp;
        		<small>DG = número de acerto de diferença de gol (inclui empate sem acertar o placar);</small>
        	</div>
        </div>
        <div class="table">
        	<div class="row no-margin table-head" style="overflow: auto;">
        		<div class="col-lg-3 col-4 col-sm-3 col-md-3 table-column text-center" @click="toggle('posicao')">
	        		<span>
						&nbsp;
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
	        	<div class="col-lg-1 col-2 col-sm-2 col-md-1 table-column text-center" @click="toggle('pontuacao')">
	        		<span data-toggle="tooltip" data-placement="top" :title="trans('strings.point')">
		      			Pts
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
	        	<div class="col-lg-1 col-2 col-sm-2 col-md-1 table-column text-center" @click="toggle('pontuacao_bola_ouro')" >
	        		<span data-toggle="tooltip" data-placement="top" :title="trans('strings.gold_ball')">
		      			BO
		      		</span>
		      		<span v-if="'pontuacao_bola_ouro' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
	        	</div>
	        	<div class="col-lg-1 col-2 col-sm-2 col-md-1 table-column text-center" @click="toggle('qtd_acertos_placares')">
	        		<span data-toggle="tooltip" data-placement="top" :title="trans('strings.score_hits')">
		      			AP
		      		</span>
		      		<span v-if="'qtd_acertos_placares' === query.column">
		    			<span v-if="query.direction === 'desc'">
		    				&darr;
			    		</span>
			    		<span v-else>
		    				&uarr;
			    		</span>
		    		</span>
	        	</div>
	        	<div class="col-lg-1 col-2 col-sm-2 col-md-1 table-column text-center" @click="toggle('qtd_acertos_diferenca_gols_ou_empate')">
	        		<span data-toggle="tooltip" data-placement="top" :title="trans('strings.goal_difference_or_draws')">
		      			DG
		      		</span>
		      		<span v-if="'qtd_acertos_diferenca_gols_ou_empate' === query.column">
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

	        <div class="row no-margin table-body" style="overflow: auto;" v-else>
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
                        //this.scrollToTop();
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