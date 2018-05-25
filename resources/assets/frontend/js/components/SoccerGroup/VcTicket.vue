<template>
	<section class="col-lg-12 line">
		
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+ticket.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-2">
	      		{{ ticket.posicao != null ? ticket.posicao : '-'}}
	      	</div>
	      	<div class="col-lg-2">
	      		<img class="photo" :src="ticket.owner.photo">
	      	</div>
	      	<div class="col-lg-2">
	      		{{ ticket.owner.nickname }}
	      	</div>
	      	<div class="col-lg-2">
	      		{{ ticket.pontuacao }}
	      	</div>
        </div>

        <div :class="'collapse '+ticket.id">
        	<div class="row no-margin">
        		<div class="col-lg-6 col-sm-6 col-md-6 col-12">
        			<div class="tickets">
						<!-- <header class="tickets-header">
							<span>{{ ticket.round.nome }}</span>
						</header> -->
						<div class="tickets-content" :style="backgroundTicket(ticket.round.imagem_capa)">
							<div class="row no-margin">
								<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in ticket.games">
									<vc-game :game="game" :ticket="ticket" :index="index"></vc-game>
								</div>
							</div>
						</div>
						<!-- <footer class="tickets-footer">
							
						</footer> -->
					</div> 
        		</div>
        	</div> 	
		</div>
	</section>
</template>

<script>
	import {routes} from '../../api_routes'
	import VcGame from './VcGame'
	import VcLoad from '../Load'
	export default {
		props: ['index', 'ticket'],
		data() {
			return {
				loading: {
					game: false
				},
			}
		},
		methods: {
			backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
		},
		mounted() {
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.ticket.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.ticket.id).on('show.bs.collapse', (event) => {
					  	
					});

					$(this.$el).find('.'+this.ticket.owner_id).on('hide.bs.collapse', (event) => {
						
					})
				}
			});
		},
		components: {
			VcGame,
			VcLoad
		}
	}
</script>

<style scoped>
	.columns {
		padding: 10px 0 10px 0;
	}

	.line .columns:after {
		font-family: 'FontAwesome';
		content: "\f068";
		float: right;
	}

	.line .collapsed:after {
		content: "\f067";
	}	

	[data-toggle="collapse"] {
		align-items: center;
	}

	.photo {
		width: 70px;
	    height: 70px;
	    border-radius: 999px;
	    margin-right: 5px;
	}
</style>