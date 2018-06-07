<template>	
	<div class="container-fluid vcenter main-banner no-padding">
		<div class="row no-margin" style="width: 100%;">

			<div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
				<!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->

				<div class="banner-main" style="position: relative">
					<img style="width: 100%; " class="img-fluid" src="/img/new1/BAN-princi_S_TX.png">

					<div class="content-left">
						<h1 class="" style="">
							Aqui é mais fácil
						</h1>
					</div>
				</div>
			</div>
		</div>



		<!--<div class="container">
			<div class="row">
				<div class="col-lg-9 col-9 col-md-5 col-sm-5" style="min-height: 260px; padding: 21px;">
					<h1>
						A FESTA APENAS
						<span style="color: #E6B00F; text-align: center;">COMEÇOU!</span>
						<img class="img-fluid" src="https://www.lottoland.com/cms/59706a8c0eb3583efd1b422c/br_ms_stage_smile.png">
					</h1>
				</div>
				<div class="col-lg-3 col-3 col-md-3 col-sm-3" style="padding-top: 31px;">
					<img class="img-fluid l-stageTemplate-banner-iconContainer-floatingBall l-stageTemplate-banner-iconContainer-icon" src="https://www.lottoland.com/cms/599fd29b0eb35855e66e8e7f/br_sticker_3_137px_desktop_bubble_2jogos.png">
				</div>
			</div>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<div class="row vcenter" style="background-color: yellow;">
				<div class="col-lg-1 col-2 col-sm-1 col-md-2">
					<img class="img-fluid" src="https://www.lottoland.com/skins/lottoland/images/lotteryLogos/lt-megaSena-46abf10e66bb8829.png">
				</div>
				<div class="col-lg-8 col-6 col-sm-8 col-md-7">
					<span class="jackpot-currency">R$</span>
					<span class="jackpot-amount">6,2</span>
					<div class="jackpot-million">
						<span class="jackpot-pitch">Mega-Sena</span>
						<span class="jackpot-translation">milhões</span>
					</div>
				</div>
				<div class="col-lg-3 col-4 col-sm-3 col-md-3 pull-right">
					<span class="pull-right">2 jogos extras grátis</span><br>
					<span class="pull-right">ao comprar 3 jogos da Mega-Sena</span><br>
					<a href="#" class="btn btn-md btn-success pull-right">Jogar agora</a>
				</div>
			</div> 
		</div>-->
	</div>
</template>
<script>
	export default {
		mounted: function() {
			
		},
		activated: function() {
			
		}
	}
</script>

<style scoped>

	@media (min-width: 1200px) and (max-width: 1400px) {

	}

	@media (min-width: 768px) and (max-width: 992px) {
		.banner-main .content-left {
			transform: translate(90%, 0%) !important;
		}
		h1 {
			font-size: 22px !important;
		}
	}

	@media (min-width: 576px) and (max-width: 768px) {
		.banner-main .content-left {
			transform: translate(85%, 0%) !important;
		}
		h1 {
			font-size: 18px !important;
		}
	}

	@media (max-width: 576px) {
		.banner-main .content-left {
			transform: translate(65%, 0%) !important;
		}

		h1 {
			font-size: 15px !important;
		}
	}

	@media (min-width: 300px) and (max-width: 370px){
		.banner-main .content-left {
			transform: translate(65%, 0%) !important;
		}

		h1 {
			font-size: 10px !important;
		}
	}

	.banner-main .content-left {
		transform: translate(53%, 0%);
		top: 38%;
		position: absolute;
	}

	/*.main-banner {
		min-height: 356px;
	    background-size: 100% 100%;
	}*/

	.container-fluid img {
	
		width: 100%;
	}
	
	h1 {
		font-size: 52px;
		font-family: "Interstate", sans-serif;
		font-weight: bold;
		color: #00448c;
		text-transform: uppercase;
	}

	.jackpot-translation {
		color: #fff;
		height: 60px;
		font-weight: 900;
		font-size: 40px;
		text-align: left;
		line-height: 30px;
	}

	.jackpot-pitch {
		color: #012406;
		font-weight: 500;
		font-size: 14px;
		display: block;
		line-height: 20px;
		text-align: left;
	}

	.jackpot-currency {
	    margin-left: 0;
	    margin-right: 0;
	    font-weight: 900;
	    font-size: 40px;
	    line-height: 60px;
	    height: 60px;
	    color: #fff;
	}

	.jackpot-million {
		display: inline-block;
		align-items: flex-end;
		-webkit-align-items: flex-end;
	}

	.jackpot-amount{
		font-weight: 900;
		font-size: 80px;
		color: #fff
	}
</style>