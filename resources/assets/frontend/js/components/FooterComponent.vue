<template>
	<footer>
		<br>
		<div class="container-fluid" style="background: linear-gradient(90deg,#fafafa,#f2f4f2); border-bottom: 1px solid #d9deda">  
		    <div class="container">
				<div class="row" style="align-items: center; justify-content: center;">
		            <div class="col-lg-2 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/5846d41ce4b0d02cb5922535/boletol_logo@2x.png">
		            </div>
		            <div class="col-lg-2 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="/img/pagseguro.png">
		            </div>
		            <div class="col-lg-2 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="/img/paypal.png">
		            </div>
		            <div class="col-lg-2 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/596c86890eb35860f76742c5/visa_logo@2x.png">
		            </div>
		            <div class="col-lg-2 col-3 col-md-3 col-sm-3">
		                <img class="img-responsive img-fluid" src="//www.lottoland.com/cms/596c86940eb35860f76742c7/mastercard_logo@2x.png">
		            </div>
		            <div class="col-lg-1 col-3 col-md-2 col-sm-2">
		                <img class="img-responsive img-fluid" src="/img/american-express.png">
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
		<div class="container-fluid footer-plataform-container" style="border-bottom: 1px solid #d9deda">
			<div class="container">
			    <div class="row">
		            <div class="col-lg-4 col-md-4 col-12 col-sm-4">
		                <h3 class="page-header">
		                    Informações
		                </h3>
		                <ul class="list-group">
		                    <li class="list-group-item">
		                        <router-link :to="{name: 'help'}" class="color-blue">
		                            Ajuda
		                        </router-link>
		                    </li>
		                    <li class="list-group-item">
								<router-link :to="{name: 'play_protection'}" class="color-blue">
		                            Proteção do Jogador
								</router-link>
		                    </li>
		                    <li class="list-group-item">
								<router-link :to="{name: 'privacy'}" class="color-blue">
		                            Privacidade
								</router-link>
		                    </li>
		                </ul>               
		            </div>
		            <div class="col-lg-4 col-md-4 col-12 col-sm-4">
		                <h3 class="page-header">
		                    &nbsp;
		                </h3>
		                <ul class="list-group">
		                    <li class="list-group-item">
								<router-link :to="{ name: 'terms'}" class="color-blue">
		                            {{ trans('strings.terms_and_conditions') }}
								</router-link>
		                    </li>
		                    <li class="list-group-item" v-if="auth">
		                        <router-link :to="{ name: 'users.games', params: {  }}" class="color-blue">
		                            Resultados
		                        </router-link>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Pergunte
		                        </a>
		                    </li>
		                </ul>               
		            </div>
		            <div class="col-lg-4 col-md-4 col-12 col-sm-4">
		                <h3 class="page-header">
		                    Idioma
		                </h3>
		                <ul class="list-group">
		                	<li class="list-group-item">
		                        <a @click.prevent="redirect" href="/#/" class="color-blue">
		                            English
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a @click.prevent="redirect" href="/#/es" class="color-blue">
		                            Espanhol
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a @click.prevent="redirect" href="/#/br" class="color-blue">
		                            Português (Brasil)
		                        </a>
		                    </li>
		                    <!-- <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Deutsch
		                        </a>
		                    </li> -->
		                    
		                    <!-- <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Slovak
		                        </a>
		                    </li>
		                    <li class="list-group-item">
		                        <a href="#" class="color-blue">
		                            Polski
		                        </a>
		                    </li> -->
		                    <li class="list-group-item">
		                        <div id="google_translate_element"></div>
		                    </li>
		                </ul>               
		            </div>
		            <!-- <div class="col-lg-4 col-md-6 col-12 col-sm-6">
		                <h3 class="page-header">
		                    &nbsp;
		                </h3>
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
	                    <li class="list-group-item">
	                        <a href="#" class="color-blue">
	                            &nbsp;
	                        </a>
	                    </li>
		            </div> -->

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
					A Lottoyou.bet é administrada pela P2G INVERSIONES SAC.
					<br>
					P2G INVERSIONES SAC não é associada ou afiliada a nenhuma operadora de loterias oficiais. Sede na Republica do Peru.
					<br>
					Este site é destinado a usuarios maiores de 18 anos.
				</p>
			</div>
		</div>
	</footer>
</template>

<script>
	import {mapState, mapGetters} from 'vuex'
	export default {
		computed: {
            ...mapGetters([
                'auth'
            ])
        },
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
		updated() {

		},
		created: function() {

		},
		activated() {
		},
		mounted: function() {
			
			$.ajaxSetup({
			  	cache: true
			});

			window.googleTranslateElementInit = function() {
			  	new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');

              	setInterval(() => {
              		if($('.skiptranslate iframe').length > 0 && $('.skiptranslate iframe').parent().is(':visible')) {
              			$('body').css({
              				'padding-top': 0
              			});

              			$('.header').css({
              				position: 'relative'
              			});
              		} else {
              			$('.header').css({
              				position: 'fixed'
              			});

				    	$('body').css({
				    		'padding-top': $('.header')[0].clientHeight - 1
				    	});
              		}
              	}, 2000);

              	/*var mutationObserver = new MutationObserver(function(mutations) {
				  	mutations.forEach(function(mutation) {
				  		if($(mutation.target).find('div.skiptranslate').length > 0) {
					    	console.log($(mutation.target).find('div.skiptranslate'));
					    }
				  	});
				});

              	console.log(document.querySelector('body'))
				mutationObserver.observe(document.querySelector('body'), {
				  	attributes: true,
				  	characterData: true,
				  	childList: true,
				  	subtree: true,
				  	attributeOldValue: true,
				  	characterDataOldValue: true
				});*/
			}

            $.getScript("//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit", function( data, textStatus, jqxhr ) {
			});
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