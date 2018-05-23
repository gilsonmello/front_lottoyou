<template>
	<load-component v-if="loading.component == true"></load-component>
	<div v-else>
		<slider-component></slider-component>
		<br>
		<carousel-component></carousel-component>


		<br>
		<div class="container">
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'soccer_expert.show', params: {id: 3} }">
					<img style="width: 100%; " class="img-fluid" src="/img/new1/Ban-CUSTOM_BG.png">
				</router-link>
			</div>			
		</div>

		<br>
		<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
				<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'scratch_cards.index' }">
					<img style="width: 100%; " class="img-fluid" src="/img/new1/RASPADINHAS.jpg">
				</router-link>
			</div>
		</div>
		
		<br>
		<div class="container">
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'soccer_expert.index' }">
					<img style="width: 100%; " class="img-fluid" src="/img/new1/Soccer_Exp_S_TX.jpg">
				</router-link>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
				<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'lotteries.show', params: {id: 3} }">
					<img style="width: 100%; " class="img-fluid" src="/img/new1/easy_loteria_S_TX.jpg">
				</router-link>
			</div>
		</div>
		
		<!-- 
		<br>
		<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
				<h1 class="text-center">Banner 03<br>960 x 200px</h1> 
				<img style="width: 100%; " class="img-fluid" src="/img/golden_goal.jpg">
			</div>
		</div>
		-->

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
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div id="how-to-play">
					<h1 class="text-center">Como jogar na Nossa Loteria - Easy Money</h1>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5><strong>1. Escolha seus números</strong></h5>
					<h6>Escolha 5 números no universo de 35 números</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5><strong>2. Escolha a data do Sorteio</strong></h5>
					<h6>Os sorteios ocorrem de segunda a sábado</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5><strong>3. Confirme seu bilhete</strong></h5>
					<h6>Escolha como deseja pagar seu jogo com segurança</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-6 no-padding">
						<img src="/img/icon_11.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-6 no-padding">
						<img src="/img/icon_22.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-6 no-padding">
						<img src="/img/icon_33.png" class="img-fluid">
					</div>
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


			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_soccer.jpg">
			</div>
			<br>
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_piratas.jpg">
			</div>
			<br>

		
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_easy.jpg">
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