export default {
  routes: [
    {
      path: "/",
      component: require(`@c/MainComponent.vue`),
      children: [
        {
          path: "",
          name: "home",
          component: require(`@c/HomeComponent.vue`),
          props: true
        },
        {
          path: "create_your_league",
          name: "create_your_league",
          props: true,
          component: require(`@c/VcCreateYourLeague.vue`)
        },
        {
          path: "help",
          name: "help",
          props: true,
          component: require(`@c/VcHelp.vue`)
        },
        {
          path: "contacts/create",
          name: "contacts.create",
          props: true,
          component: require(`@c/Contact/VcCreate`)
        },
        {
          path: "privacy",
          name: "privacy",
          props: true,
          component: require(`@c/VcPrivacy.vue`)
        },
        {
          path: "player_protection",
          name: "player_protection",
          props: true,
          component: require(`@c/VcPlayerProtection.vue`)
        },
        {
          path: "how_to_play_soccer_expert",
          name: "how_to_play_soccer_expert",
          props: true,
          component: require(`@c/VcHowToPlaySoccerExpert.vue`)
        },
        {
          path: "how_to_play_easy_money",
          name: "how_to_play_easy_money",
          props: true,
          component: require(`@c/VcHowToPlayEasyMoney.vue`)
        },
        {
          path: "how_to_play_cartoleando",
          name: "how_to_play_cartoleando",
          props: true,
          component: require(`@c/VcHowToPlayCartoleando.vue`)
        },
        {
          path: "login",
          name: "login",
          props: true,
          component: require(`@c/LoginComponent.vue`)
        },
        {
          path: "register",
          name: "users.register",
          props: true,
          component: require(`@c/User/RegisterComponent.vue`)
        },
        {
          path: "users/activate/:hash",
          name: "users.activate",
          props: true,
          component: require(`@c/User/VcActivate.vue`)
        },
        {
          path: "users/account",
          name: "users.account",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/VcAccount.vue`)
        },
        {
          path: "users/forgot_password",
          name: "users.forgot_password",
          props: true,
          meta: {},
          component: require(`@c/User/VcForgotPassword.vue`)
        },
        {
          path: "users/password_recovery/:hash",
          name: "users.password_recovery",
          props: true,
          meta: {},
          component: require(`@c/User/VcPasswordRecovery`)
        },
        {
          path: "users/games",
          name: "users.games",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/Game/VcGame.vue`)
        },
        {
          path: "users/logout",
          name: "users.logout",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/LogoutComponent.vue`)
        },
        {
          path: "users/orders",
          name: "users.orders",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/Order/VcIndex.vue`)
        },
        {
          path: "users/disable",
          name: "users.disable",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/VcDisable.vue`)
        },
        {
          path: "orders/show/:id",
          name: "orders.show",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Order/VcShow.vue`)
        },
        {
          path: "users/transactions",
          name: "users.transactions",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/User/Transaction/TransactionComponent.vue`)
        },
        {
          path: "scratch_cards",
          name: "scratch_cards.index",
          props: true,
          component: require(`@c/ScratchCard/IndexComponent.vue`)
        },
        {
          path: "soccer_expert",
          name: "soccer_expert.index",
          component: require(`@c/SoccerExpert/IndexComponent.vue`)
        },
        {
          path: "soccer_expert/play/:slug",
          name: "soccer_expert.play",
          props: true,
          component: require(`@c/SoccerExpert/ShowComponent.vue`)
        },
        {
          path: "soccer_expert/ranks/:slug",
          name: "soccer_expert.ranks",
          props: true,
          component: require(`@c/SoccerExpert/VcRank.vue`)
        },
        {
          path: "soccer_expert/results/:slug",
          name: "soccer_expert.results",
          props: true,
          component: require(`@c/SoccerExpert/ResultComponent.vue`)
        },
        {
          path: "soccer_groups/ranking/:id",
          name: "soccer_groups.ranking",
          props: true,
          component: require(`@c/SoccerGroup/VcRanking.vue`)
        },
        {
          path: "lotteries",
          name: "lotteries.index",
          component: require(`@c/Lottery/IndexComponent.vue`)
        },
        {
          path: "lotteries/results/:slug",
          name: "lotteries.results",
          props: true,
          component: require(`@c/Lottery/Result/VcIndex.vue`)
        },
        {
          path: "lotteries/play/:slug",
          name: "lotteries.play",
          props: true,
          component: require(`@c/Lottery/ShowComponent.vue`)
        },
        {
          path: "cart",
          name: "cart.index",
          props: true,
          //meta: { requiresAuth: true },
          component: require(`@c/Cart/IndexComponent.vue`)
        },
        {
          path: "balances",
          name: "balances.index",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Balance/IndexComponent.vue`)
        },
        {
          path: "balances/withdraw",
          name: "balances.withdraw",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Balance/VcWithdraw.vue`)
        },
        {
          path: "balances/deposit",
          name: "balances.deposit",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Balance/DepositComponent.vue`)
        },
        {
          path: "balances/withdrawal",
          name: "balances.withdrawal",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Balance/VcWithdrawal.vue`)
        },
        {
          path: "terms",
          name: "terms",
          props: true,
          component: require(`@c/VcTerms`)
        },
        {
          path: "ask",
          name: "ask",
          props: true,
          component: require(`@c/VcAsk`)
        },
        {
          path: "orders",
          name: "orders.index",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Order/IndexComponent.vue`)
        },
        {
          path: "orders/finish",
          name: "orders.finish",
          props: true,
          meta: { requiresAuth: true },
          component: require(`@c/Order/FinishComponent.vue`)
        },
        {
          path: "leagues/:slug",
          name: "leagues.show",
          props: true,
          component: require(`@c/League/VcShow.vue`)
        },
        {
          path: "cartoleando",
          name: "cartoleando.index",
          component: require(`@c/Cartoleando/VcIndex.vue`)
        },
        {
          path: "cartoleando/play/:slug",
          name: "cartoleando.play",
          props: true,
          component: require(`@c/Cartoleando/VcPlay.vue`)
        },
        {
          path: "cartoleando/:slug/leagues",
          name: "cartoleando.leagues",
          props: true,
          component: require("@c/Cartoleando/VcLeague.vue")
        }
      ]
    }
  ],
  linkExactActiveClass: "active",
  mode: "history"
};
