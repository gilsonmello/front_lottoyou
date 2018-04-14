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
        		</div>
        	</div>
        </div>	
       	<div class="row">
        	<div class="col-lg-12">
        		<h4 class="page-header" style="margin-top: 0;">{{ item.soccer_expert.nome }}</h4>
        	</div>
        </div>
    	
    	<form @submit.prevent="addToCart">
	    	<div class="row">
		    	<slide-component :item="item"></slide-component>
			</div>

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
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import {mapState, mapGetters} from 'vuex'
	import SlideComponent from './SlideComponent'
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
					total: 0.00
				}
        	}
        },
        methods: {
        	//Pegando todas as apostas concluídas
			getTicketsWeekFinished: function() {
				const vm = this
				
				//Pegando todas as apostas feitas
				var ticketsWeekComplete = this.item.soccer_expert.ticketsWeek.filter(function(val) {
					//Verificando se dezenas extras está habilitado
					if(val.complete == true) {
						return true;
					}else { 
						return false;
					}
				});
				
				return ticketsWeekComplete;
			},
			//Pegando todas as apostas concluídas
			getTicketsNextWeekFinished: function() {
				const vm = this
				
				//Pegando todas as apostas feitas
				var ticketsNextWeekComplete = this.item.soccer_expert.ticketsNextWeek.filter(function(val) {
					//Verificando se dezenas extras está habilitado
					if(val.complete == true) {
						return true;
					}else { 
						return false;
					}
				});
				
				return ticketsNextWeekComplete;
			},
        	addToCart() {
        		//Pegando todas as rodadas finalizadas
				var ticketsWeek = this.getTicketsWeekFinished();
				var ticketsNextWeek = this.getTicketsNextWeekFinished();

				var item = {
					hash: this.item.hash,
					total: this.item.total,
					soccer_expert: this.item.soccer_expert,
					ticketsWeek: ticketsWeek,
					ticketsNextWeek: ticketsNextWeek
				};

				//Se não completou nenhuma rodada
				if(ticketsWeek.length == 0) {
					this.$store.dispatch('removeItemSoccerExpert', item);
					alert('Faça pelo menos um jogo');
				} else {
					
					this.$store.dispatch('setItemSoccerExpert', item);

					let addSoccerExpertRequest = axios.create();

					addSoccerExpertRequest.interceptors.request.use(config => {
			        	$(event.currentTarget).find('[type="load"]').removeClass('hide');
			        	$(event.currentTarget).find('[type="submit"]').addClass('hide');
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
			},
			
		},
		mounted: function() {
			this.init();
		},
		components: {
			LoadComponent,
			SlideComponent
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

</style>