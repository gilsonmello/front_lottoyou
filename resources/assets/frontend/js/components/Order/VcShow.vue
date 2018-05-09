<template>
    <load-component v-if="loading.component == true"></load-component>
    <div class="container" v-else>
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                        <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.games') }}
                    </router-link>
                        <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                        <router-link class="nav-link active show" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" @click="toggle('id')">
                        <span>
                            {{ trans('strings.id') }}
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
                    <th scope="col" @click="toggle('total')">
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
                    </th>
                    <th scope="col" @click="toggle('sub_total')">
                        <span>
                            {{ trans('strings.sub_total') }}
                        </span>
                        <span v-if="'sub_total' === query.column">
                            <span v-if="query.direction === 'desc'">
                                &darr;
                            </span>
                            <span v-else>
                                &uarr;
                            </span>
                        </span>
                    </th>
                    <th scope="col" @click="toggle('number_items')">
                        <span>
                            {{ trans('strings.number_items') }}
                        </span>
                        <span v-if="'number_items' === query.column">
                            <span v-if="query.direction === 'desc'">
                                &darr;
                            </span>
                            <span v-else>
                                &uarr;
                            </span>
                        </span>
                    </th>
                    <th @click="toggle('created_at')">
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
                    </th>
                    <th>
                        <span>{{ trans('strings.actions') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody v-if="loading.pagination == true">
                <tr>
                    <td colspan="5">
                        <load-component></load-component>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr v-for="(order, index) in items">
                    
                    
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
                    <!-- <button class="btn btn-xs" @click="prev()">&laquo;</button>
                    <button class="btn btn-xs" @click="next()">&raquo;</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {routes} from '../../api_routes'
    import {mapState, mapGetters} from 'vuex'
    import LoadComponent from '../Load'
    import VcPagination from '../VcPagination'
    export default {
        data() {
            return {
                loading: {
                    component: true
                },
                model: {},
                id: null,
                items: [],
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                }
            }
        },
        methods: {
            orderRequest() {
                var orderRequest = axios.create();

                var url = routes.orders.items.replace('{id}', this.id);
                url += "?page="+this.query.page;
                url += "&user_id="+this.auth.id;
                url += "&column="+this.query.column;
                url += "&direction="+this.query.direction;

                orderRequest.interceptors.request.use(config => {
                    this.loading.component = true
                    return config;
                });
                orderRequest.get(url, {}, {}).then(response => {
                    if(response.status === 200) {
                        this.loading.component = false;
                        this.model = response.data;
                        this.items = response.data.data;                          
                    }
                }).catch((error) => {
                    //this.$router.push({name: 'users.account'});                  
                });
            },
            paginate(page) {
                this.query.page = page;
                this.orderRequest();
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

                this.orderRequest();
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.query.page--;
                    this.orderRequest();
                }
            },
            next() {
                if(this.model.next_page_url) {
                    this.query.page++;
                    this.orderRequest();
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
            this.id = this.$route.params.id;
            this.orderRequest();
        },
        components: {
            LoadComponent,
            VcPagination
        }
    }
</script>

<style scoped>
    
</style>