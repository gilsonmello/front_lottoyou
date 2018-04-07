<template>
	<load-component v-if="loading.component == true"></load-component>
	<div v-else>
		<slider-component></slider-component>
		<br>
		<carousel-component></carousel-component>

		<br>
		<div class="container">
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
					<!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
					<img style="width: 100%; " class="img-fluid" src="/img/banner_medio_soccer.jpg">
				</div>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
					<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
					<img style="width: 100%; " class="img-fluid" src="/img/banner_medio_raspadinhas.jpg">
				</div>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
					<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
					<img style="width: 100%; " class="img-fluid" src="/img/banner_medio_raspadinha.jpg">
				</div>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
					<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
					<img style="width: 100%; " class="img-fluid" src="/img/golden_goal.jpg">
				</div>
			</div>
		</div>

		<!-- <br>
		<div class="container">
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-01">
					<h1 class="text-center">Banner 01<br>960 x 481px</h1>
				</div>
			</div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-02">
					<h1 class="text-center">Banner 02<br>960 x 200px</h1>
				</div>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter" id="banner-03">
					<h1 class="text-center">Banner 03<br>960 x 200px</h1>
				</div>
			</div>
		</div> -->

		<br>
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
		<br>
		<div class="container">
			<!-- <div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="explications">
					<h1 class="text-center">Explicações<br>960 x 300px</h1>
				</div>
			</div> -->
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
					<img class="img-fluid" style="width: 100%; " src="/img/explic_easy.jpg">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
					<img class="img-fluid" style="width: 100%; " src="/img/explic_piratas.jpg">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
					<img class="img-fluid" style="width: 100%; " src="/img/explic_soccer.jpg">
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import LoadComponent from './Load'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				}
			}
		},
		beforeCreate: function() {
			
		},
		beforeMount: function() {
			this.loading.component = true
		},
		methods: {

		},

		created: function() {
			
		},
		mounted: function() {
			this.loading.component = false
			window.document.title = window.app.title;
		},
		components: {
			SliderComponent,
			CarouselComponent,
			LoadComponent
		}
	}
</script>

<style scoped>
	h1 {
		width: 100%;
	}
</style>