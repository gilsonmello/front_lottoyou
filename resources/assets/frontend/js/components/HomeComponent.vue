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
			 	<router-link :to="{ name: 'cartoleando.index' }">
					<div class="banner-custom" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/banner_cartoleando.png">	

						<div class="content-left">
							<!-- <h2 class="text-center">
								CRIE AGORA MESMO<br>
								A SUA PRÓPRIA LIGA!
							</h2>
							<h2 class="text-center" style="margin-bottom: 6px;">
								VOCÊ JÁ COMEÇA
							</h2>
							<h1 class="text-center">
								<strong>GANHANDO 5%</strong>
							</h1>
							<h2 class="text-center">
								DE TODAS AS APOSTAS
							</h2> -->
						</div>

						<div class="content-right">
							<!-- <h1>
								No <strong>Soccer Expert</strong> da <strong>Lottoyou</strong><br>
								você pode criar a sua própria liga<br>
								com <strong>qualquer time do mundo.</strong><br>
								Convide seus amigos e descubra<br>
								quem é o "expert" do futebol.
							</h1>
							<br>
							<h4>
								<em>É momento de começar a desfrutar deste<br>
								mundo de infinitas possibilidades com Lottoyou!</em>
							</h4> -->
						</div>
					</div>
				</router-link>
			</div>			
		</div>

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
								A SUA PRÓPRIA LIGA!
							</h2>
							<h2 class="text-center" style="margin-bottom: 6px;">
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
								você pode criar a sua própria liga<br>
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
				<router-link :to="{ name: 'lotteries.play', params: {slug: 'easy-money'} }">
					<div class="banner-easy-loteria" style="position: relative">
						<img style="width: 100%; " class="img-fluid" src="/img/easy_money.jpeg">
						<!-- <div class="content-left">
							<h5 class="text-center">
								<em><strong>NUNCA FOI TÃO FÁCIL GANHAR</strong></em>
							</h5>
						</div> -->
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
						<img style="width: 100%; " class="img-fluid" src="/img/banner-soccer-exper.png">	
						<!-- <div class="content-left">
							<h2>
								AQUI SEU PALPITE<br>
								VALE MAIS QUE UM GOL
							</h2>
						</div> -->
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
						<img style="width: 100%; " class="img-fluid" src="/img/banner_raspadinha.png">	
						<!-- <div class="content-left">
							<h2 style="font-weight: bold; text-shadow: 0 1px #808d9300, -1px 0 #cdd2d5, -1px 2px #808d9300, -2px 1px #cdd2d500, -2px 3px #808d93;">
								RASPE E GANHE !!!
							</h2>
						</div> -->
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
				<div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_11.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_22.png" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
					<div class="col-lg-4 no-padding">
						<img src="/img/icon_33.png" class="img-fluid">
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-4 col-sm-4">
					<h5 class="text-center"><strong>1. Escolha seus números</strong></h5>
					<h6 class="text-center">Escolha 5 números no universo de 35 números</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-4 col-sm-4">
					<h5 class="text-center"><strong>2. Escolha a data do Sorteio</strong></h5>
					<h6 class="text-center">Os sorteios ocorrem de segunda a sábado</h6>
				</div>
				<div class="col-lg-4 col-md-4 col-4 col-sm-4">
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
					<img class="img-fluid" style="width: 100%; " src="/img/banner_explicativo_cartoleando.png">
				</div>			
			</div>
			<br>


			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">

				<div class="banner-explic-soccer" style="position: relative">
					<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_soccer.jpg">
					<div class="content-left">
						<h3 style="font-weight: bold; font-style: italic;">
							Soccer Expert
						</h3>
						<h4 style="text-align: justify; line-height: 1.5;">
							<p style="margin-bottom: 6px;">O Soccer Expert (SE) é um produto do Lottoyou.bet
							onde se organizam ligas, no qual cada participante realizará uma	aposta indicando o resultado de um conjunto de jogos de futebol dos principais campeonatos do mundo.
							</p>
							<p style="margin-bottom: 6px;">
								Escolha uma das três modalidades: Word; Special e Custom e junte-se a nós neste mundo do futebol!
							</p>
						</h4>
					</div>
				</div>			
			</div>
			<br>
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<div class="banner-explic-ras" style="position: relative">
					<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_piratas.jpg">
					<div class="content-left">
						<h3 style="font-weight: bold; font-style: italic;">
							{{ trans('strings.scratch_cards') }}
						</h3>
						<h4 style="text-align: justify; line-height: 1.2;">
							<p>
								Nas raspadinhas Lottoyou você se diverte e ainda ganha dinheiro.<br>
								Conheça esse universo de possibilidades onde poucos centavos podem render milhares de dólares!!!<br>
								O Pirates Treasure e o Golden Goal lhe reservam grandes prêmios.
							</p>
							<p><strong>A cada 3 bilhetes, um é premiado.</strong></p>
							<p>Aqui é mais fácil! </p>
						</h4>
					</div>
				</div>

			</div>
			<br>

		
			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">

				<div class="banner-explic-easy-loteria" style="position: relative">
					<img class="img-fluid" style="width: 100%; " src="/img/new1/explic_easy.jpg">
					<div class="content-left">
						<h3 style="font-weight: bold; font-style: italic;">
							Easy Money - A loteria da Lottoyou
						</h3>
						
						<h4 style="text-align: justify; line-height: 1.2;">
							<p>Quem nunca sonhou em transformar 1 real em R$80,00 reais?<br>
							Provavelmente você já tem os seus planos e aqui na Easy Money todos os dias você pode concretizá-los. Para ganhar o prêmio máximo basta acertar apenas 5 números em um universo de 35 números!!!
							Na Easy Money vôcê também ganha acertando 4, 3, 2 ou até mesmo 1 número.</p>
							<!-- <p>Easy Money, <em><strong>nunca foi tão fácil ganhar</strong></em></p> -->
							<p>Easy Money, nunca foi tão fácil ganhar</p>
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
		metaInfo () {
			return {
				title: 'Lottoyou',
				meta: []
		    }
		},
		data: function() {
			return {
				loading: {
					component: true
				}
			}
		},
		beforeCreate () {
			
		},
		beforeMount () {
			this.loading.component = true
		},
		methods: {

		},
		created () {
			
		},
		mounted () {
			this.loading.component = false;
            setTimeout(() => {
                window.prerenderReady = true;
            }, 5000);
		},
		components: {
			SliderComponent,
			CarouselComponent,
			LoadComponent
		}
	}
