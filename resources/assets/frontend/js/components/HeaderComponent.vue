<template>
	<div class="header fixed-top bg-white">
		<div class="container container-fluid-header">
			<nav class="navbar navbar-toggleable-md navbar-light bg-inverse" style="padding: 0;">
				
  				<div class="col-lg-3 col-md-3 col-sm-12 col-12 no-padding">
					<ul class="vcenter header-brand">
  						<li style="padding: 0;">
  							<router-link :to="{ name: 'home' }">
  								<img class="img-fluid logo" style="height: 54px; width: 127px;" src="/imgs/logo.png">
  							</router-link>
  						</li>
  						<!-- <li>
  							<img class="img-fluid" width="60" src="//www.lottoland.com/cms/5a8d7f7a0eb3587e04426c35/multi_60px.png">
  						</li>
  						<li>
  							<span>Novidade: Loteria Multi Keno</span>
							<span>Ganhe até R$ 24 milhões</span>
							<span>Tente aqui a sua sorte!</span>
  						</li> -->
  					</ul>
  				</div>
				
			  	<div :class="col()">
			  		<div class="row">
			  			<div class="col-lg-12 vcenter-end header-container" style="justify-content: right">
			  				<ul class="header-items" style="width: 100%">
					  			<!-- <li class="item-register-login" v-if="!auth">
					  				<router-link :to="{ name: 'login' }" class="pull-left" style="width: 100%;">
					  					<div class="pull-left">
											<span style="font-size: 14px">{{ trans('strings.login') }}</span>
										</div>
									</router-link>
					  			</li> -->
					  			<li class="item-register-login" v-if="!auth">
					  				<a href="#" @click.prevent="login" class="pull-left" style="width: 100%;">
					  					<div class="pull-left">
											<span style="font-size: 14px">{{ trans('strings.login') }}</span>
										</div>
									</a>
					  			</li>
					  			<li class="item-register-login" v-if="!auth">
					  				<router-link :to="{ name: 'users.register' }" class="pull-left" style="width: 100%;">
					  					<div class="pull-right">
											<span style="font-size: 14px">{{ trans('strings.register') }}</span>
										</div>
									</router-link>
					  			</li>
					  			<li class="item-balance" v-if="auth && auth.balance">
					  				<router-link :to="{ name: 'balances.deposit' }" class="pull-left" style="width: 100%;">
						  				<div class="pull-left">
						  					<i class="fa fa-credit-card-alt" style="font-size: 27px;"></i>
						  				</div>
						  				<div class="pull-right">
						  					<div class="row">
						  						<div class="col-lg-12 no-padding">
						  							<span class="balance-amount">$ {{ auth.balance.value }}</span>
						  						</div>
						  					</div>
						  					<div class="row">
						  						<div class="col-lg-12 no-padding">
						  							<span class="balance-deposit">Depositar créditos</span>
						  						</div>
						  					</div>
						  				</div>
					  				</router-link>
					  			</li>
					  			<li class="item-account" data-toggle="tooltip" v-if="auth" @mouseover="openTooltip" @mouseleave="closeTooltip">
					  				<router-link :to="{ name: 'users.account' }" class="pull-left" style="width: 100%;">
						  				<div class="pull-left vcenter">
						  					<i class="fa fa-user-circle" style="font-size: 27px;"></i>
						  				</div>
						  				<div class="pull-right">
						  					<div class="row">
						  						<div class="col-lg-12 no-padding">
						  							<span class="user-name">
						  								{{ auth.name }} {{ auth.last_name }}
						  							</span>
						  						</div>
						  					</div>
						  					<div class="row">
						  						<div class="col-lg-12 no-padding">
						  							<span class="account">{{ trans('strings.account') }}</span>
						  						</div>
						  					</div>
						  				</div>
						  			</router-link>
						  			<div class="tooltip-item-account">
						  				<div class="tooltip-item-account-header">
						  					<div class="row vcenter">
						  						<div class="col-lg-8">
						  							<span class="title">Minha Lottoyou</span>
						  						</div>
						  						<div class="col-lg-4">
						  							<span class="balance">Crédito: $ 0.00</span>
						  						</div>
						  					</div>
						  				</div>
						  				<div class="tooltip-item-account-content">
						  					<ul class="account">
						  						<li class="account-item">
						  							<div class="row vcenter">
						  								<div class="col-lg-2">
						  									<i class="fa fa-user-circle" style="font-size: 27px; color: initial;"></i>
						  								</div>
						  								<div class="col-lg-10">
						  									<router-link :to="{ name: 'users.account' }" class="">
							  									{{ trans('strings.account') }}
							  								</router-link>
						  								</div>
						  							</div>
						  						</li>
						  						<li class="account-item">
						  							<div class="row vcenter">
						  								<div class="col-lg-2">
						  									<i class="fa fa-gamepad" style="font-size: 27px; color: initial;"></i>
						  								</div>
						  								<div class="col-lg-10">
						  									<router-link :to="{ name: 'users.games' }" class="">
							  									{{ trans('strings.games') }}
							  								</router-link>
						  								</div>
						  							</div>
						  						</li>
						  						<li class="account-item">
						  							<div class="row vcenter">
						  								<div class="col-lg-2">
						  									<i class="fa fa fa-credit-card-alt" style="font-size: 27px; color: initial;"></i>
						  								</div>
						  								<div class="col-lg-10">
						  									<router-link :to="{ name: 'users.transactions' }" class="">
							  									{{ trans('strings.transactions') }}
							  								</router-link>
						  								</div>
						  							</div>
						  						</li>
						  						<li class="account-item">
						  							<div class="row vcenter">
						  								<div class="col-lg-12">
						  									<span class="answer">Não é {{ auth.name }} ?</span>
						  									<a href="#" @click.prevent="logout" class="">
						  										{{ trans('strings.logout') }}
						  									</a>
						  								</div>
						  							</div>
						  						</li>
						  					</ul>
						  				</div>
						  				<div class="tooltip-item-account-footer">
						  					
						  				</div>
						  			</div>
						  		</li>
					  			<li class="item-cart">
					  				<router-link :to="{ name: 'cart.index' }" class="cart pull-left" style="width: 100%;">
				  						<div class="vcenter">
					  						<div class="cart-left pull-left" style="justify-content: center">
						  						<i class="fa fa-shopping-cart" style="font-size: 27px;">
						  							<span class="cart-count">
						  								{{ purchase.quantity }}
						  							</span>
						  						</i>
						  					</div>
						  					<div class="cart-right pull-right">
						  						<span class="cart-value">
						  							$ {{ purchase.total.format(2, true) }}
						  						</span>
						  						<span class="cart-checkout-now">
						  							{{ trans('strings.pay_now') }}
						  						</span>
						  					</div>	
					  					</div>				  					
						  			</router-link>
					  			</li>
					  		</ul>
			  			</div>
			  		</div>
			  	</div>
			</nav>
		</div>	
		<div class="container-fluid bg-lottoyou" style="padding: 0;">
			<nav-game-component></nav-game-component>
		</div>
	</div>
