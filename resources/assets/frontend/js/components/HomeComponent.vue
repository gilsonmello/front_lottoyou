<template>
	<div>
		<slider-component></slider-component>
		<br>
		<carousel-component></carousel-component>
		<br>
		<div class="container">
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-01">
					<h1 class="text-center">Banner 01</h1>
				</div>
			</div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="banner-02">
					<h1 class="text-center">Banner 02</h1>
				</div>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter" id="banner-03">
					<h1 class="text-center">Banner 03</h1>
				</div>
			</div>
		</div>

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
			<div class="row">
				<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12" id="explications">
					<h1 class="text-center">Explicações</h1>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
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
			SliderComponent,
			CarouselComponent
		}
	}
</script>

<style>
	
</style>