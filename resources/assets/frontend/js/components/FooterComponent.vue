<template>
	<footer>
		<div class="container-fluid" style="border-bottom: 1px solid #d9deda">  
		    <div class="container">
				<div class="row" style="">
		            <div class="col-lg-3 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d41ce4b0d02cb5922535/boletol_logo@2x.png">
		            </div>
		            <div class="col-lg-3 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d427e4b0d02cb592253a/transferencia_bancaria_local_logo@2x.png">
		            </div>
		            <div class="col-lg-3 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/596c86890eb35860f76742c5/visa_logo@2x.png">
		            </div>
		            <div class="col-lg-3 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/596c86940eb35860f76742c7/mastercard_logo@2x.png">
		            </div>
		        </div>
	        </div>
		</div>
		<!-- <div class="container-fluid" style="background: linear-gradient(90deg,#fafafa,#f2f4f2); border-bottom: 1px solid #d9deda">  
		    <div class="container" style="position: initial;">
		        <div class="row">
		            <div class="col-lg-3 col-6 col-md-3 col-sm-6">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d49ce4b0d02cb5922547/18_icon@2x.png">
		            </div>
		            <div class="col-lg-3 col-6 col-md-3 col-sm-6">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d4a6e4b0d02cb5922549/eu_icon@2x.png">
		            </div>
		            <div class="col-lg-3 col-6 col-md-3 col-sm-6">
		                <a href="#">
		                    <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d4afe4b0d02cb592254d/gibraltar-gov_icon@2x.png">
		                </a>
		            </div>
		            <div class="col-lg-3 col-6 col-md-3 col-sm-6">
		                <a href="#">
		                    <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d4c2e4b0d02cb5922550/gbga_icon@2x.png">
		                </a>
		            </div>
		        </div>
		    </div> 
		</div> -->
		<br>
		<div class="container-fluid footer-plataform-container" style="background: linear-gradient(90deg,#fafafa,#f2f4f2); border-bottom: 1px solid #d9deda">
			<div class="container">
			    <div class="row">
		            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
		                <h3 class="page-header">
		                    Informações
		                </h3>
		                <ul class="list-group">
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Ajuda
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Proteção do Jogador
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Privacidade
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Termos e Condições
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Resultados
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Pergunte
		                        </a>
		                    </li>
		                </ul>               
		            </div>
		            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
		                <h3 class="page-header">
		                    Idioma
		                </h3>
		                <ul class="list-group">
		                    <li class="list-group-item">
		                        <a @click.prevent="redirect" href="/#/br" class="color-blue">
		                            Português (Brasil)
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Deutsch
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a @click.prevent="redirect" href="/#/" class="color-blue">
		                            English
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Slovak
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Polski
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Svenska
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Português
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            České
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            English (Canada)
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Deutsch (Schweiz)
		                        </a>
		                    </li>
		                </ul>               
		            </div>
		        </div>
		        
			</div>
			<br>
		</div>

		<div class="container-fluid footer-plataform-container" style="background: linear-gradient(90deg,#fafafa,#f2f4f2)">
			<br>
			<div class="container no-padding">
				<p class="text-center">
			 		<img class="img-fluid logo" style="height: 50px;" src="/imgs/logo.png">
				</p>
			 	
				<!--
				<ul class="footer-signs">
					<li class="footer-signs-item">
						<img src="//www.lottoland.com/cms/5846d442e4b0d02cb592253d/webutation_icon@1x.png" width="65" height="65">
					</li>
					<li class="footer-signs-item">
						<img src="//www.lottoland.com/cms/54f8a9e7e4b0deabcfd57249/br_trustsign_ekomi.png">
					</li>
					<li class="footer-signs-item">
						<img src="//www.lottoland.com/cms/54f8aa32e4b0deabcfd58079/br_trustsign_webshop.png">
					</li>
					<li class="footer-signs-item">
						<img src="//www.lottoland.com/cms/59f998ed0eb35873b6b46d98/EGR-Power-50-Rankings-Twitter-banner-768x384.jpg" class="img-fluid">
					</li>
				</ul>
				<p></p>-->
				<p class="text-center">
					A Lottoyou.bet é administrada pela Lottoyou, em nome da EU Lotto Limited.
					EU Lotto está autorizada a oferecer serviços de intermediação.<br>

					<br> EU Lotto não é associada ou afiliada a nenhuma operadora de loterias oficiais. Sede no endereço: Suite A, Ocean Village Promenade, Ocean Village, Gibraltar, GX11 1AA <br><br>
					Jogue nas maiores loterias online com a lottoyou.bet
				</p>
			</div>
		</div>
	</footer>
</template>

<script>
	export default {
		data: function() {
			return {

			}
		},
		methods: {
			redirect: function(el) {
				window.location.href = el.target.getAttribute('href')
				window.location.reload();
				
			}
		},
		created: function() {

		},
		mounted: function() {
			
		}
	}
</script>

<style scoped>
	.color-blue{
        color: #0056b1
    }

    .color-blue:hover{
        color: #003874
    }

    .footer-signs {
    	width: 100%;
    	list-style: none;
    	text-align: center;
    	padding-left: 0;
    }

    .footer-signs .footer-signs-item {
    	margin: 0 7px;
    	display: inline-block;
    	max-width: 112px;
    }

    svg {
    	fill: #9aa89c;
	    stroke: #9aa89c;
	    vertical-align: text-bottom;
	    height: 32px;
    }

    .footer-plataform-container p{
    	margin-bottom: 36px;
	    font-size: 12px;
	    color: #9aa89c;
	    margin: 0 0 10px;
    }
</style>