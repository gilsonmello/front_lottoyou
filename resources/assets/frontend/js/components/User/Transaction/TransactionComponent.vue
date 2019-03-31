<template>
  <load v-if="loading.component == true"/>
  <div class="container" v-else>
    <div class="sub-navigation">
      <router-link
        class="nav-link"
        :to="{ name: 'users.account', params: {  } }"
      >{{ trans('strings.profile') }}</router-link>
      <router-link
        class="nav-link"
        :to="{ name: 'users.games', params: {  } }"
      >{{ trans('strings.my_games') }}</router-link>
      <router-link
        class="nav-link active show"
        :to="{ name: 'users.transactions', params: {  } }"
      >{{ trans('strings.transactions') }}</router-link>
      <!-- <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                {{ trans('strings.orders') }}
      </router-link>-->
    </div>

    <!-- <h3 class="page-header">
            {{ trans('strings.transactions') }}
    </h3>-->

    <table class="table text-center table-hover table-striped table-responsive">
      <caption>
        <label
          style="text-transform: lowercase;"
        >{{ trans('strings.page') }} {{ model.from }}/{{ model.to }} - {{ trans('strings.total') }} {{ trans('strings.of') }} {{ model.total }} {{ trans('strings.lines') }}</label>
        <br>
        <vc-pagination :source="model" @paginate="paginate"></vc-pagination>
      </caption>
      <thead class="thead-dark">
        <tr class="cursor-pointer">
          <th scope="col" @click="toggle('created')">
            <span>{{ trans('strings.date') }}</span>
            <span v-if="'created' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
          <th>
            <span>{{ trans('strings.modality') }}</span>
            <span v-if="'modality' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
          <th>
            <span>{{ trans('strings.description') }}</span>
            <span v-if="'confirmacao' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
          <th>
            <span>{{ trans('strings.type') }}</span>
            <span v-if="'tyoe' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
          <th scope="col" @click="toggle('amount')">
            <span>{{ trans('strings.amount') }}</span>
            <span v-if="'amount' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
          <th @click="toggle('from')">
            <span>{{ trans('strings.balance') }}</span>
            <span v-if="'from' === query.column">
              <span v-if="query.direction === 'desc'">&darr;</span>
              <span v-else>&uarr;</span>
            </span>
          </th>
        </tr>
      </thead>
      <tbody v-if="loading.pagination == true">
        <tr>
          <td colspan="5">
            <load/>
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(balance, index) in balances" :key="index">
          <td>{{ balance.created }}</td>
          <!-- Modalidade -->
          <td v-if="balance.order_item">{{ trans('strings.'+balance.order_item.type) }}</td>
          <td v-else-if="balance.scratch_card">{{ trans('strings.scratch_card') }}</td>
          <td v-else-if="balance.lottery_bet">{{ trans('strings.lottery') }}</td>
          <td v-else-if="balance.soccer_expert_bet">{{ trans('strings.soccer_expert') }}</td>
          <td v-else-if="balance.pagseguro">{{ trans('strings.deposit') }}</td>
          <td v-else-if="balance.paypal">{{ trans('strings.deposit') }}</td>
          <td
            v-else-if="balance.agent_withdraw || balance.paypal_withdraw"
          >{{ trans('strings.withdrawal') }}</td>
          <td v-else-if="balance.balance_insert">{{ trans('strings.balance') }}</td>
          <td
            v-else-if="balance.lea_classic_team || balance.lea_cup_team"
          >{{ trans('strings.cartoleando') }}</td>
          <!-- Descrição -->
          <td>
            <router-link
              v-if="balance.modality === 'buy'"
              :to="{name: 'users.games', query: {id: balance.order_item.id, page: 1, column: 'created_at', direction: 'asc'}}"
              class="btn-link"
            >{{ balance.description }}</router-link>
            <span v-else>{{ balance.description }}</span>
          </td>
          <!-- <td v-if="balance.order_item">
                        <vc-order-item :balance="balance" :order_item="balance.order_item" />
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
                    <td v-else-if="balance.agent_withdraw">
                        <vc-withdraw-agent :balance="balance" :withdraw="balance.agent_withdraw" />
                    </td> 
                    <td v-else-if="balance.balance_insert">
                        <vc-balance-insert :balance="balance" :insert="balance.balance_insert" />
                    </td> 
                    <td v-else-if="balance.lea_classic_team">
                        <vc-lea-classic-team :balance="balance" :team="balance.lea_classic_team" />
                    </td> 
                    <td v-else-if="balance.lea_cup_team">
                        <vc-lea-cup-team :balance="balance" :team="balance.lea_cup_team" />
          </td>-->
          <td>{{ trans('strings.'+balance.modality) }}</td>
          <td>
            <span
              class="btn btn-xs btn-danger"
              v-if="balance.amount < 0"
            >{{getSystemCurrency.data.symbol}}{{ balance.amount }}</span>
            <span
              class="btn btn-xs btn-success"
              v-else
            >{{getSystemCurrency.data.symbol}}+{{ balance.amount }}</span>
          </td>
          <td>{{getSystemCurrency.data.symbol}}{{ balance.to }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { routes, getHeaders } from "../../../api_routes";
import { mapState, mapGetters } from "vuex";
import VcPagination from "../../VcPagination";
import VcOrderItem from "./VcOrderItem";
import VcScratchcard from "./VcScratchcard";
import VcSoccerExpert from "./VcSoccerExpert";
import VcLottery from "./VcLottery";
import VcPaypal from "./VcPaypal";
import VcPagseguro from "./VcPagseguro";
import VcWithdrawAgent from "./VcWithdrawAgent";
import VcBalanceInsert from "./VcBalanceInsert";
import VcCartoleando from "./VcCartoleando";
import VcLeaClassicTeam from "./VcLeaClassicTeam";
import VcLeaCupTeam from "./VcLeaCupTeam";
export default {
  metaInfo() {
    return {
      title:
        this.trans("strings.transactions") +
        " | " +
        this.trans("strings.lottoyou"),
      meta: [
        {
          name: "description",
          content:
            this.trans("strings.transactions") +
            " | " +
            this.trans("strings.lottoyou")
        }
      ]
    };
  },
  methods: {
    getComponentName(context) {
      let names = {
        order_item: "vc-order-item"
      };

      return names[context];
    },
    confirmation(balance) {
      if (balance.order) {
        this.order(balance.order);
      }
    },
    order(order) {},
    filter(event) {
      $(event.target)
        .find('[type="load"]')
        .removeClass("hide");
      $(event.target)
        .find('[type="submit"]')
        .addClass("hide");
      this.historicRequest();
    },
    paginate(page) {
      this.query.page = page;
      this.historicRequest();
    },
    toggle(column) {
      if (this.query.column == column) {
        if (this.query.direction == "desc") {
          this.query.direction = "asc";
        } else {
          this.query.direction = "desc";
        }
      } else {
        this.query.column = column;
        this.query.direction = "asc";
      }

      this.historicRequest();
    },
    prev() {
      if (this.model.prev_page_url) {
        this.query.page--;
        this.historicRequest();
      }
    },
    next() {
      if (this.model.next_page_url) {
        this.query.page++;
        this.historicRequest();
      }
    },
    historicRequest() {
      const historicRequest = axios.create();

      /*var url = routes.historic_balances.of_the_user.replace('{id}', this.auth.id);
                url += "?page="+this.query.page;
                url += "&column="+this.query.column;
                url += "&direction="+this.query.direction;
                url += "&amount="+this.query.amount;
                url += "&from="+this.query.from;*/

      const url = routes.historic_balances.of_the_user;

      historicRequest.interceptors.request.use(config => {
        this.loading.component = true;
        return config;
      });

      this.$router.replace({
        query: Object.assign(this.query)
      });

      historicRequest
        .post(url, {
          page: this.query.page,
          column: this.query.column,
          direction: this.query.direction,
          amount: this.query.amount,
          from: this.query.from
        })
        .then(response => {
          if (response.status === 200) {
            this.loading.component = false;
            this.model = response.data;
            this.balances = response.data.data;
            //this.scrollToTop();
          }
        })
        .catch(error => {
          this.loading.component = false;
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
        id: "",
        page: 1,
        column: "created",
        direction: "desc",
        amount: "",
        from: ""
      }
    };
  },
  mounted() {
    if (this.$route.query.id) {
      this.query.id = this.$route.query.id;
    }
    if (this.$route.query.page) {
      this.query.page = this.$route.query.page;
    }
    if (this.$route.query.column) {
      this.query.column = this.$route.query.column;
    }
    if (this.$route.query.direction) {
      this.query.direction = this.$route.query.direction;
    }
    if (this.$route.query.amount) {
      this.query.amount = this.$route.query.amount;
    }
    if (this.$route.query.from) {
      this.query.from = this.$route.query.from;
    }
    this.historicRequest();
  },
  components: {
    VcPagination,
    VcOrderItem,
    VcScratchcard,
    VcSoccerExpert,
    VcLottery,
    VcPaypal,
    VcPagseguro,
    VcWithdrawAgent,
    VcBalanceInsert,
    VcLeaClassicTeam,
    VcLeaCupTeam
  },
  computed: {
    ...mapGetters(["auth", "getSystemCurrency"])
  }
};
</script>

<style scoped>
.btn-xs {
  font-size: 14px;
}
</style>