</template>

<script>
	import NavGameComponent from './NavGameComponent'
	import SliderComponent from './SliderComponent'
	import {mapState, mapGetters} from 'vuex'
	export default {
		data: function() {
			return {
				user: JSON.parse(window.localStorage.getItem('authUser'))
			}
		},
		methods: {
			col() {
				if(this.user != null) {
					return 'col-lg-9 col-md-9 col-sm-12 col-12 no-padding'
				}
				return 'col-lg-9 col-md-9 col-sm-12 col-12 no-padding'
			},
			openTooltip() {
				$('.tooltip-item-account')
					.addClass('open');
			},
			logout() {
				
				if(confirm('Deseja realmente deslogar?')) { 
					this.$store.dispatch('clearAuthUser');
					window.localStorage.removeItem('authUser');
					window.localStorage.removeItem('access_token');
					window.localStorage.removeItem('refresh_token');

					this.$router.push({
						name: 'home'
					});
				}
			},
			login() {
				$('.modal-login').modal('toggle');
			},
			closeTooltip() {
				$('.tooltip-item-account')
					.removeClass('open');
			}
		},
		created: function() {

		},
		mounted: function() {
			var time = setInterval(() => {
				var header = $('.header');
		    	$('body').css({
		    		'padding-top': header[0].clientHeight - 1
		    	});
		    	
		    	if(header.length > 0){
					clearInterval(time);
				}
	    	});	    	
		},
		components: {
			NavGameComponent,
			SliderComponent
		},
		computed: {
            ...mapState({
                User: state => state.User
            }),
            ...mapGetters([
                'auth', 'purchase'
            ])
        },
        watch: {
        	'User.authUser': function(newValue, oldValue) {
                if(newValue) {
                    this.user = newValue;
                }
            }
        }
	}
</script>

