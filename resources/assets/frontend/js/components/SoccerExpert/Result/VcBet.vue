<template>	
	<section>
		<div class="row ticket" data-toggle="collapse" :data-target="'.'+ticket.id" :style="index % 2 == 0 ? 'background-color: rgba(0,0,0,.05);': 'background-color: initial;'">
	    	<div class="col-lg-2">
	    		{{ ticket.nome }}
	    	</div>
	    	<div class="col-lg-2">
	    		$ {{ ticket.valor }}
	    	</div>
	    	<div class="col-lg-2">
	    		{{ ticket.data_termino }}
	    	</div>
	    </div>

    	<div :class="'collapse '+ticket.id">
			<load-component v-if="loading.game"></load-component>	  	
	    	<div class="tickets" v-else>
				<header class="tickets-header"> 
		            <span class="text-center tickets-limit" v-if="ticket.limite == null">
						Ilimitado
		            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
		            </span>

		            <span class="text-center tickets-limit" v-else>				
						{{ ticket.group.count }} / {{ ticket.limite }}
		            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
		            </span> 
		            <span class="ticket-categories">
		            	{{ category.nome }}
		            </span>
				</header>
				<div class="tickets-content" :style="backgroundTicket(ticket.imagem_capa)">
					<div class="row">
						<div class="col-lg-12 col-sm-6 col-md-6 col-12">
							
						</div>
					</div>
				</div>
				<footer class="tickets-footer">
					<div class="row">
						<div class="col-lg-12">
							<em class="text-caption">Termina em: {{ ticket.data_termino }}</em>
						</div>
					</div>
				</footer>
			</div>			  	
		</div>
    
    </section>
</template>

<script>
	import {routes} from '../../../api_routes'
	import LoadComponent from '../../Load'
	export default {
		props: ['index', 'bet', 'category'],
		methods: {
			backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
			init() {
    			
        	}
		},
		mounted() {			
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.bet.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.bet.id).on('show.bs.collapse', (event) => {
					  	
					});

					$(this.$el).find('.'+this.bet.id).on('hide.bs.collapse', (event) => {
						
					})
				}
			}, 1000);	
			//this.init();	
				
		},
		data() {
			return {
				loading: {
					game: false
				},
			}
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	.ticket {
		background: #ccc9;
	    padding: 10px 0 10px 0;
	    cursor: pointer;
	}

	.row {
		margin: 0;
	}
</style>