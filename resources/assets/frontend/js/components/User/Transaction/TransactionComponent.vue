<template>
	<load-component v-if="loading.component == true"></load-component>
   	<div class="container" v-else>
        <div class="sub-navigation">
            <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                {{ trans('strings.profile') }}
            </router-link>
            <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                {{ trans('strings.my_games') }}
            </router-link>
            <router-link class="nav-link active show" :to="{ name: 'users.transactions', params: {  } }">
                {{ trans('strings.transactions') }}
            </router-link>
            <!-- <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                {{ trans('strings.orders') }}
            </router-link> -->
        </div>


        <h3 class="page-header">
            {{ trans('strings.transactions') }}
        </h3>


        <table class="table text-center table-hover table-striped">
            <caption>
                <label style="text-transform: lowercase;">
                    {{ trans('strings.page') }} {{ model.from }}/{{ model.to }} - {{ trans('strings.total') }}  {{ trans('strings.of') }} {{ model.total }} {{ trans('strings.lines') }}
                </label>
                <br>
                <vc-pagination :source="model" @paginate="paginate"></vc-pagination>
            </caption>
            <thead class="thead-dark">
                <tr class="cursor-pointer">
                    <th scope="col" @click="toggle('created')">
                        <span>
                            {{ trans('strings.date') }}
                        </span>                     
                        <span v-if="'created' === query.column">
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
                            {{ trans('strings.modality') }}
                        </span>                     
                        <span v-if="'modality' === query.column">
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
                            {{ trans('strings.description') }}
                        </span>                     
                        <span v-if="'confirmacao' === query.column">
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
                            {{ trans('strings.type') }}
                        </span>
                        <span v-if="'tyoe' === query.column">
                            <span v-if="query.direction === 'desc'">
                                &darr;
                            </span>
                            <span v-else>
                                &uarr;
                            </span>
                        </span>
                    </th>
                    <th scope="col" @click="toggle('amount')">
                        <span>
                            {{ trans('strings.amount') }}
                        </span>
                        <span v-if="'amount' === query.column">
                            <span v-if="query.direction === 'desc'">
                                &darr;
                            </span>
                            <span v-else>
                                &uarr;
                            </span>
                        </span>
                    </th>
                    <th @click="toggle('from')">
                        <span>
                            {{ trans('strings.balance') }}
                        </span>
                        <span v-if="'from' === query.column">
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
            <tbody v-if="loading.pagination == true">
                <tr>
                    <td colspan="5">
                        <load-component></load-component>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                  <tr v-for="(balance, index) in balances">
                    <td>
                        {{ balance.created }}
                    </td>
                    <!-- Modalidade -->
                    <td v-if="balance.order_item">
                        {{ trans('strings.'+balance.order_item.type) }}
                    </td>
                    <td v-else-if="balance.scratch_card">
                        {{ trans('strings.scratch_card') }}
                    </td> 
                    <td v-else-if="balance.lottery_bet">
                        {{ trans('strings.lottery') }}
                    </td> 
                    <td v-else-if="balance.soccer_expert_bet">
                        {{ trans('strings.scratch_card') }}
                    </td> 
                    <td v-else-if="balance.pagseguro">
                        Pagseguro
                    </td> 
                    <td v-else-if="balance.paypal">
                        Paypal
                    </td>
                    <!-- Descrição -->
                    <td v-if="balance.order_item">
                        <vc-order-item :balance="balance" :order_item="balance.order_item"></vc-order-item>
                    </td>
                    <td v-else-if="balance.scratch_card">
                        <vc-scratchcard :balance="balance" :scratch_card="balance.scratch_card"></vc-scratchcard>
                    </td> 
                    <td v-else-if="balance.lottery_bet">
                        <vc-lottery :balance="balance" :lottery_bet="balance.lottery_bet"></vc-lottery>
                    </td> 
                    <td v-else-if="balance.soccer_expert_bet">
                        <vc-soccer-expert :balance="balance" :soccer_expert_bet="balance.soccer_expert_bet"></vc-soccer-expert>
                    </td> 
                    <td v-else-if="balance.pagseguro">
                        <vc-pagseguro :balance="balance" :pagseguro="balance.pagseguro"></vc-pagseguro>
                    </td> 
                    <td v-else-if="balance.paypal">
                        <vc-paypal :balance="balance" :paypal="balance.paypal"></vc-paypal>
                    </td> 
                    <td>
                        {{ trans('strings.'+balance.description) }}
                    </td>
                    <td>
                        <span class="btn btn-xs btn-danger" v-if="balance.amount < 0">
                            ${{ balance.amount }}
                        </span>
                        <span class="btn btn-xs btn-success" v-else>
                            $+{{ balance.amount }}
                        </span>
                    </td>
                    <td>
                        ${{ balance.to }}
                    </td>
                </tr>
            </tbody>
        </table>
	</div>
</template>

<script>
    import {routes} from '../../../api_routes'	
    import {mapState, mapGetters} from 'vuex'
    import LoadComponent from '../../Load'
    import VcPagination from '../../VcPagination'
    import VcOrderItem from './VcOrderItem'
    import VcScratchcard from './VcScratchcard'
    import VcSoccerExpert from './VcSoccerExpert'
    import VcLottery from './VcLottery'
    import VcPaypal from './VcPaypal'
    import VcPagseguro from './VcPagseguro'
    export default {
        methods: {
            confirmation(balance) {
                if(balance.order) {
                    this.order(balance.order);
                }
            },
            order(order) {

            },
            filter(event) {             
                $(event.target).find('[type="load"]').removeClass('hide');
                $(event.target).find('[type="submit"]').addClass('hide');
                this.historicRequest();
            },
            paginate(page) {
                this.query.page = page;
                this.historicRequest();
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

                this.historicRequest();
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.query.page--;
                    this.historicRequest();
                }
            },
            next() {
                if(this.model.next_page_url) {
                    this.query.page++;
                    this.historicRequest();
                }
            },
            historicRequest() {
                var historicRequest = axios.create();

                var url = routes.historic_balances.of_the_user.replace('{id}', this.auth.id);
                url += "?page="+this.query.page;
                url += "&column="+this.query.column;
                url += "&direction="+this.query.direction;
                url += "&amount="+this.query.amount;
                url += "&from="+this.query.from;

                historicRequest.interceptors.request.use(config => {
                    this.loading.component = true
                    return config;
                });
                
                this.$router.replace({
                    query: Object.assign(this.query)
                })

                historicRequest.get(url, {}, {}).then(response => {
                    if(response.status === 200) {
                        this.loading.component = false;
                        this.model = response.data;
                        this.balances = response.data.data;
                        this.scrollToTop();                          
                    }
                }).catch((error) => {
                    this.loading.component = false                   
                });
            }
        },
        data() {
    		return {
    			loading: {
                    component: true,
                    pagination: false
                },
                model: {},
                balances: [],
                query: {
                    id: '',
                    page: 1,
                    column: 'created',
                    direction: 'desc',
                    amount: '',
                    from: ''
                }
    		}
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
            if(this.$route.query.amount) {
                this.query.amount = this.$route.query.amount
            }
            if(this.$route.query.from) {
                this.query.from = this.$route.query.from
            }
            this.historicRequest();
        },
        components: {
        	LoadComponent,
            VcPagination,
            VcOrderItem,
            VcScratchcard,
            VcSoccerExpert,
            VcLottery,
            VcPaypal,
            VcPagseguro
        },
        computed: {
            ...mapGetters([
                'auth'
            ])
        }
    }
</script>

<style scoped>
    .btn-xs {
        font-size: 14px;
    }
</style>