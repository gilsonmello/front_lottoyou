<template>
	<load v-if="loading.component == true" />
	<div class="container" v-else>
		<h1 class="page-header">{{ trans('strings.scratch_cards') }}</h1>

		<div class="row" v-if="scratch_card_themes.length == 0">
			<div class="col-lg-12">
				<h3>Nenhuma raspadinha disponível no momento</h3>
			</div>				
		</div>

		<div class="row">
			<div class="col-12 col-md-6 col-sm-6 col-lg-4" v-for="(scratch_card_theme, index) in scratch_card_themes" :key="index">
				<vc-product-card :bg_image="src(scratch_card_theme.img_card_url)" :is_new="scratch_card_theme.lot.new" :name="scratch_card_theme.nome" :title="scratch_card_theme.texto_index" :description="scratch_card_theme.texto_raspadinha">
					<template slot="card-body">
						<div class="amount">
							{{ scratch_card_theme.texto_index }}
						</div>
						<div class="jackpot-table">
							<div class="row vcenter">
								<div class="col-lg-8 col-12 col-md-8 col-sm-12">
									<a :data-id="scratch_card_theme.id" href="#" @click.prevent="handleJackpotTable($event)" class="btn description">
										<i class="fa fa-money" aria-hidden="true"></i>
										&nbsp;
										Tabela de Premios
									</a>
								</div>
								<div class="col-lg-4 col-12 col-md-4 col-sm-12">
									<a @click.prevent="handleDemo($event)" :data-id="scratch_card_theme.id" href="#" class="btn btn-md demo">
										Demo
									</a>
								</div>
							</div>
						</div>
					</template>

					<template slot="card-footer">							
						<form @submit.prevent="addToCart(index, $event)">
							<div class="row vcenter" v-for="(discount_table, ind) in scratch_card_theme.discount_tables" :key="ind">
								<div class="col-lg-9 col-9 col-md-9 col-sm-9">
									<label class="">
										<input type="radio" v-bind:value="ind" v-model="scratch_card_theme.positionSelected" :name="'game_'+index+'_option'">
										<span v-if="discount_table.is_discount == 1">
											{{ discount_table.quantity }} {{ discount_table.quantity == 1 ? trans('strings.game') : trans('strings.games') }}  {{'('+trans('strings.spare')+' '+discount_table.percentage+'%)'}}
										</span>

										<span v-else>
											{{ discount_table.quantity }} {{ discount_table.quantity == 1 ? trans('strings.game') : trans('strings.games') }} 
										</span>
									</label>
								</div>
								
								<div class="col-lg-3 col-3 col-md-3 col-sm-3">
									<span>
										{{getSystemCurrency.data.symbol}}{{ calculatePercentage(scratch_card_theme.lot.value, discount_table.percentage, discount_table.quantity ) }}
									</span>
								</div>
							</div>
							<div class="row vcenter" style="margin-top: 15px; background: none;">
								<div class="col-12 col-md-12 col-xs-12 col-sm-12 text-center">
									<button type="button" @click.prevent="handleScratchCard(index, $event)" class="btn btn-md btn-primary" v-if="scratch_card_theme.has_scratch_card">
										{{ trans('strings.to_play') }}
									</button>
									<button type="submit" class="btn btn-md btn-primary" v-if="scratch_card_theme.discount_tables.length > 0">
										{{ trans('strings.buy_now') }}
									</button>
									<span v-else>
										{{ trans('strings.unavailable') }}
									</span>
									<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-primary">
										<i class="fa fa-refresh fa-spin"></i>
									</button>
								</div>
							</div>
						</form>
					</template>
				</vc-product-card>
			</div>
		</div>
		<div class="modal fade modal-jackpot-table" id="nivel1" data-backdrop="static" tabindex="-1" aria-labelledby="nivel1" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		  		<div class="modal-content" v-if="loading.modalJackpotTable == true">
		  			<div class="modal-body">
		  				<load />
		  			</div>
		  		</div>
			    <div class="modal-content" v-else>
					<!-- Modal Header -->
			      	<div class="modal-header" style="border-bottom: none;">
			        	<!-- <h4 class="modal-title">Modal Heading</h4> -->
						<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		        			<div class="row">
		        				<div v-if="scratch_card_jackpot_available.img_card_url" class="col-lg-4 col-md-4 col-sm-4 col-12" :style="backgroundDemo(scratch_card_jackpot_available.img_card_url)+' padding-right: 0; padding-left: 0; min-height: 106px;'">
					        	</div>
					        	<div class="col-lg-8 col-md-8 col-sm-8 col-12 vcenter container-actions" style="background-color: #155C7B">
					        		
					        		<div class="" style="width: 100%;">
					        			<div class="row">
					        				<div class="col-lg-6 col-12 col-md-6 col-sm-6 pull-left">
						        				<a class="btn btn-md btn-success" href="#" @click.prevent="">
						        					{{ trans('strings.play_now') }}
						        				</a>
						        			</div>

					        				<div class="col-lg-6 col-12 col-md-6 col-sm-6 pull-left">
						        				<a :data-id="id" class="btn btn-md btn-demo" href="#" @click.prevent="handleDemo($event)">
							        				Demo
							        			</a>
						        			</div>
					        			</div>
					        			<div class="row">
						        			<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<p class="text-center number-of-cards" v-if="scratch_card_jackpot_available.total_tickets">
						        					{{ trans('strings.number_of_cards') }} {{  scratch_card_jackpot_available.total_tickets.qtd_raspadinhas}}
						        				</p>
						        			</div>
						        		</div>
					        		</div>
					        			
					        			<!-- <div class="row">
						        			<div class="col-lg-6 col-12 col-md-6 col-sm-6">
						        				<a class="btn btn-md btn-success" href="#" @click.prevent="">
						        					{{ trans('strings.play_now') }}
						        				</a>
						        			</div>			        			
						        			<div class="col-lg-6 col-12 col-md-6 col-sm-6">
						        				<a :data-id="id" class="btn btn-md btn-demo" href="#" @click.prevent="handleDemo($event)">
							        				Demo
							        			</a>
						        			</div>
						        		</div>
						        		<div class="row">
						        			<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						        				<p class="text-center number-of-cards" v-if="scratch_card_jackpot_available">
						        					{{ trans('strings.number_of_cards') }} {{  scratch_card_jackpot_available.qtd_raspadinhas}}
						        				</p>
						        			</div>
						        		</div> -->
					        		
					        	</div>
		        			</div>
		        		</div>		        	
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<!-- Modal body -->
			      	<div class="modal-body" style="padding-top: 0;">
		        		<table class="table table-striped text-center">
		        			<thead>
		        				<tr>
		        					<th>{{ trans('strings.level') }}</th>
		        					<th>{{ trans('strings.jackpot_available') }}</th>
		        					<th>{{ trans('strings.amount') }}</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        				<tr v-if="scratch_card_jackpot_available != null" v-for="(jackpot, key) in scratch_card_jackpot_available.jackpot_tables" :key="key">
		        					<td>{{ key + 1 }}</td>
		        					<td>{{ jackpot.disponivel }}</td>
		        					<td>{{getSystemCurrency.data.symbol}}{{ jackpot.quantia }}</td>
		        				</tr>
		        			</tbody>
		        		</table>
			      	</div>
					<!-- Modal footer -->
			      	<!--<div class="modal-footer">
			        	 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>-->
				</div>
		  	</div>
		</div>

		<div class="modal fade modal-demo" id="nivel2" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
		  	<div class="modal-dialog modal-xl">
		  		<div class="modal-content" v-if="loading.modalDemo == true">
		  			<div class="modal-body">
		  				<load />
		  			</div>
		  		</div>
			    <div class="modal-content" v-else>
					<!-- Modal Header -->
			      	<div class="modal-header" style="padding: 5px;">
			      		<div class="col-lg-6">
				        	<h5 class="modal-title">Demo de Raspadinhas sem prêmios</h5> 
				        </div>
			        	<!-- <div class="col-lg-5">
			        		<a href="javascript: void(0);" class="btn btn-success btn-xs pull-right">
				        		{{ trans('strings.play_truth') }}
				        	</a>  
			        	</div>  -->	
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<!-- Modal body -->
			      	<div class="modal-body" style="padding: 0;">
			      		
			      		<div class="col-lg-12 col-12 col-md-12 col-sm-12 no-padding" v-if="scratch_card_demo.theme" :style="backgroundDemo(scratch_card_demo.theme.img_background_url)">
			      			
		      				<div class="row" style="padding: 20px 20px 0 20px;">
		      					<div class="col-lg-6 col-12 col-md-6 col-sm-6">
		      						<div class="row" style="height: 100%;">
		      							<div class="col-lg-12 col-12 col-md-12 col-sm-12" style="padding: 0 5px 0 5px;">
		      								<span class="ticket-number">ID do Bilhete: #++++DEMO++++</span>
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
		      								<h3>{{ trans('strings.no_tickets_left') }}.</h3>
		      								<p>{{ trans('strings.buy_scratchcards_to_play') }}.</p>
		      								<div @click="app.reload" class="btn btn-primary btn-mini buy-more-btn">
		      									{{ trans('strings.buy_tickets') }}.
		      								</div>
	      								</div>
		      						</div>
		      						<div class="row h">
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class=" col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class=" col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
		      								</div>
		      							</div>
		      							<div class="col-lg-4 col-4 col-md-4 col-sm-4">
		      								<div class="scratchpad">
		      									
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
		      						
		      						<a v-if="demoAttempts > 0" @click.prevent="handlePlay($event)" href="javascript: void(0);" class="btn btn-game btn-play">
		      							{{ trans('strings.play_scratch_card') }}
		      						</a>
		      						
		      						<a v-if="demoAttempts > 0" @click.prevent="handleLoading($event)" href="javascript: void(0);" class="btn hide btn-game btn-loading">
		      							{{ trans('strings.loading') + ' ...' }}
		      						</a>
		      						<a v-if="demoAttempts > 0" @click.prevent="handleReveal($event)" href="javascript: void(0);" class="btn hide btn-game btn-reveal-all">
		      							{{ trans('strings.reveal_all') }}
		      						</a>
		      						
		      						<a v-if="demoAttempts > 0" @click.prevent="handlePlayAgain($event)" href="javascript: void(0);" class="btn hide btn-game btn-play-again">
		      							{{ trans('strings.play_again') }}
		      						</a>
		      						
		      						<a v-else @click.prevent="handleBuyNow($event)" href="javascript: void(0);" class="btn btn-game btn-buy-now">
		      							{{ trans('strings.buy_now') }}
		      						</a>
		      					</div>
		      				</div>
		      			</div>
		        	</div>
					<!-- Modal footer -->
			      	<!-- <div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>-->
				</div>
		  	</div>
		</div>

		<modal-component></modal-component>

	</div>
