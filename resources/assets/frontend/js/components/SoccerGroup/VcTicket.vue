<template>
	<section class="col-lg-12 line">
		
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+ticket.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-3 col-4 col-sm-3 col-md-3 no-padding">
    			<div class="info-user" style="">
    				<span style="flex: 1">&nbsp;{{ ticket.posicao != null ? ticket.posicao : '-'}}</span>&nbsp;&nbsp;
		      		<img v-if="ticket.owner.photo" class="photo" :src="ticket.owner.photo">
		      		<img v-else src="//www.lottoland.com/skins/lottoland/images/profile/profileImageDummySquare-9e4d5d1b70298254.png" class="photo">&nbsp;&nbsp;
		      		<span style="flex: 6;">{{ ticket.owner.nickname }}</span>
    			</div>	      		
	      	</div>
	      	<div class="col-lg-1 col-2 col-sm-2 col-md-1 text-center no-padding">
	      		{{ ticket.pontuacao != null ? ticket.pontuacao : '-' }}
	      	</div>
	      	<div class="col-lg-1 col-2 col-sm-2 col-md-1 text-center no-padding">
	      		{{ ticket.pontuacao_bola_ouro != null ? ticket.pontuacao_bola_ouro : '0' }}
	      	</div>
	      	<div class="col-lg-1 col-2 col-sm-2 col-md-1 text-center no-padding">
	      		{{ ticket.qtd_acertos_placares != null ? ticket.qtd_acertos_placares : '0' }}
	      	</div>
	      	<div class="col-lg-1 col-2 col-sm-2 col-md-1 text-center no-padding">
	      		{{ ticket.qtd_acertos_diferenca_gols_ou_empate != null ? ticket.qtd_acertos_diferenca_gols_ou_empate : '0' }}
	      	</div>
        </div>

        <div :class="'collapse '+ticket.id">
        	<div class="row no-margin">
        		<div class="col-lg-6 col-sm-6 col-md-6 col-12 no-padding">
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
		word-wrap: break-word;
    	-webkit-line-break: after-white-space;
	}

	.line .columns:after {
		font-family: 'FontAwesome';
	    content: "\F068";
	    position: absolute;
	    right: 0;
	    margin-right: 10px;
	}

	.line .collapsed:after {
		content: "\f067";
	}	

	[data-toggle="collapse"] {
		align-items: center;
	}

	.photo {
		flex: 2;
		width: 70px;
	    height: 70px;
	    border-radius: 999px;
	    margin-right: 5px;
	}

	.info-user {
		display: flex; 
		flex-direction: row; 
		flex-wrap: nowrap; 
		align-items: center;
	}

	@media (min-width: 576px) and (max-width: 768px) {
		.info-user {
			align-items: center;
		}
		.photo {
			width: 30px;
			height: 30px;
	    	margin-right: 0px;
		}	
	}

	@media (max-width: 576px) {
		.info-user {
			align-items: center;
		}
		.photo {
			display: none;
			width: 30px;
			height: 30px;
	    	margin-right: 0px;
		}		
	}
</style>