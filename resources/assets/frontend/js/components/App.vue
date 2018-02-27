<template>
	<main role="main">
		<header-component></header-component>
		<section class="content">
			<router-view></router-view>
			<hr>
			<div class="container">
				<div class="row">
					<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-01">
						<h1 class="text-center">Banner 01</h1>
					</div>
				</div>
			</div>
			<hr>
			<div class="container">
				<div class="row">
					<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-02">
						<h1 class="text-center">Banner 02</h1>
					</div>
				</div>
			</div>

			<hr>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter" id="banner-03">
						<h1 class="text-center">Banner 03</h1>
					</div>
				</div>
			</div>

			<hr>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
						<div id="how-to-play">
							<h1 class="text-center">Como jogar</h1>
						</div>
					</div>
				</div>
				<div class="row" style="background-image: url(//www.lottoland.com/cms/5554aadbe4b06bf49b4e071e/br_homepage_step-icons2.jpg); height: 300px; background-size: 100% auto; background-repeat: no-repeat; padding: 200px 0 0 130px;">
					<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
						<h5><strong>1. Escolha seus números</strong></h5>
						<h5>Clique sobre seus números da sorte e confirme!</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
						<h5><strong>1. Escolha seus números</strong></h5>
						<h5>Clique sobre seus números da sorte e confirme!</h5>
					</div>
					<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
						<h5><strong>1. Escolha seus números</strong></h5>
						<h5>Clique sobre seus números da sorte e confirme!</h5>
					</div>
				</div>
				
			</div>
			<hr>
			<div class="container">
				<div class="row">
					<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="explications">
						<h1 class="text-center">Explicações</h1>
					</div>
				</div>
			</div>
		</section>
		<footer-component></footer-component>
	</main>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import FooterComponent from './FooterComponent'
	import router from '../router'
	export default {
		data: function() {
			return {

			}
		},
		methods: {

		},
		created: function() {
			router.beforeEach((to, from, next) => {
			    if(to.meta.requiresAuth == true){
		            next()
			    }
		        next();
			});

			router.afterEach((to, from) => {
			    var height = $('main').prop('scrollHeight');
			    $('html, body').animate({
			        scrollTop: 0
			    },  300);
			});
		},
		mounted: function() {
			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent,
			FooterComponent
		}
	}
</script>

<style>
	body {
		padding-top: 10rem;
		min-height: 75rem;
		background-color: #fff
	}
	main {
		
	}
	#banner-01 {
		background-color: #ccc;
		width: 100%;
		height: 480px
	}
	#banner-02 {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
	#banner-03 {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
	#explications {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
	.vcenter {
		display: flex;
	    align-items: center;
	}

	.page-header {
		color: #000;
	    padding-bottom: 10px;
	    margin: 44px 0 22px;
	    border-bottom: 1px solid #eeeeee;
	}
</style>