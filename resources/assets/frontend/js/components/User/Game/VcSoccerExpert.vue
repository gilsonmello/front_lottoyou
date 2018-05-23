<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                    <!-- <router-link class="nav-link active show" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.games') }}
                    </router-link> -->
                    <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                        <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link>
                </div>
            </div>
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <router-link class="nav-link active show" :to="{ name: 'users.soccer_experts', params: {  } }">
                    {{ trans('strings.soccer_expert') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.scratch_cards', params: {  } }">
                    {{ trans('strings.scratch_cards') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.lotteries', params: {  } }">
                    {{ trans('strings.lotteries') }}
                </router-link>
            </li>
        </ul>

        <div class="table">
	        <div class="row table-head">
		    	<div class="col-lg-2" @click="toggle('id')">
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
	        	</div>
	        	<div class="col-lg-2">
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
	        	</div>
	        	<div class="col-lg-2" @click="toggle('owner_id')">
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
	        	</div>
	        	<div class="col-lg-2" @click="toggle('pontuacao')">
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
	        	</div>
		    </div>


		    <div class="row table-body">
			    <load-component v-if="loading.pagination == true"></load-component>
		    	<vc-bet v-else v-for="(bet, index) in bets" :index="index" :key="index" :bet="bet">
		    	</vc-bet>
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
                    <!-- <button class="btn btn-xs" @click="prev()">&laquo;</button>
                    <button class="btn btn-xs" @click="next()">&raquo;</button> -->
                </div>
            </div>
        </div>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
    import {mapState, mapGetters} from 'vuex'
	import LoadComponent from '../../Load'
	import VcPagination from '../../VcPagination'
	import VcBet from './SoccerExpert/VcBet'
	export default {
		data() {
    		return {
    			loading: {
                    component: true
                },
                games: [],
                model: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                }
    		}
    	},
		methods: {
			soccerRequest() {
                var soccerRequest = axios.create();

                var url = routes.users.soccer_experts.replace('{id}', this.auth.id);
                url += "?page="+this.query.page;
				url += "&column="+this.query.column;
				url += "&direction="+this.query.direction;

                soccerRequest.interceptors.request.use(config => {
                    this.loading.component = true
                    return config;
                });
                soccerRequest.get(url, {}, {}).then(response => {
                    if(response.status === 200) {
                        this.loading.component = false;
                          
                    }
                }).catch((error) => {
                    this.loading.component = false                   
                });
            },
            paginate(page) {
                this.query.page = page;
                this.soccerRequest();
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

                this.soccerRequest();
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.query.page--;
                    this.soccerRequest();
                }
            },
            next() {
                if(this.model.next_page_url) {
                    this.query.page++;
                    this.soccerRequest();
                }
            },
		},		
        computed: {
            ...mapState({
                User: state => state.User
            }),
            ...mapGetters([
                'auth'
            ])
        },
        mounted() {
        	this.soccerRequest();
        },
        components: {
        	LoadComponent,
        	VcPagination,
        	VcBet
        }
	}
</script>

<style scoped>
	
</style>