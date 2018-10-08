<template>
    <load v-if="loading.component == true" />
    <div class="container" v-else>
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                    <router-link class="nav-link active show" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.my_games') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                    <!-- <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link> -->
                </div>
                <!-- <h3 class="page-header">
                    {{ trans('strings.games') }}
                </h3> -->
            </div>
        </div>
        

        <div class="table text-center">
            <div class="row no-margin table-head">
                <div class="col-lg-2 col-3 col-md-3 col-sm-3">
                    <span>
                        {{ trans('strings.game') }}
                    </span>                     
                    <span v-if="'game' === query.column">
                        <span v-if="query.direction === 'desc'">
                            &darr;
                        </span>
                        <span v-else>
                            &uarr;
                        </span>
                    </span>
                </div>
                <div class="col-lg-2 col-3 col-md-3 col-sm-3" @click="toggle('total')">
                    <span>
                        {{ trans('strings.total') }}
                    </span>                     
                    <span v-if="'total' === query.column">
                        <span v-if="query.direction === 'desc'">
                            &darr;
                        </span>
                        <span v-else>
                            &uarr;
                        </span>
                    </span>
                </div>
                <div class="col-lg-2 col-2 col-md-3 col-sm-2" @click="toggle('quantity')">
                    <span>
                        Qtd.
                    </span>
                    <span v-if="'quantity' === query.column">
                        <span v-if="query.direction === 'desc'">
                            &darr;
                        </span>
                        <span v-else>
                            &uarr;
                        </span>
                    </span>
                </div>
                <div class="col-lg-2 col-4 col-md-3 col-sm-4" @click="toggle('created_at')">
                    <span>
                        {{ trans('strings.date') }}
                    </span>
                    <span v-if="'created_at' === query.column">
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
                    <load></load>
                </div>
            </div>
            
            <div v-for="(item, index) in items" :key="index" class="row no-margin table-body">
                <vc-soccer-expert :key="index" :index="index" :item="item" v-if="item.type == 'soccer_expert'" />
                <vc-scratch-card :key="index" :index="index" :item="item" v-if="item.type == 'scratch_card'" />
                <vc-lottery :key="index" :index="index" :item="item" v-if="item.type == 'lottery'" />
                <vc-league-cup :key="index" :index="index" :item="item" v-if="item.type == 'cartoleando' && item.league && item.league.context == 'cup'" />
                <vc-league-classic :key="index" :index="index" :item="item" v-if="item.type == 'cartoleando' && item.league && item.league.context == 'classic'" />
                <!-- <vc-cartoleando :key="index" :index="index" :item="item" v-if="item.type == 'cartoleando'" /> -->
            </div>           
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="pull-left">
                    <br>
                    <label style="text-transform: lowercase;">
                        {{ trans('strings.page') }} {{ model.from }}/{{ model.to }} - {{ trans('strings.total') }}  {{ trans('strings.of') }} {{ model.total }} {{ trans('strings.lines') }}
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
    import {routes} from '../../../api_routes';
    import {mapGetters} from 'vuex';
    import VcPagination from '../../VcPagination';
    import VcSoccerExpert from './SoccerExpert/VcSoccerExpert';
    import VcScratchCard from './ScratchCard/VcScratchCard';
    import VcLottery from './Lottery/VcLottery';
    import VcLeagueClassic from './LeagueClassic/VcClassic';
    import VcLeagueCup from './LeagueCup/VcCup';
    import VcCartoleando from './Cartoleando/VcCartoleando';
    export default {
        metaInfo () {
            return {
                title: this.trans('strings.games')+ ' | '+ this.trans('strings.lottoyou'),
                meta: [
                    {
                        name: 'description',
                        content: this.trans('strings.games'),
                    }
                ]
            }
        },
        data () {
            return {
                loading: {
                    component: true
                },
                model: {},
                items: [],
                query: {
                    id: '',
                    page: 1,
                    column: 'created_at',
                    direction: 'desc',
                    lottery_bet_id: '',
                }
            }
        },
        methods: {
            itemsRequest () {
                var itemsRequest = axios.create();

                /*var url = routes.users.items.replace('{id}', this.auth.id);
                url += "?page="+this.query.page;
                url += "&column="+this.query.column;
                url += "&direction="+this.query.direction;
                url += "&id="+this.query.id;
                url += "&lottery_bet_id="+this.query.lottery_bet_id;*/
                var url = routes.users.items;

                this.$router.replace({
                    query: Object.assign(this.query)
                })

                let headers = {};
				if(this.auth) {
					headers.headers = {
						'Content-Type' : 'application/json',
						'Accept' : 'application/json',
						'Authorization': 'Bearer ' + this.auth.access_token
					};
				} 

                itemsRequest.interceptors.request.use(config => {
                    this.loading.component = true
                    return config;
                });

                itemsRequest.post(url, {
                    page: this.query.page,
                    column: this.query.column,
                    direction: this.query.direction,
                    id: this.query.id,
                    lottery_bet_id:  this.query.lottery_bet_id
                }, headers).then(response => {
                    if(response.status === 200) {
                        this.loading.component = false;
                        this.model = response.data;  
                        //console.log(response.data.data)
                        /*response.data.data.forEach((val) => {
                            val.data = JSON.parse(val.data);
                        });*/
                        //this.items = response.data.data;
                        this.items = response.data.data;
                        //console.log(this.items)
                        //this.scrollToTop();
                    }
                }).catch((error) => {
                    //this.$router.push({name: 'users.account'});                  
                });
            },
            paginate (page) {
                this.query.page = page;
                this.itemsRequest();
            },
            toggle (column) {
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

                this.itemsRequest();
            },
            prev () {
                if(this.model.prev_page_url) {
                    this.query.page--;
                    this.itemsRequest();
                }
            },
            next () {
                if(this.model.next_page_url) {
                    this.query.page++;
                    this.itemsRequest();
                }
            },
        },      
        computed: {
            ...mapGetters([
                'auth'
            ])
        },
        mounted() {
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
            if(this.$route.query.lottery_bet_id) {
                this.query.lottery_bet_id = this.$route.query.lottery_bet_id
            }

            this.itemsRequest(); 
        },
        components: {
            VcPagination,
            VcSoccerExpert,
            VcScratchCard,
            VcLottery,
            VcLeagueClassic,
            VcLeagueCup,
            VcCartoleando
        }
    }
</script>

<style scoped>
    .table {
        margin-bottom: 0;
    }    
</style>