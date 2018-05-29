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
			 	<router-link :to="{ name: 'create_your_league' }">
					<div class="banner-custom" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/banner_custom.png">	

						<div class="content-left">
							<h2 class="text-center">
								CRIE AGORA MESMO<br>
								A SUA PRÓPIA LIGA!							
							</h2>
							<br>
							<h2 class="text-center">
								VOCÊ JÁ COMEÇA
							</h2>
							<h1 class="text-center">
								<strong>GANHANDO 5%</strong>
							</h1>
							<h2 class="text-center">
								DE TODAS AS APOSTAS
							</h2>
						</div>

						<div class="content-right">
							<h1>
								No <strong>Soccer Expert</strong> da <strong>Lottoyou</strong><br>
								você pode criar a sua própia liga<br>
								com <strong>qualquer time do mundo.</strong><br>
								Convide seus amigos e descubra<br>
								quem é o "expert" do futebol.
							</h1>
							<br>
							<h4>
								<em>É momento de começar a desfrutar deste<br>
								mundo de infinitas possibilidades com Lottoyou!</em>
							</h4>
						</div>
					</div>
				</router-link>
			</div>			
		</div>

		<br>
		<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
				<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'scratch_cards.index' }">
					<div class="banner-golden-goal" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/new1/RASPADINHAS.jpg">	
						<div class="content-left">
							<h1>
								RASPE E GANHE !!!
							</h1>
						</div>
					</div>
				</router-link>
			</div>
		</div>
		
		<br>
		<div class="container">
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'soccer_expert.index' }">
					<div class="banner-soccer-expert" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/new1/Soccer_Exp_S_TX.jpg">	
						<div class="content-left">
							<h2>
								AQUI SEU PALPITE<br>
								VALE MAIS QUE UM GOL
							</h2>
						</div>
					</div>
				</router-link>
			</div>
		</div>

		<br>
		<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
				<!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
				<router-link :to="{ name: 'lotteries.show', params: {id: 3} }">
					<div class="banner-easy-loteria" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/new1/easy_loteria_S_TX.jpg">
						<div class="content-left">
							<h2>
								NUNCA FOI TÃO FÁCIL GANHAR
							</h2>
						</div>
					</div>
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
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_11.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_22.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_33.png" class="img-fluid">
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5 class="text-center"><strong>1. Escolha seus números</strong></h5>
					<h6 class="text-center">Escolha 5 números no universo de 35 números</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5 class="text-center"><strong>2. Escolha a data do Sorteio</strong></h5>
					<h6 class="text-center">Os sorteios ocorrem de segunda a sábado</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
					<h5 class="text-center"><strong>3. Confirme seu bilhete</strong></h5>
					<h6 class="text-center">Escolha como deseja pagar seu jogo com segurança</h6>
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

				<div class="banner-explic-soccer" style="position: relative">
					<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_soccer.jpg">
					<div class="content-left">
						<h3>
							Soccer Expert
						</h3>
						<br>
						<h4>
							O Soccer Expert (SE) é um produto do Lottoyou.bet<br> 
							onde se organizam ligas, no qualcada participante realizará uma<br> 
							aposta indicando o resultado de um conjunto de jogos de futebol dos<br> 
							principais campeonatos do mundo. Escolha uma das três <br> 
							modalidades: Word; Special e Custom e junte-se a nós neste mundo<br> do futebol!
						</h4>
					</div>
				</div>			
			</div>
			<br>
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_piratas.jpg">
			</div>
			<br>

		
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">

				<div class="banner-explic-easy-loteria" style="position: relative">
					<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_easy.jpg">
					<div class="content-left">
						<h3>
							Easy Money - A loteria da Lottoyou
						</h3>
						<br>
						<h4>
							Quem nunca sonhou em transformar 1 dólar em $20,000 dólares?<br>
							Provavelmente você já tem os seus planos e aqui na Easy Money<br>
							todos os dias você pode concretizá-los. Para ganhar o prêmio máximo<br>
							basta acertar apenas 5 números em um universo de 35 números!!! Na<br>
							Easy Money vôcê também ganha acertando 4, 3, 2 ou até mesmo 1<br>
							número.
						</h4>
						<br>
						<h4>
							Easy Money, nunca foi tão fácil ganhar
						</h4>
					</div>
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

	.banner-explic-soccer .content-left {
	    left: 30%;
	    position: absolute;
	    transform: translate(13%, 10%);
	    color: #000;
	    top: 0;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-explic-easy-loteria .content-left {
	    left: 30%;
	    position: absolute;
	    transform: translate(13%, 10%);
	    color: #000;
	    top: 0;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-easy-loteria .content-left {
	    left: 30%;
	    position: absolute;
	    transform: translate(0,8%);
	    color: #000;
	    bottom: 0;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-soccer-expert .content-left {
	    left: 30%;
	    top: 35%;
	    position: absolute;
	    -webkit-transform: translate(0, -50%);
	    transform: translate(0, -50%);
	    color: #003874;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-golden-goal .content-left {
		left: 0;
	    top: 50%;
	    margin-left: 8px;
	    position: absolute;
	    transform: translate(0, -50%);
	    color: #003874;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-custom .content-left {
	    position: absolute;
	    bottom: 1.2%;
    	left: 14%;
	    color: #003874;
	}

	.banner-custom .content-left h4, .banner-custom .content-left h3, .banner-custom .content-left h2, .banner-custom .content-left h1 {
		margin-bottom: 0;
		font-family: 'OstrichSans-Heavy';
	    line-height: 1;
	}

	.banner-custom .content-right {
	    position: absolute;
	    top: 15%;
	    color: #000;
	    right: 6%;
	}
</style>