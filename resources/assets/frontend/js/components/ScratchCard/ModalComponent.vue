<template>
	<div class="modal fade modal-scratch-card" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="border-bottom: none;">
                	<button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="padding: 0;" v-if="theme">
                	<load-component v-if="loading.component == true"></load-component>

                	<div class="col-lg-12 col-12 col-md-12 col-sm-12 no-padding" v-else :style="backgroundDemo(theme.img_background_url)">			      			
	      				<div class="row" style="padding: 20px 20px 0 20px;">
	      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
	      						<div class="row" style="height: 100%;">
	      							<div class="col-lg-12 col-12 col-md-12 col-sm-12" style="padding: 0 5px 0 5px;">
	      								<span class="ticket-number">ID do Bilhete: #{{ scratch_card.id }}</span>
	      							</div>
	      							<!-- <div class="col-lg-12 col-12 col-md-12 col-sm-12 vcenter-end" style="padding: 0 5px 0 5px;">
	      								<p :style="'color: '+scratch_card_demo.theme.cor_texto_raspadinha+' '" class="text-center info-text">
	      									{{ scratch_card_demo.theme.texto_index }}
	      								</p>
	      							</div> -->
	      							<div class="col-lg-12 col-12 col-md-12 col-sm-12 vcenter-end" style="padding: 0 5px 0 5px;">
	      								<a href="javascript: void(0);" class="btn btn-result invisible">
			      							{{ trans('strings.result') }}
			      						</a>
	      							</div>
	      						</div>
	      					</div>
	      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
	      						<div class="no-tickets-container hide">
	      							<div class="vert-align">
	      								<h3>Não restam raspadinhas.</h3>
	      								<p>Tens de comprar mais raspadinhas para voltar a jogar.</p>
	      								<div @click="app.reload" class="btn btn-primary btn-mini buy-more-btn">
	      									Comprar mais bilhetes.
	      								</div>
      								</div>
	      						</div>
	      						<div class="row h" v-if="loading.scratchpad" >
	      							<div class="col-lg-4 col-4 col-md-4 col-sm-4" v-for="(val, index) in (0, 9)">
	      								<div class="scratchpad">
	      									
	      								</div>
	      							</div>
	      						</div>
	      						<div class="row h" v-else>
	      							<div class="col-lg-4 col-4 col-md-4 col-sm-4" v-for="(val, index) in (0, 9)">
	      								<div class="scratchpad empty" :style="backgroundScratchpad()">
		      							</div>
	      							</div>
	      						</div>
	      					</div>
	      				</div>
	      				<div class="row" style="padding: 10px 20px 10px 20px;">
	      					<div class="col-lg-6 col-12 col-md-6 col-sm-6" style="padding: 0 5px 0 5px;">
	      						<a href="javascript: void(0);" class="btn remaining-tickets">Raspadinhas restantes: {{ demoAttempts }}</a>
	      					</div>
	      					<div class="col-lg-6 col-12 col-md-6 col-sm-6 btn-container" style="padding: 0 5px 0 5px;">		      						
	      						<a v-if="loading.game == 0" @click.prevent="handlePlay($event)" href="javascript: void(0);" class="btn btn-game btn-play">
	      							{{ trans('strings.play_scratch_card') }}
	      						</a>
	      						<a v-if="loading.game == 1" href="javascript: void(0);" class="btn btn-game btn-loading">
	      							{{ trans('strings.loading') + ' ...' }}
	      						</a>
	      						<a v-if="loading.game == 2" @click.prevent="handleReveal($event)" href="javascript: void(0);" class="btn btn-game btn-reveal-all">
	      							{{ trans('strings.reveal_all') }}
	      						</a>
	      						<a v-if="loading.game == 3" @click.prevent="handlePlayAgain($event)" href="javascript: void(0);" class="btn btn-game btn-play-again">
	      							{{ trans('strings.play_again') }}
	      						</a>
	      					</div>
	      				</div>
	      			</div>  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import LoadComponent from '../Load'
	import {routes} from '../../api_routes'
	import {mapState, mapGetters} from 'vuex'
	export default {
		props: [],
		computed: {
			...mapGetters([
                'auth'
            ]),
		},
		data() {
			return {
				loading: {
					component: true,
					game: 0,
					scratchpad: false,
				},
				theme: null,
				scratch_card: {},
				demoAttempts: 5,
			}
		},
		mounted() {
			this.$eventBus.$on('openModal',  (theme) => {
                this.theme = theme;
                $('.modal-scratch-card').modal('toggle');
            }); 

			$('.modal-scratch-card').off('hidden.bs.modal');

			$('.modal-scratch-card').on('hidden.bs.modal', (e) => {
				this.theme = null;
        	});

        	$('.modal-scratch-card').on('show.bs.modal', (e) => {
        		/*const instance = axios.create();
				instance.interceptors.request.use(config => {
					this.loading.component = true;
					return config;
				});
				var url = routes.scratch_card_themes.show
					.replace('{theme_id}', this.theme.id);

				instance.get(url, {}).then(response => {
		            if(response.status === 200) {
		            	this.loading.component = false;
		            	
					}
		        }).catch((error) => {		        	
		        	this.loading.component = false;
		        });*/
		        this.loading.component = false;
        	});
		},
		methods: {
			changeScratchCard() {
				var instance = axios.create();

				instance.interceptors.request.use(config => {	
					this.loading.game = 1;
					return config;
				});

				var url = routes.scratch_card_themes.change_scratch_card
					.replace('{scratch_card_id}', this.scratch_card.id);

				return instance.post(url, {});				
			},
			handlePlayAgain: function (el) {
				
				if(this.demoAttempts == 0) {
					$('.modal-scratch-card').modal('hide');
				} else {
					var instance = axios.create();
					
					this.loading.game = 1;
					this.loading.scratchpad = false;
					
					instance.interceptors.request.use(config => {
						$(this.$el).find('.btn-result').addClass('invisible');
						return config;
					});

					var url = routes.scratch_card_themes.play
						.replace('{theme_id}', this.theme.id)
						.replace('{user_id}', this.auth.id);

					instance.get(url, {}).then(response => {
			            if(response.status === 200) {
			            	this.scratch_card = response.data
			            	this.loading.scratchpad = true;
							this.handleScratchPad();
						}
			        }).catch((error) => {
			        	
			        });				
		        }		
			},
			backgroundScratchpad() {
				return 'background-image: url('+this.theme.img_capa_url.replace(' ', '%20')+'); background-size: 100% 100%;';
			},
			handleReveal(el) {
				this.changeScratchCard()
				.then(response => {
		            if(response.status === 200) {
		            	
		            	$(this.$el).find('.scratchpad').wScratchPad('clear');

		            	if(this.scratch_card.premio > 0) {
							$(this.$el).find('.btn-result').text('Parabéns, você ganhou: $ '+this.scratch_card.premio);
						} else {
							$(this.$el).find('.btn-result').text(this.trans('strings.good_luck_to_the_next'));
						}

						$(this.$el).find('.btn-result').removeClass('invisible');
		            	
		            	$(this.$el).find('.btn-play-again').removeClass('hide');
		            	
		            	this.demoAttempts -= 1;
		            	
		            	this.loading.game = 3;
					}
		        }).catch((error) => {
		        	
		        });
			},
			handleScratchPad: function() {
				var vm = this;
				var dataScratchCard = this.scratch_card;
				var theme = this.theme;
				var count = 1;
        		var time = setInterval(() => {	
        			//Verificando se encontrou as divs scratchpad e se seus parentes possuem largura maior do que 0
					if($('.scratchpad').length > 0 && $('.scratchpad').parent().width() > 0) {
						clearInterval(time);
						//Destruindo os scratchpads
						$('.scratchpad').wScratchPad('destroy');
						//Responsável por contar quantos quadrados foram raspados
						var i = 0;
						//Percorrendo todos os scratchpads
						$('.scratchpad').each(function () {
							var scratchpad = $(this);
							//Colocando a largura igual ao do seu parente
							$(this).css({
								width: $(this).parent().width()
							});
							$(this).wScratchPad({
		                        bg: dataScratchCard['valor'+count],
		                        fg: theme.img_capa_url,
		                        cursor: 'crosshair',
		                        scratchMove: function (e, percent) {
		                        	//Se o usuário raspou mais do que 59%, mostra a imagem de premiação e
		                        	//Desabilita o respectivo quadrado
		                            if (percent > 59) {
		                            	i++;
		                            	scratchpad.wScratchPad('clear');
		                            	scratchpad.wScratchPad('enable', false);
		                            }

		                            //Caso o usuário raspou 9 quadrados, verifica se o bilhete era premiado
		                            if(i == 9) {
		                            	vm.changeScratchCard();
		                            	vm.loading.game = 3;
		                            }
		                        }
		                    });
	                        count++;
						});
						//Desabilitando todos os quadrados, obs: 
						//Só será habilitado ao clicar em jogar
						$('.scratchpad').wScratchPad('enable', false);	
						//Alterando status para carregado
						vm.loading.game = 2;			
					}						
				});
			},
			handlePlay: function(el) {
				var instance = axios.create();
				instance.interceptors.request.use(config => {
					$(el.target).addClass('hide');
					$(this.$el).find('.btn-loading').removeClass('hide');
					//Alterando status para carregando
					this.loading.game = 1;				
					return config;
				});
				
				var url = routes.scratch_card_themes.play
					.replace('{theme_id}', this.theme.id)
					.replace('{user_id}', this.auth.id);

				instance.get(url, {}).then(response => {
		            if(response.status === 200) {
		            	this.loading.scratchpad = true;
		            	this.scratch_card = response.data
						this.handleScratchPad();
					}
		        }).catch((error) => {
		        		        		
		        });				
			},
			backgroundDemo(background) {
				return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
			},
			//Função para remover o espaço de uma url
			src(src) {
				return src.replace(' ', '%20');
			},
		},
		components: {
			LoadComponent
		},
		watch: {
			'loading.scratchpad': {
				deep: true,
				handler: function(newValue, oldValue) {
					if(oldValue) {
						var time = setInterval(() => {
							if($(this.$el).find('.empty').length > 0) {
								$(this.$el).find('.empty').empty();
								clearInterval(time);
							}
						});
					}
				}
			}
		}
	}
</script>

<style scoped>
	
	.h div{
		height: 146px;
		margin-bottom: 3px;
		padding: 0 5px 0 5px;
	}

</style>