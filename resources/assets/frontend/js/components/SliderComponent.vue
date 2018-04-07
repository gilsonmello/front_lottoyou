<template>	
	<div class="container-fluid">
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
	.container-fluid {
		background-image: url("/img/banner_principal_83.jpg");
		background-size: 100% 100%;
		height: 350px;
	}
	h1 {
		font-size: 47px;
		line-height: 47px;
		text-align: center;
    	max-width: 500px;
    	color: #012406;
    	text-transform: uppercase;
    	font-weight: 900;
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