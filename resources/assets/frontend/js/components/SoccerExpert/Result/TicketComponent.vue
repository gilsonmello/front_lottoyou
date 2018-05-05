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
						<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in games">
							<game-component :game="game" :ticket="ticket" :index="index"></game-component>
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

	<!-- <div class="col-lg-4">
		<h4 data-toggle="collapse" :data-target="'.'+ticket.id">{{ ticket.nome }}</h4>

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
						<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in games">
							<game-component :game="game" :ticket="ticket" :index="index"></game-component>
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
	</div> -->
</template>

<script>
	import {routes} from '../../../api_routes'
	import LoadComponent from '../../Load'
	import GameComponent from './GameComponent'
	export default {
		props: ['index', 'ticket', 'category'],
		methods: {
			backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
			init() {
    			var date = this.formatDate(this.ticket.data_termino);
    			var timeOut = setInterval(() => {
    				this.countdown(date, (d, h, m, s, distance) => {
		            	this.days = d;
						this.hours = h;
						this.minutes = m;
						this.seconds = s;
						if(distance < 0) {
							clearInterval(timeOut);
						}
		            });
    			}, 1000);
        	}
		},
		mounted() {			
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.ticket.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.ticket.id).on('show.bs.collapse', (event) => {
					  	const gameRequest = axios.create();

						gameRequest.interceptors.request.use(config => {
							this.loading.game = true;
				        	return config;
						});

						let url = routes.soccer_tickets.games.replace('{ticket_id}', this.ticket.id);

						gameRequest.get(url, {}, {}).then(response => {
							if(response.status === 200) {
								this.games = response.data;
								this.loading.game = false;
							}
						}).catch((error) => {
							this.loading.game = false;
						});
					});

					$(this.$el).find('.'+this.ticket.id).on('hide.bs.collapse', (event) => {
						this.games = []
					})
				}
			}, 1000);	
			//this.init();	
			this.ticket.valor = parseFloat(this.ticket.valor).format(2, true);	
		},
		data() {
			return {
				loading: {
					game: false
				},
				days: '',
    			hours: '',
    			minutes: '',
    			seconds: '',
    			games: []
			}
		},
		components: {
			GameComponent,
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