</template>

<script>
	import { routes } from '../../api_routes';
	import ModalFormComponent from '../ModalFormComponent';
	import ModalComponent from './ModalComponent';
	import { mapState, mapGetters } from 'vuex';
	export default {
		metaInfo () {
			return {
				title: this.trans('strings.scratch_cards') + ' | ' + this.trans('strings.lottoyou'),
				meta: this.metas
		    }
		},
		props: [],
		created () {
			
		},
		activated () {
			
		},
		methods: {
			handleScratchCard (index, $event) {
				let theme = this.scratch_card_themes[index];
				this.$eventBus.$emit('openModal', theme, () => {
					this.init();
				});
			},
			//Função para remover o espaço de uma url
			src (src) {
				return src.replace(' ', '%20');
			},
			backgroundDemo (background) {
				return 'background-image: url('+background.replace(' ', '%20')+'); background-size: 100% 100%;';
			},
			handleBuyNow (el) {
				$('.no-tickets-container').removeClass('hide');
				$('.h').css({
					opacity: 0.5
				});
				$('.btn-container').css({
					opacity: 0.5
				});
				//Removendo evento click do botão
				this.$off(el);
			},
			handlePlayAgain (el) {
				$('.modal-demo').off('hidden.bs.modal');
				
				if(this.demoAttempts == 0) {
					$('.modal-demo').modal('hide');
				} else {
					const instance = axios.create();
					instance.interceptors.request.use(config => {
						$('.btn-result').addClass('invisible');
						this.loading.modalDemo = true;
						return config;
					});
					instance.get(routes.scratch_card_themes.demo.replace('{theme_id}', this.id), {}).then(response => {
			            if(response.status === 200) {
			            	this.scratch_card_demo = response.data
							this.loading.modalDemo = false;
							$(el.target).addClass('hide');
							$('.btn-play').removeClass('hide');
							this.handleScratchPad();
						}
			        }).catch((error) => {
			        	$('.modal-demo').on('hidden.bs.modal', function (e) {
			        		if(error.response.data.msg) {
								toastr.error(error.response.data.msg);
				        	}
			        	});
			        	setTimeout(() => {
							$('.modal-demo').modal('hide');
			        	}, 500);
			        });
		        }		
			},
			handlePlay (el){
				$(el.target).addClass('hide');
				$('.btn-reveal-all').removeClass('hide');
				$('.scratchpad').wScratchPad('enable', true);
			},
			handleReveal (el) {
				const vm = this;
				var time = setTimeout(() => {
					$('.scratchpad').wScratchPad('clear');
					if(this.scratch_card_demo.premio > 0) {
						$('.btn-result').text('Parabéns, você ganhou: '+this.getSystemCurrency.data.symbol+''+this.scratch_card_demo.premio);
					}else {
						$('.btn-result').text(vm.trans('strings.good_luck_to_the_next'));
					}
					$(el.target).addClass('hide');
					$('.btn-result').removeClass('invisible');
                	$('.btn-play-again').removeClass('hide');
                	this.demoAttempts -= 1;
				}, 200);
			},
			handleScratchPad () {
				let vm = this;
				var dataScratchCard = this.scratch_card_demo;
				var count = 1;
        		var time = setInterval(() => {	
        			//Verificando se encontrou as divs scratchpad e se seus parentes possuem largura maior do que 0
					if($('.scratchpad').length > 0 && $('.scratchpad').parent().width() > 0){
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
		                        fg: dataScratchCard.theme.img_capa_url,
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
		                            	vm.demoAttempts -= 1;
		                            	if(dataScratchCard.premio > 0) {
		                            		$('.btn-result').removeClass('invisible');
											$('.btn-result').text('Parabéns, você ganhou: '+vm.getSystemCurrency.data.symbol+''+dataScratchCard.premio);
		                            	}else{
		                            		$('.btn-result').removeClass('invisible');
											$('.btn-result').text(vm.trans('strings.good_luck_to_the_next'));
		                            	}
		                            	$('.btn-reveal-all').addClass('hide');
		                            	$('.btn-play-again').removeClass('hide');
		                            }
		                        }
		                    });
	                        count++;
						});
						//Desabilitando todos os quadrados, obs: 
						//Só será habilitado ao clicar em jogar
						$('.scratchpad').wScratchPad('enable', false);		
					}						
				});
			},
			handleDemo (el) {
				this.id = el.target.getAttribute('data-id');
				
				$('.modal-demo').modal('toggle');
				$('.modal-demo').off('hidden.bs.modal');
				const instance = axios.create();
				instance.interceptors.request.use(config => {
					this.loading.modalDemo = true;
					return config;
				});
				instance.get(routes.scratch_card_themes.demo.replace('{theme_id}', this.id), {}).then(response => {
		            if(response.status === 200) {
		            	this.scratch_card_demo = response.data
						this.loading.modalDemo = false;
						this.handleScratchPad();
						this.demoAttempts = 5;
					}
		        }).catch((error) => {
		        	$('.modal-demo').on('hidden.bs.modal', function (e) {
		        		if(error.response.data.msg) {
							toastr.error(error.response.data.msg);
			        	}
		        	});
		        	setTimeout(() => {
		        		$('.modal-demo').modal('hide');
		        	}, 500)
	        		
		        });				
			},
			submit (){

			},
			handleJackpotTable (el) {
				this.id = el.target.getAttribute('data-id');
				$('.modal-jackpot-table').off('hidden.bs.modal');
				$('.modal-jackpot-table').modal('toggle');
				const instance = axios.create();
				instance.interceptors.request.use(config => {
					this.loading.modalJackpotTable = true;
					return config;
				});
				instance.get(routes.scratch_card_themes.jackpot_available.replace('{id}', this.id), {}).then(response => {
		            if(response.status === 200) {
		            	this.scratch_card_jackpot_available = response.data
	            		this.loading.modalJackpotTable = false;
		            }
		        }).catch((error) => {
		            $('.modal-jackpot-table').on('hidden.bs.modal', function (e) {
		        		if(error.response.data.msg) {
							toastr.error(error.response.data.msg);
			        	}
		        	});
		        	setTimeout(() => {
		        		$('.modal-jackpot-table').modal('hide');
		        	}, 500)
		        })
			},
			addToCart (index, event) {


				//A posição 0 foi reservada para o valor sem desconto
				/*if(this.scratch_card_themes[index].positionSelected == 0) {

					//Caso o usuário tenha selecionado a opção sem desconto
					var new_scratch_card_theme = Object.assign({}, this.scratch_card_themes[index], {})
					
					//Não possui tabela de desconto
					new_scratch_card_theme.discount_tables = {}

					new_scratch_card_theme.discount_tables.quantity = 1;

					//Atribuindo o valor da raspadinha ao total
					this.item.total = parseFloat(new_scratch_card_theme.value)

					//Passando para a estrutura os dados preenchidos pelo o usuário
					this.item.scratch_card = new_scratch_card_theme
				}
				else*/ 
				if (this.scratch_card_themes[index].discount_tables != undefined) {
					
					//Caso o usuário tenha selecionado a opção com desconto, 
					//Preciso decrementar a posição selecionada, pois o array da tabela de descontos começa em 0
					const positionSelected = this.scratch_card_themes[index].positionSelected;

					//Pegando o item da tabela de desconto selecionada
					var discount_tables = Object.assign(
						{}, 
						this.scratch_card_themes[index].discount_tables[positionSelected], 
						{}
					);

					//Variável que irá conter os dados a ser enviado
					var scratch_card_theme = Object.assign({}, this.scratch_card_themes[index], {});
					
					//Adicionando o item da tabela de desconto selecionado
					scratch_card_theme.discount_tables = discount_tables;

					//Valor da raspadinha
					var value = scratch_card_theme.lot.value;

					//Quantidade que está na tabela de desconto
					var quantity = scratch_card_theme.discount_tables.quantity;
					//Porcentagem que está na tabela de desconto
					var percentage = scratch_card_theme.discount_tables.percentage

					//Fazendo cálculo do total
					var total = (value - (value * percentage / 100)) * quantity

					//Passando para a estrutura os dados preenchidos pelo o usuário
					this.item.total = total;

					this.item.scratch_card = scratch_card_theme;
				}

				const addScratchCardRequest = axios.create();

				addScratchCardRequest.interceptors.request.use(config => {
		        	$(event.target).find('[type="load"]').removeClass('hide');
		        	$(event.target).find('[type="submit"]').addClass('hide');
		        	$(event.target).find('[type="button"]').addClass('hide');
				  	return config;
				});

				addScratchCardRequest.post(routes.carts.add_scratch_cards, {
					purchase: this.item,
					hash: this.item.hash,
					auth: this.auth,
				}).then(response => {
		            if (response.status === 200) {
	            		//Atualizando os dados do carrinho
						this.$store.dispatch('setItemScratchCard', this.item)
						//Redirecionando para o carrinho
						this.$router.push({name: 'cart.index'})
					}
		        }).catch((error) => {
		        	
		        })			
			},
			calculatePercentage (value, percentage, quantity) {
				let total = value * quantity;
				return (total - ((total * percentage) / 100)).format(2, true);
			},
			init () {

				const request = axios.create();
				request.interceptors.request.use(config => {
					this.loading.component = true;
					return config;
				});
				
				let url = routes.scratch_card_themes.index;

				request.get(url, {}).then(response => {
		            if(response.status === 200){
		            	this.item.hash = this.makeid();
		            	this.scratch_card_themes = response.data;
		            	for(var i = 0; i < this.scratch_card_themes.length; i++) {
		            		this.metas.push({
		            			name: 'description',
		            			content: this.scratch_card_themes[i].nome,
		            		});
		            	}
		            	this.scratch_card_themes = this.scratch_card_themes.filter((val) => {
		            		//Selecionado a primeira linha
	            			val.positionSelected = 0;
	            			val.hash = this.makeid();
		            		return true;
		            	});
						this.loading.component = false;
						setTimeout(() => {
							window.prerenderReady = true;
						}, 1000);
				    }
		        }).catch((error) => {
                    setTimeout(() => {
                        window.prerenderReady = true;
                    }, 1000);
		        })
			}
		},
		data () {
			return {
				scratch_card_themes: [],
				scratch_card_jackpot_available: {},
				method: "GET",
				action: null,
				loading: {
					modalDemo: false,
					modalJackpotTable: false,
					component: true
				},
				metas: [],
				id: null,
				scratch_card_demo: {},
				item: {
					total: 0.00,
					hash: '',
					scratch_card: {}
				},
				demoAttempts: 5
			}
		},
		beforeDestroy() {
            this.$eventBus.$off('openModal');
        },
		beforeMount () {
			
		},
		mounted() {
			//window.document.title = this.trans('strings.scratch_cards') +' - '+ window.app.title;
			//window.document.title = this.trans('strings.scratch_cards');
			
			this.init();
		},
		computed: {
			...mapGetters([
				'auth',
				'getSystemCurrency'
            ]),
            total: {
            	// getter
            	get: function () {
            		
		    	},
			    // setter
			    set: function (newValue) {
			      	
			    }
            }
		},
		watch: {
			'loading.modalDemo': function(newValue, oldValue) {},
			demoAttempts: function(newValue, oldValue) {
				
			}
		},
		components: {
			ModalFormComponent,
			ModalComponent
		}
	}
</script>

<style scoped>

	.table {
		margin-bottom: 0;
	}
	.table th, .table td {
		padding: 8px;
	}
	
	.info-text {
		color: #fff;
    	font-size: 15px;
	    margin: 0;
	    padding: 0 8px;
	    line-height: 22px;
	    text-shadow: 0 2px 3px rgba(0,0,0,.8);
	}
		
	.extras img {
		position: absolute;
		top: -15px;
	    left: -5px;
	    z-index: 4;
	}

	.modal-jackpot-table .container-actions {
		background-color: #155C7B;
	    text-align: center;
	}

	.modal-jackpot-table .container-actions .btn {
	   	margin: 10px 0 10px 0;
	   	display: block;
	}

	.modal-demo .modal-body {
		padding: 20px;
	}

	.h div{
		height: 146px;
		margin-bottom: 3px;
		padding: 0 5px 0 5px;
	}

</style>