</script>

<style scoped>
	
	@media (min-width: 992px) and (max-width: 1200px) {
		.banner-custom .content-left {
		    
		}

		
		.banner-custom .content-left {
		    
		}

		.banner-custom .content-left h2 {
			font-size: 28px;
		}

		.banner-custom .content-left h1 {
			font-size: 25px;
		}

		.banner-custom .content-right {
		    right: 4% !important;
		}

		.banner-custom .content-right h1 {
			font-size: 25px;
		}

		.banner-custom .content-right h4 {
			font-size: 20px;
		}

		.banner-golden-goal .content-left h2 {
			font-size: 42px !important; 
		}
	}

	@media (min-width: 768px) and (max-width: 992px) {
	   	.banner-explic-ras .content-left {
		    transform: translate(2%, 4%) !important;
		}

		.banner-explic-ras p {
			margin-bottom: 6px;
		}

		.banner-explic-ras .content-left h3 {
			font-size: 18px;
		}
		.banner-explic-ras .content-left h4 {
		    font-size: 15px;
		}

		.banner-explic-easy-loteria .content-left {
		    
		}

		.banner-explic-easy-loteria p {
			margin-bottom: 6px;
		}

		.banner-explic-easy-loteria .content-left h3 {
			font-size: 18px;
		}
		.banner-explic-easy-loteria .content-left h4 {
		    font-size: 15px;
		}

		.banner-explic-soccer .content-left {
		    
		}

		.banner-explic-soccer .content-left h3 {
			font-size: 12px;
		}
		.banner-explic-soccer .content-left h4 {
		    font-size: 10px;
		}

		.banner-easy-loteria .content-left h5 {
		    margin-bottom: 0px;
		}

		.banner-golden-goal .content-left {
			transform: translate(5%, -50%) !important;
		}

		.banner-golden-goal .content-left h2 {
			font-size: 30px !important;
		}


		.banner-custom .content-left {
		    
		}

		
		.banner-custom .content-left {
		    
		}

		.banner-custom .content-left h2 {
			font-size: 15px;
		}

		.banner-custom .content-left h1 {
			font-size: 18px;
		}

		.banner-custom .content-right {
		    right: 14%
		}

		.banner-custom .content-right h1 {
			font-size: 18px;
		}

		.banner-custom .content-right h4 {
			font-size: 13px;
		}
	}

	@media (min-width: 576px) and (max-width: 768px) {
	   	.banner-explic-ras .content-left {
		    transform: translate(2%, 4%) !important;
		}

		.banner-explic-ras p {
			margin-bottom: 6px;
		}

		.banner-explic-ras .content-left h3 {
			font-size: 12px;
		}
		.banner-explic-ras .content-left h4 {
		    font-size: 10px;
		}

		.banner-explic-easy-loteria .content-left {
		    
		}

		.banner-explic-easy-loteria p {
			margin-bottom: 6px;
		}

		.banner-explic-easy-loteria .content-left h3 {
			font-size: 12px;
		}
		.banner-explic-easy-loteria .content-left h4 {
		    font-size: 10px;
		}

		.banner-explic-soccer .content-left {
		    
		}

		.banner-explic-soccer .content-left h3 {
			font-size: 12px;
		}
		.banner-explic-soccer .content-left h4 {
		    font-size: 10px;
		}

		.banner-easy-loteria .content-left h5 {
		    margin-bottom: 0px;
		}

		.banner-golden-goal .content-left {
			transform: translate(5%, -50%) !important;
		}

		.banner-golden-goal .content-left h2 {
			font-size: 22px !important;
		}


		.banner-custom .content-left {
		    
		}

		.banner-custom .content-left h2 {
			font-size: 13px;
		}

		.banner-custom .content-left h1 {
			font-size: 15px;
		}

		.banner-custom .content-right {
		    
		}

		.banner-custom .content-right h1 {
			font-size: 13px;
		}

		.banner-custom .content-right h4 {
			font-size: 10px;
		}
	}

	@media (max-width: 576px) {
	    .banner-explic-ras .content-left {
		    transform: translate(2%, 4%) !important;
		}

		.banner-explic-ras p {
			margin-bottom: 6px;
		}

		.banner-explic-ras .content-left h3 {
			font-size: 10px;
		}
		.banner-explic-ras .content-left h4 {
		    font-size: 7px;
		}

		.banner-explic-easy-loteria .content-left {
		    transform: translate(14%, 10%) !important;
		}

		.banner-explic-easy-loteria p {
			margin-bottom: 6px;
		}

		.banner-explic-easy-loteria .content-left h3 {
			font-size: 12px;
			margin-bottom: 6px !important; 
		}
		.banner-explic-easy-loteria .content-left h4 {
		    font-size: 7px;
		}


		.banner-explic-soccer .content-left {
		    font-size: 10px;
		    transform: translate(13%, 0) !important;
		}

		.banner-explic-soccer .content-left h3 {
			font-size: 12px;
		}
		.banner-explic-soccer .content-left h4 {
		    font-size: 7px;
		}

		.banner-easy-loteria .content-left h5 {
		    margin-bottom: 0px;
			font-size: 10px !important;
		}

		.banner-golden-goal .content-left {
			transform: translate(5%, -50%) !important;
		}

		.banner-golden-goal .content-left h2 {
			font-size: 15px !important;
		}


		.banner-custom .content-left {
		    
		}

		.banner-custom .content-left h4, .banner-custom .content-left h3, .banner-custom .content-left h2, .banner-custom .content-left h1 {
			
		}

		.banner-custom .content-left {
		    
		}

		.banner-custom .content-left h2 {
			font-size: 8px;
		}

		.banner-custom .content-left h1 {
			font-size: 11px;
		}

		.banner-custom .content-right {
		    
		}

		.banner-custom .content-right h1 {
			font-size: 11px;
		}

		.banner-custom .content-right h4 {
			font-size: 8px;
		}

		.banner-soccer-expert .content-left h2 {
		    font-size: 13px
		}
	}

	h1 {
		width: 100%;
	}

	.banner-explic-ras .content-left {
	    left: 0;
	    position: absolute;
	    transform: translate(2%, 10%);
	    color: #606361;
	 	width: 50%;
	    top: 0;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-explic-soccer .content-left {
	    left: 30%;
	    position: absolute;
	    transform: translate(13%, 10%);
	    color: #606361;
	 	width: 55%;
	    top: 0;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-explic-easy-loteria .content-left {
	    left: 30%;
	    position: absolute;
	    transform: translate(13%, 10%);
	    color: #606361;
	    top: 0;
	    width: 60%;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-explic-easy-loteria .content-left h3 {
		margin-bottom: 13px;
	}

	.banner-easy-loteria .content-left {
	    position: absolute;
	    width: 100%;
	    color: #000;
	    bottom: 0;
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
	    position: absolute;
	    transform: translate(1%, -50%);
	    color: #002e5f;
	    font-weight: bold;
	    font-family: sans-serif;
	}

	.banner-golden-goal .content-left h2 {
		font-size: 50px; 
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
	    right: 4%;
	}
</style>