<style scoped>

	nav {
		
	}

	li span {
		font-size: 12px;
		display: block;
	}

	.cart {
		display: inline-block;
		position: relative;
	}

	.cart a {
		display: inline-flex;
		position: relative;
		width: 100%;
		height: auto;
	}

	.cart-left .cart-count {
		position: absolute;
		border-radius: 50%;
		top: -10px;
		right: 10px;
		width: 19px;
		height: 19px;
		text-align: center;
		background-color: #d9deda;
		font-weight: 900;
		color: white;
		font-size: 12px;
		line-height: 20px;
		transition: background-color .125s ease-out;
	}

	.user-name {
		font-weight: 500;
	    color: #012406;
	    text-overflow: ellipsis;
	    overflow: hidden;
	    white-space: nowrap;
	    display: block;
	    font-size: 14px;
	    line-height: 18px
	}

	.account {		
		font-weight: 700;
		color: #69a507;
	    font-size: 14px;
	    line-height: 18px;
	}

	.balance-amount {
	    font-weight: 500;
	    color: #012406;
	    text-overflow: ellipsis;
	    overflow: hidden;
	    white-space: nowrap;
	    display: block;
	    font-size: 14px;
	    line-height: 18px
	}

	.balance-deposit {
		font-weight: 700;
		color: #69a507;
	    font-size: 14px;
	    line-height: 18px
	}

	.item-cart {
		padding-right: 0;
	}

	.item-cart .cart-left {
		/*float: left;
		padding: 2px 10px 2px 2px;
		margin-right: 21px;*/
		position: relative;
		color: #69a507 !important;
	}

	.cart-checkout-now {		
		font-weight: 700;
		color: #69a507;
	    font-size: 14px;
	    line-height: 18px
	}

	.item-cart .cart-right {
		float: right;
	}

	.cart-value {
		display: block;
		line-height: 18px;
		color: #9aa89c;
		font-size: 14px;
	}

	.navbar-brand {
		padding: 0;
	}

	.navbar-brand ul {
		margin: 0;
		padding: 0
	}

	ul li {
		padding: 20px 20px 10px 10px;
		margin-right: 10px;
		position: relative;
		list-style: none;
		display: inline-block;
	}

	ul {
		margin: 0;
		padding: 0
	}

	ul li:last-child {
		margin-right: 0;
	}

	
	.navbar-right ul li {
		
	}

	ul .item-account:after {
		content: "";
	    background-color: #d9deda;
	    -webkit-transform: translateY(-50%);
	    transform: translateY(-50%);
	    height: 21px;
	    width: 1px;
	    position: absolute;
	    right: 0;
    	top: 50%;
	}

	.row {
		margin: 0;
	}

	ul .item-balance:after {
		content: "";
	    background-color: #d9deda;
	    -webkit-transform: translateY(-50%);
	    transform: translateY(-50%);
	    height: 21px;
	    width: 1px;
	    position: absolute;
	    right: 0;
    	top: 50%;
	}

	ul .item-register-login:after {
		content: "";
	    background-color: #d9deda;
	    -webkit-transform: translateY(-50%);
	    transform: translateY(-50%);
	    height: 21px;
	    width: 1px;
	    position: absolute;
	    right: 0;
    	top: 50%;
	}

	span, a {
		color: #69a507;
		font-weight: 700;
		font-size: 14px;
		cursor: pointer;
		text-decoration: none;
	    text-align: initial;
	}

	i {
		margin-right: 21px;
	}

	.bg-white {
		background-color: white;
	}
	
	.header {
		width: 100%;
	}

	.header .container {
		
	}

	.bg-lottoyou {
		background-color: #64a407;
		background-image: linear-gradient(90deg,#a4cc25,#64a407);
	}

	.navigation-header header{

	}

	.no-padding-left {
		padding-left: 0
	}

	.no-padding-right {
		padding-right: 0;
	}

	.no-padding-bottom {
		padding-bottom: 0;
	}

	.no-padding-top {
		padding-top: 0;
	}

	.header-items {
		text-align: right;
	}

	@media (max-width: 992px) {
		.header-container, .container-fluid-header, .header-container .header-items{
			padding: 0 !important
		}
	}

	@media (max-width: 767px) {
		.header-container-logo {
			justify-content: center !important;
		}

		.header-brand {
			justify-content: center;
		}
	}

	@media (max-width: 576px) {
		.header-items {
			text-align: center;
		}

		ul li {
		    padding-bottom: 0 !important;
    		padding-top: 5px !important;
		}
	}

	.tooltip-item-account {
		display: none;
	}
	.item-account .open:before {
		content: "";
	    position: absolute;
	    height: 9px;
	    z-index: 102;
	    width: 9px;
	    border-top: 1px solid #d9deda;
	    border-right: 1px solid #d9deda;
	    -webkit-transform: rotate(-44deg);
	    transform: rotate(-44deg);
	    background: #fff;
	    top: -5px;
	    right: 66px;
	}

	.item-account .open {
	    right: 0;	
	    bottom: -217px;
    	background: white;
    	width: 363px;
    	display: block !important;
    	z-index: 9999;
    	position: absolute;
        border: 1px solid #ccc;
	    border-radius: 4px;
	    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.6);
	    box-shadow: 0 1px 3px 0 rgba(0,0,0,.6);
	    /* background: none repeat scroll 0 0 #fff; */
	    font-weight: 400;
	}

	.tooltip-item-account-header {
	    padding: 5px;
    	border-bottom: 1px #ccc solid;
	}

	.tooltip-item-account-header .title {
		font-weight: 900;
	    font-size: 17px;
	    color: #012406;
	    text-align: left;
	}

	.tooltip-item-account-header .balance {
		font-weight: 200;
	    font-size: 12px;
	    color: #012406;
	    text-align: right;
	    line-height: 18px;
	}

	.tooltip-item-account .account {
		text-align: left;
	}

	.tooltip-item-account .account .account-item {
		display: block;
		border-bottom: 1px #ccc solid;
	    padding: 10px 10px 10px 10px;
	    margin-right: 0;
	}

	.tooltip-item-account .account .account-item .answer {
		display: initial;
		color: initial;
	}

	.tooltip-item-account .account .account-item:last-child {
		border: none;
	}
	
</style>