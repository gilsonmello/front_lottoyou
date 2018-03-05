<template>
	<div class="header fixed-top bg-white">
		<div class="container-fluid">
			<nav class="navbar navbar-toggleable-md navbar-light bg-inverse" style="padding: 0;">
  				<div class="navbar-brand">
  					<ul class="vcenter" style="justify-content: center;">
  						<li>
  							<router-link :to="{ name: 'home' }">
  								<img class="img-fluid" style="height: 80px;width: 220px;" src="/imgs/logo.png">
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
			  	<div class="navbar-right">
			  		<ul class="vcenter" style="justify-content: center;">
			  			<li class="item-register-login">
			  				<router-link :to="{ name: 'login' }">
								{{ trans('strings.login') }}
							</router-link>
			  			</li>
			  			<li class="item-register-login">
			  				<router-link :to="{ name: 'users.register' }">
								{{ trans('strings.register') }}
							</router-link>
			  			</li>
			  			<li class="item-cart">
			  				<div class="cart">
			  					<div class="cart-left">
			  						<div class="fa fa-shopping-cart" style="font-size: 30px;">
			  							<span class="cart-count">
			  								1
			  							</span>
			  						</div>
			  					</div>
			  					<div class="cart-right">
			  						<span class="cart-value">
			  							R$ 0,00
			  						</span>
			  						<span class="cart-checkout-now">
			  							Pagar agora
			  						</span>
			  					</div>
			  				</div>
			  			</li>
			  		</ul>
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
	export default {
		data: function() {
			return {

			}
		},
		methods: {
		},
		created: function() {

		},
		mounted: function() {
			
		},
		components: {
			NavGameComponent,
			SliderComponent
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

	.cart-left .cart-count {
		position: absolute;
		border-radius: 50%;
		top: -8px;
		right: 3px;
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

	.item-cart .cart-left {
		float: left;
		padding: 2px 10px 2px 2px;
		margin-right: 21px;
		position: relative;
		color: #69a507 !important;
	}

	.item-cart .cart-left .cart-checkout-now {
		
	}

	.item-cart .cart-right {
		float: right;
	}

	.item-cart .cart-right .cart-value {
		display: block;
		line-height: 18px;
	}

	.navbar-brand {
		padding: 0;
	}

	.navbar-brand ul {
		margin: 0;
		padding: 0
	}

	.navbar-brand ul li {
		padding: 10px;
		list-style: none;
	}

	.navbar-right ul {
		margin: 0;
		padding: 0
	}

	.navbar-right ul li {
		padding: 15px 15px 15px 0;
		margin-right: 10px;
		position: relative;
		list-style: none;
	}

	.navbar-right ul li:last-child {
		margin-right: 0;
	}

	.navbar-right ul .item-register-login:after {
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

	.navbar-right span, .navbar-right a {
		color: #69a507;
		font-weight: 700;
		font-size: 14px;
		cursor: pointer;
		text-decoration: none;
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