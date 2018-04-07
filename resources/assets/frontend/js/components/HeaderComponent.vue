<template>
	<div class="header fixed-top bg-white">
		<div class="container-fluid">
			<nav class="navbar navbar-toggleable-md navbar-light bg-inverse" style="padding: 0;">
  				<div class="navbar-brand">
  					<ul class="vcenter" style="justify-content: center;">
  						<li>
  							<router-link :to="{ name: 'home' }">
  								<img class="img-fluid" style="height: 75px; width: 176px;" src="/imgs/logo.png">
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
			  	<div class="col-lg-8 col-md-8 col-sm-12 col-12 no-padding">
			  		<div class="row">
			  			<div class="col-lg-12 vcenter-end">
			  				<ul class="header-items text-center">
					  			<li class="item-register-login" v-if="!auth">
					  				<router-link :to="{ name: 'login' }" class="pull-left" style="width: 100%;">
					  					<div class="pull-left">
											<span style="font-size: 14px">{{ trans('strings.login') }}</span>
										</div>
									</router-link>
					  			</li>
					  			<li class="item-register-login" v-if="!auth">
					  				<router-link :to="{ name: 'users.register' }" class="pull-left" style="width: 100%;">
					  					<div class="pull-right">
											<span style="font-size: 14px">{{ trans('strings.register') }}</span>
										</div>
									</router-link>
					  			</li>
					  			<li class="item-balance" v-if="auth">
					  				<router-link :to="{ name: 'balances.deposit' }" class="pull-left" style="width: 100%;">
						  				<div class="pull-left">
						  					<i class="fa fa-credit-card-alt" style="font-size: 27px;"></i>
						  				</div>
						  				<div class="pull-right">
						  					<div class="row">
						  						<div class="col-lg-12 no-padding">
						  							<span class="balance-amount">R$ 20,00</span>
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
					  			<li class="item-account" v-if="auth">
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
		<div class="container-fluid bg-lottoyou">
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

		},
		created: function() {

		},
		mounted: function() {
			var time = setInterval(() => {
				var header = $('.header');
		    	$('body').css({
		    		'padding-top': header[0].clientHeight
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

	.item-cart .cart-left {
		/*float: left;
		padding: 2px 10px 2px 2px;
		margin-right: 21px;*/
		position: relative;
		color: #69a507 !important;
	}

	..cart-checkout-now {		
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
		padding: 10px 20px 10px 10px;
		margin-right: 10px;
		position: relative;
		list-style: none;
		display: inline-block;
	}

	ul {
		margin: 0;
		padding: 0;
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

	.header .logo{
		padding: 20px;
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
</style>