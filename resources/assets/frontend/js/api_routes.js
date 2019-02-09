export const protocol = "http://";
export const enviroment = "production";
export const domain = window.location.hostname;
export const domainCookies = "." + window.location.hostname;
export const host =
  process.env.NODE_ENV === "dev"
    ? window.location.hostname + (location.port ? ":" + location.port : "")
    : "." +
      window.location.hostname +
      (location.port ? ":" + location.port : "");
export const hostAPI =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (location.port ? ":" + location.port : "") +
  "/api";
const base =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (location.port ? ":" + location.port : "");

export const getHeaders = () => {
  let token = document.head.querySelector('meta[name="csrf-token"]');

  var access_token = JSON.parse(Cookies.get("access_token", { domain }));
  access_token = access_token != null ? access_token : null;

  //Token para refresh
  var refresh_token = JSON.parse(Cookies.get("refresh_token", { domain }));
  refresh_token = refresh_token != null ? refresh_token : "";

  //Se o usuário tá logado
  if (access_token) {
    return {
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: "Bearer " + access_token,
        "X-CSRF-TOKEN": token.content
      }
    };
  }

  //Se não está logado
  return {
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": token.content
    }
  };
};

export const routes = {
  base: base,
  quotation_dolar: hostAPI + "/quotation_dolar",
  historic_balances: {
    of_the_user: hostAPI + "/historic_balances/of_the_user"
  },
  balance: {
    agent_withdraw: hostAPI + "/balances/agent_withdraw",
    paypal_withdraw: hostAPI + "/balances/paypal_withdraw"
  },
  recaptcha: {
    check: hostAPI + "/recaptcha/check"
  },
  pagseguro: {
    payment: hostAPI + "/pagseguro/payment"
  },
  paypal: {
    payment: hostAPI + "/paypal/payment",
    feedback: hostAPI + "/paypal/feedback",
    cancel: hostAPI
  },
  contacts: {
    create: hostAPI + "/contacts",
    categories: hostAPI + "/contacts/categories"
  },
  auth: {
    /*login: hostAPI + '/oauth/token',
		user: hostAPI + '/api/user'*/
    login: "/oauth/token",
    user: "/api/user"
  },
  countries: {
    index: hostAPI + "/countries",
    find: hostAPI + "/find/{id}"
  },
  orders: {
    show: hostAPI + "/orders/{id}",
    items: hostAPI + "/orders/{id}/items",
    generate_order: hostAPI + "/orders/generate_order"
  },
  order_items: {
    index: hostAPI + "/order_items/{user_id}"
  },
  users: {
    check_token_password_recovery:
      hostAPI + "/users/check_token_password_recovery/{hash}",
    check_token_forgot_password:
      hostAPI + "/users/check_token_forgot_password/{hash}",
    password_recovery: hostAPI + "/users/password_recovery/{hash}",
    forgot_password: hostAPI + "/users/forgot_password",
    index: hostAPI + "/users",
    create: hostAPI + "/users",
    edit: hostAPI + "/{id}/user",
    logged: hostAPI + "/users/logged",
    logout: hostAPI + "/users/logout",
    exists: hostAPI + "/users/exists",
    update: hostAPI + "/users/",
    orders: hostAPI + "/users/{id}/orders",
    transactions: hostAPI + "/users/{id}/transactions",
    games: hostAPI + "/users/{id}/games",
    soccer_experts: hostAPI + "/users/{id}/soccer_experts",
    scratch_cards: hostAPI + "/users/{id}/scratch_cards",
    lotteries: hostAPI + "/users/{id}/lotteries",
    items: hostAPI + "/users/items",
    activate: hostAPI + "/users/activate/{hash}",
    check_token_activation: hostAPI + "/users/check_token_activation/{token}",
    create_from_facebook: hostAPI + "/users/create_from_facebook",
    disable: hostAPI + "/users/disable",
    add_team: hostAPI + "/users/add_team"
  },
  packages: {
    create: hostAPI + "/packages",
    index: hostAPI + "/packages",
    show: hostAPI + "/packages/{slug}",
    find: hostAPI + "/packages/find/{id}"
  },
  scratch_cards: {
    index: hostAPI + "/scratch_cards",
    jackpot_available: hostAPI + "/scratch_cards/{id}/jackpot_available"
  },
  scratch_card_themes: {
    index: hostAPI + "/scratch_card_themes",
    jackpot_available: hostAPI + "/scratch_card_themes/{id}/jackpot_available",
    demo: hostAPI + "/scratch_card_themes/{theme_id}/demo",
    scratch_card: hostAPI + "/scratch_card_themes/{theme_id}/scratch_card",
    show: hostAPI + "/scratch_card_themes/{theme_id}",
    play: hostAPI + "/scratch_card_themes/{theme_id}/play",
    change_scratch_card:
      hostAPI +
      "/scratch_card_themes/{scratch_card_id}/{theme_id}/change_scratch_card"
  },
  scratch_card_demo: {
    index: hostAPI + "/scratch_card_demo",
    find: hostAPI + "/scratch_card_demo/{id}"
  },
  soccer_experts: {
    index: hostAPI + "/soccer_experts",
    show: hostAPI + "/soccer_experts/{slug}",
    play: hostAPI + "/soccer_experts/play/{slug}",
    results: hostAPI + "/soccer_experts/results/{slug}",
    ranks: hostAPI + "/soccer_experts/ranks/{slug}",
    find: hostAPI + "/soccer_experts/find/{slug}"
  },
  soccer_categories: {
    index: hostAPI + "/soccer_categories",
    show: hostAPI + "/soccer_categories/{id}"
  },
  lotteries: {
    index: hostAPI + "/lotteries",
    show: hostAPI + "/lotteries/{slug}",
    play: hostAPI + "/lotteries/play/{slug}",
    results: hostAPI + "/lotteries/results/{slug}",
    find: hostAPI + "/lotteries/find/{slug}",
    awards: hostAPI + "/lotteries/awards/{id}",
    sweepstakes: hostAPI + "/lotteries/sweepstakes/{slug}",
    sweepstake: hostAPI + "/lotteries/sweepstake/{sweepstake_id}"
  },
  carts: {
    store: hostAPI + "/carts",
    index: hostAPI + "/carts",
    add_scratch_cards: hostAPI + "/carts/add_scratch_cards",
    add_soccer_experts: hostAPI + "/carts/add_soccer_experts",
    add_cartoleandos: hostAPI + "/carts/add_cartoleandos",
    add_lotteries: hostAPI + "/carts/add_lotteries",
    destroy: hostAPI + "/carts/{hash}",
    complete_purchase: hostAPI + "/carts/complete_purchase",
    validate: hostAPI + "/carts/validate",
    validate_soccer_expert_fast_payment:
      hostAPI + "/carts/validate_soccer_expert_fast_payment",
    complete_fast_payment_soccer_expert:
      hostAPI + "/carts/complete_fast_payment_soccer_expert",
    validate_lottery_fast_payment:
      hostAPI + "/carts/validate_lottery_fast_payment",
    validate_cartoleando_fast_payment:
      hostAPI + "/carts/validate_cartoleando_fast_payment",
    complete_fast_payment_lottery:
      hostAPI + "/carts/complete_fast_payment_lottery",
    complete_fast_payment_cartoleando:
      hostAPI + "/carts/complete_fast_payment_cartoleando"
  },
  soccer_tickets: {
    games: hostAPI + "/soccer_tickets/{ticket_id}/games"
  },
  soccer_rounds: {
    groups: hostAPI + "/soccer_rounds/{round_id}/groups"
  },
  soccer_groups: {
    ranking: hostAPI + "/soccer_groups/{id}/ranking",
    show: hostAPI + "/soccer_groups/{id}",
    find: hostAPI + "/soccer_groups/{id}/find"
  },
  leagues: {
    create: hostAPI + "/leagues",
    index: hostAPI + "/leagues",
    findBySlug: hostAPI + "/packages/findBySlug/{slug}",
    find: hostAPI + "/leagues/find/{id}",
    awards: hostAPI + "/leagues/awards/{slug}"
  },
  fantasy_game: {
    packages: hostAPI + "/"
  },
  league_packages: {
    index: hostAPI + "/league_packages",
    findBySlug: hostAPI + "/league_packages/findBySlug/{slug}",
    find_leagues_by_slug:
      hostAPI + "/league_packages/find_leagues_by_slug/{slug}"
  },
  leagues: {
    index: hostAPI + "/leagues",
    show: hostAPI + "/leagues/{slug}"
  },
  cartola: {
    find_team_by_slug: hostAPI + "/cartola/find_team_by_slug"
  },
  system: {
    settings: {
      index: hostAPI + "/system/settings"
    }
  }
};
