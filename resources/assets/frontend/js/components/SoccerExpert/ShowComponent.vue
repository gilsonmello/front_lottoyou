<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'soccer_expert.show', params: { id: item.soccer_expert.id } }" class="active show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ item.soccer_expert.nome }}
	                </router-link>
	                <router-link :to="{ name: 'soccer_expert.results', params: { id: item.soccer_expert.id } }" class="show" id="result-component">
	                    Resultado 
	               	</router-link>
	               	<router-link :to="{ name: 'soccer_expert.ranks', params: { id: item.soccer_expert.id } }" class="show" id="result-component">
		                Rank 
		           	</router-link>
        		</div>
        	</div>
        </div>	
       	
       	<div class="row">
        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
        		<h4 class="page-header" style="margin-top: 0; border: none;">{{ item.soccer_expert.nome }}</h4>
        	</div>
        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
        		<button class="btn btn-md btn-back pull-right btn-info" @click.prevent="back($event)">
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
					<button type="submit" class="btn btn-md btn-success pull-right">
						{{ trans('strings.add_to_cart') }}
					</button>
					<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-success">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
					<span class="pull-right price">
						$ <span class="value" v-if="item.total > 0">
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
                    <div class="modal-header" style="border-bottom: none;">
                    	<button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="padding-top: 0;">
                        <modal-ticket-component :item="item" :category="item.soccer_expert" :ticket="ticket"></modal-ticket-component>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            {{ trans('strings.to_close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>	


    </div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import {mapState, mapGetters} from 'vuex'
	import CycleComponent from './CycleComponent'
	import TicketComponent from './TicketComponent'
	import ModalTicketComponent from './Modal/TicketComponent'
	export default {
		beforeRouteUpdate: function(to, from, next) {
			next();
			this.init();
        },
        data: function() {
        	return {
        		loading: {
					component: true
				},
				item: {
					soccer_expert: {},
					hash: '',
					total: 0.00,
					tickets: []
				},
				ticket: null,
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
					alert('Faça pelo menos um jogo');
				} else {
					
					this.$store.dispatch('setItemSoccerExpert', item);

					let addSoccerExpertRequest = axios.create();

					addSoccerExpertRequest.interceptors.request.use(config => {
						$(event.target).find('[type="load"]').removeClass('hide');
			        	$(event.target).find('[type="submit"]').addClass('hide');
					  	return config;
					});

					addSoccerExpertRequest.post(routes.carts.add_soccer_experts, {
						purchase: item, 
						auth: this.auth,
						hash: item.hash
						
					}).then(response => {
						if(response.status === 200) {
			            	this.$router.push({
								name: 'cart.index'
							})
						}
			        }).catch((error) => {
			        	console.log(error);
			        })	
				}
        	},
        	showRequest() {
        		const showRequest = axios.create();
				let id = this.$route.params.id;
				
				showRequest.interceptors.request.use(config => {
		        	this.loading.component = true
				  	return config;
				});
				showRequest.get(routes.soccer_experts.show.replace('{id}', id), {}, {}).then(response => {
					if(response.status === 200) {
						this.loading.component = false
						this.item.hash = this.makeid();
						this.item.soccer_expert = response.data;
					}
				}).catch((error) => {
					
				});
        	},
        	showSoccerExpert() {
        		var interval = setInterval(() => {
					var item = this.purchase.soccer_expert.items.filter((val) => {
						return this.$route.params.hash == val.hash;
					})

					if(item.length > 0) {
						clearInterval(interval);
						this.loading.component = false
						this.item = item[0]
					} else {

					}
				});
			},
			//Função executada ao carregar
			init: function() {
				if(this.$route.params.hash != undefined) {
					this.showSoccerExpert();
				} else if(this.$route.params.id != undefined) {
					this.showRequest();
				}
				window.document.title = this.trans('strings.soccer_expert');
			},
			
		},
		mounted: function() {
			this.init();

			//Escutando evento, que será executado pelo TicektComponent
            this.$eventBus.$on('openModal',  (ticket) => {
                //Pegando o ticket passado como parâmetro
                this.ticket = ticket
                //Abrindo o modal
                $('.modal-ticket').on('hidden.bs.modal', (event) => {
	            	this.ticket = null
	            }).modal('toggle');
            }); 
    	},
    	beforeDestroy() {
            this.$eventBus.$off('openModal');
        },
    	components: {
			LoadComponent,
			CycleComponent,
			TicketComponent,
			ModalTicketComponent,
		},
		computed: {
			...mapGetters([
                'purchase', 'auth'
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