<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'soccer_expert.play', params: { slug: item.soccer_expert.slug } }" class="active show">
	                    {{ trans('strings.play_on_the') }} {{ item.soccer_expert.nome }}
	                </router-link>
	                <router-link :to="{ name: 'soccer_expert.results', params: { slug: item.soccer_expert.slug } }" class="show">
	                    {{ trans('strings.results') }}
	               	</router-link>
	               	<router-link :to="{ name: 'soccer_expert.ranks', params: { slug: item.soccer_expert.slug } }" class="show">
		                {{ trans('strings.rank') }}
		           	</router-link>
        		</div>
        	</div>
        </div>	
       	
       	<div class="row">
        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
        		<h4 class="page-header" style="margin-top: 0; border: none;">{{ item.soccer_expert.nome }}</h4>
        	</div>
        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
        		<button class="btn btn-md btn-back pull-right btn-primary" @click.prevent="back($event)">
        			{{ trans('strings.back') }}
        		</button>
        	</div>
        </div>



		<div class="row" v-if="item.soccer_expert.cycles.length == 0">
			<div class="col-lg-12">
				<h3>Nenhuma cartela disponível no momento</h3>
			</div>				
		</div>
    	
    	<form @submit.prevent="addToCart($event)" v-else>
	    	<div class="row">
				<div class="col-lg-12">
			        <div id="carouselExampleIndicators" data-interval="false" class="carousel slide" data-ride="carousel">
			            <ol class="carousel-indicators" style="bottom: -20px;">
			                <li data-target="#carouselExampleIndicators" :data-slide-to="index" :class="index == 0 ? 'active' : ''" v-for="(cycle, index) in item.soccer_expert.cycles"></li>  
			            </ol>
			            <div class="carousel-inner" role="listbox">
			                <div :class="index == 0 ? 'carousel-item active' : 'carousel-item'" v-for="(cycle, index) in item.soccer_expert.cycles">
			                    <cycle-component :index="index" :item="item" :cycle="cycle"></cycle-component>
			                </div>
						</div>
			        </div>
			        <a class="carousel-control-prev" v-if="item.soccer_expert.cycles.length > 1" id="prev-slide-content" href="#carouselExampleIndicators" role="button" data-slide="prev">
			            <span class="fa fa-angle-left" style="color: black; font-size: 50px;"></span>
			            <span class="sr-only">Previous</span>
			        </a>
			        <a class="carousel-control-next" v-if="item.soccer_expert.cycles.length > 1" id="next-slide-content" href="#carouselExampleIndicators" role="button" data-slide="next">
			            <span class="fa fa-angle-right" style="color: black; font-size: 50px;"></span>
			            <span class="sr-only">Next</span>
			        </a>
			    </div>   
			</div>
	    	
	    	<br>
	    	<hr>
			<div class="row">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<button v-if="loading.paying" @click.prevent="" type="load" class="pull-right btn btn-md btn-primary">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
					<button v-else type="submit" class="btn btn-md btn-primary pull-right">
						{{ trans('strings.add_to_cart') }}
					</button>
					<span class="pull-right price">
						{{getSystemCurrency.data.symbol}}<span class="value" v-if="item.total > 0">
							{{ totalFormated }}
						</span>
						<span class="value" v-else>0.00</span>
					</span>
				</div>
			</div>		
		</form>	


		<div class="modal fade modal-ticket" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" v-if="ticket != null">
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom: none;" v-if="loading.paying">
                    	<button type="button" class="close">&nbsp;</button>
                    </div>
                    <div class="modal-header" style="border-bottom: none;" v-else>
                    	<button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="padding-top: 0;">
                        <modal-ticket-component :item="item" :category="item.soccer_expert" :ticket="ticket"></modal-ticket-component>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    	<div class="col-lg-7 col-md-6 col-7 col-sm-6 no-padding">
                    		
                    		<div class="alert alert-danger" v-if="quantityEmpty > 0 || !chooseGoldBall">
                    			<span v-if="quantityEmpty > 0" style="display: block;">
	                    			{{ quantityEmpty }} {{ quantityEmpty > 1 ? trans('strings.remaining_games') : trans('strings.remaining_game') }}
	                    		</span>
                    			<span v-if="!chooseGoldBall">Marque a <img src="/img/gold_ball.png" class="img-fluid gold-ball">(Bola Lottoyou) e ganhe 25% a mais da pontuação do jogo escolhido</span>
                    		</div>
                    	</div>

                    	<div class="col-lg-5 col-md-6 col-5 col-sm-6 no-padding">
                    		<button v-if="loading.paying" @click.prevent="" type="load" class="pull-right btn btn-md btn-primary">
								<i class="fa fa-refresh fa-spin"></i>
							</button>
	                        <button v-if="!loading.paying" type="button" @click="addToCartModal" class="btn-add-cart pull-right btn btn-md btn-primary pull-right">
								{{ trans('strings.add_to_cart') }}
							</button>
	                    	<button @click="fastBuy($event)" type="button" v-if="loading.paying == false && auth && auth.balance.value >= parseFloat(ticket.valor)" class="pull-right btn btn-primary" style="margin-right: 10px;">
	                            {{ trans('strings.pay_now') }}
	                        </button>
                    	</div>
                    	
                        <!-- <button v-if="!loading.paying" type="button" class="btn btn-danger" data-dismiss="modal">
                            {{ trans('strings.to_close') }}
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import { routes } from '../../api_routes';
	import LoadComponent from '../Load';
	import { mapState, mapGetters } from 'vuex';
	import CycleComponent from './CycleComponent';
	import TicketComponent from './TicketComponent';
	import ModalTicketComponent from './Modal/TicketComponent';
	export default {
		metaInfo () {
			return {
				title: this.item.soccer_expert.nome +' | '+ this.trans('lottoyou'),
				meta: [
					{ name: 'description', content: this.item.soccer_expert.nome },
					{
						'property': 'og:title',
						'content': this.item.soccer_expert.nome,
						'vmid': 'og:title'
					},
					{
						'property': 'og:description',
						'content': this.item.soccer_expert.nome,
						'vmid': 'og:description'
					}
		        ]
		    }
		},
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
        data: function() {
        	return {
        		loading: {
					component: true,
					modalJackpotTable: false,
					paying: false,
				},
				item: {
					soccer_expert: {},
					hash: '',
					total: 0.00,
					tickets: []
				},
				ticket: null,
				chooseGoldBall: false,
				quantityEmpty: 0
        	}
        },
        methods: {
        	back(event) {
				this.$router.push({
					name: 'soccer_expert.index'
				})
			},
        	backgroundModal(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        	fastBuy(event) {
        		this.loading.paying = true;
        		this.$eventBus.$emit('validatePurchase');
			},
			addToCartModal(event) {
        		this.loading.paying = true;
        		this.$eventBus.$emit('addToCartModal');
			},
        	addToCart(event) {
        		
				var item = {
					hash: this.item.hash,
					total: this.item.total,
					soccer_expert: this.item.soccer_expert,
					tickets: this.item.tickets,
				};

				//Se não completou nenhuma rodada
				if(this.item.tickets.length == 0) {
					this.$store.dispatch('removeItemSoccerExpert', item);
					toast.error('Erro ao adicionar item', 'Complete pelo menos uma cartela');
				} else {				

					let addSoccerExpertRequest = axios.create();

					addSoccerExpertRequest.interceptors.request.use(config => {
						this.loading.paying = true
						return config;
					});

					addSoccerExpertRequest.post(routes.carts.add_soccer_experts, {
						purchase: item, 
						hash: item.hash,
						auth: this.auth,					
					}).then(response => {
						if(response.status === 200) {
							this.loading.paying = false;
							this.$store.dispatch('setItemSoccerExpert', item);
			            	this.$router.push({
								name: 'cart.index'
							})
						}
			        }).catch((error) => {
			        	this.loading.paying = false;
			        	toast.error('Erro ao adicionar item', 'Por favor tente novamente');
			        })	
				}
        	},
        	showRequest() {
        		const showRequest = axios.create();
				let slug = this.$route.params.slug;
				
				showRequest.interceptors.request.use(config => {
		        	this.loading.component = true
				  	return config;
				});
				showRequest.get(routes.soccer_experts.play.replace('{slug}', slug), {}, {}).then(response => {
					if(response.status === 200) {
						this.loading.component = false;
						this.item.hash = this.makeid();
						this.item.soccer_expert = response.data;
                        setTimeout(() => {
                            window.prerenderReady = true;
                        }, 1000);
					}
				}).catch((error) => {
                    setTimeout(() => {
                        window.prerenderReady = true;
                    }, 1000);
				});
        	},
        	showSoccerExpert() {
        		let interval = setInterval(() => {
					let item = this.purchase.soccer_expert.items.filter((val) => {
						return this.$route.query.hash == val.hash;
					});

					if(item.length > 0) {
						clearInterval(interval);
						this.loading.component = false;
						this.item = item[0];

					} else {

					}
				});
                setTimeout(() => {
                    window.prerenderReady = true;
                }, 1000);
			},
			//Função executada ao carregar
			init: function() {
				if(this.$route.query.hash != undefined) {
					this.showSoccerExpert();
				} else if(this.$route.params.slug != undefined) {
					this.showRequest();
				}
				//window.document.title = this.trans('strings.soccer_expert');
			},
			
		},
		mounted: function() {
			this.init();

			//Escutando evento, que será executado pelo TicektComponent
            this.$eventBus.$on('openModal',  (ticket) => {
                //Pegando o ticket passado como parâmetro
                this.ticket = ticket
                $('.modal-ticket').off('hidden.bs.modal');
                //Abrindo o modal
                $('.modal-ticket').on('hidden.bs.modal', (event) => {
	            	this.ticket = null
	            	this.$eventBus.$emit('closeModal');
	            }).modal({
	            	show: true,
	            	keyboard: false,
		            backdrop: 'static'
	            });
            }); 

    		this.$eventBus.$on('notificationPayment', () => {
    			this.loading.paying = false;
    		});

    		this.$eventBus.$on('chooseGoldBall', (chooseGoldBall) => {
    			this.chooseGoldBall = chooseGoldBall;
    		});

    		this.$eventBus.$on('quantityEmpty', (quantityEmpty) => {
    			this.quantityEmpty = quantityEmpty;
    		});

    	},
    	beforeDestroy() {
            this.$eventBus.$off('openModal');
            this.$eventBus.$off('notificationPayment');
            //this.$eventBus.$off('closeModal');
            //this.$eventBus.$off('validatePurchase');
            this.$eventBus.$off('chooseGoldBall');
            this.$eventBus.$off('quantityEmpty');
        },
    	components: {
			LoadComponent,
			CycleComponent,
			TicketComponent,
			ModalTicketComponent,
		},
		computed: {
			...mapGetters([
				'purchase', 
				'auth',
				'getSystemCurrency'
            ]),
			totalFormated: {
            	// getter
            	get: function () {
            		let tot = parseFloat(this.item.total);
            		return tot.format(2, true);
		    	},
			    // setter
			    set: function (newValue) {
			      	
			    }
            }
		}
	}
</script>

<style scoped>

	.gold-ball {
		font-size: 30px;
	    color: gold;
	    line-height: 1;
	    cursor: pointer;
	    margin-right: 5px;
	    height: 40px;
	    width: 40px;
	}

	.btn-xs {
        margin: 2px;
        width: 28px;
        height: 28px;
        font-size: 12px;
        border-radius: 999px !important;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        -webkit-transition: -webkit-box-shadow 0.15s ease-out;
        -moz-transition: -moz-box-shadow 0.15s ease-out;
        -o-transition: -o-box-shadow 0.15s ease-out;
        transition: box-shadow 0.15s ease-out;
        padding: 0;
    }

 	.ticket-sweepstake-name {
        display: block;
    }


	@media (min-width: 992px) {
  	  	.modal-xl {
	    	width: 85%;
	    }
	}
    

	#prev-slide-content{
        left: -50px; 
        right: auto;
        width: 30px !important;
    }

    #next-slide-content{
        left: auto; 
        right: -50px;
        width: 30px !important;
    }
    .slide{
        width: 100%;
        margin: 0 auto;
    }

    .carousel .fa {
        font-size: 60px !important;
    }

    @media (max-width: 576px) {
		.btn-add-cart {
			margin-bottom: 10px;
			white-space: normal;
		}
    	.slide{
	        width: 90%;
	        margin: 0 auto;
	    }
	    #prev-slide-content{
	        left: 0; 
	        right: auto;
	        width: 30px !important;
	    }

	    #next-slide-content{
	        left: auto; 
	        right: 0;
	        width: 30px !important;
	    }
    }
    
	.price {
		margin-right: 15px;
	}

	.well {
		padding: 0;
	}

	.tickets {
		padding: 0;
	}

	.tickets-content {
		padding: 2px 15px 0 15px;
		background-color: initial;
	}

	.club {
		display: block;
	}

	.no-padding {
	    margin-left: 2px;
    	margin-right: 2px;
	}

	.input-group-addon {
		border-color: transparent;					
	    background-color: transparent;
	    color: inherit;
	    opacity: 0.7;
	    padding: 0;
	    justify-content: center;
	}

	.complete {
		border: 3px solid #67be13 !important;
	}

	.incomplete {
	    border: 3px solid #BF390F !important;
	}

	.modal-xl {
        max-width: 85%;
    }

	@media (min-width: 992px)  {
	    .modal-xl {
	        max-width: 90%;
	    }
	}

	@media (max-width: 767px){
	    .modal-xl {
	        max-width: 98%;
	    }
	}

</style>