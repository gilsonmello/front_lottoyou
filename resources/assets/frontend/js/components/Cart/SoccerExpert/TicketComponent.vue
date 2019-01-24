<template>		
	<div class="tickets">
		<header class="tickets-header">			
            <span class="text-center tickets-name">{{ ticket.nome }} - {{ getSystemCurrency.data.symbol }}{{ value }}</span> 
            <span class="countdown">
				<span v-if="days > 1">
					{{ days }} {{ trans('strings.days') }} e
				</span>
				<span v-else-if="days == 1">
					{{ days }} {{ trans('strings.day') }} e
				</span>				
				{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
			</span>  
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
				<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in ticket.games" :key="index">
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
</template>

<script>	
	import { mapGetters } from 'vuex';
	import GameComponent from './GameComponent';
	export default {
		props: ['ticket', 'index', 'type', 'category'],
		data () {
        	return {
    			value: 0.00,
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: ''
        	}
		},
		computed: {
			...mapGetters([
				'getSystemCurrency'
            ])
		},
        methods: {
        	backgroundTicket (background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        	init () {
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
        mounted () {
			let value = parseFloat(this.ticket.valor);
            this.value = value.format(2, true);     	
            this.init();
		},
		components: {
			GameComponent
		}
	}
</script>

<style scoped>

	.tickets-content {
		background-color: initial;
		text-align: center;
	    padding-bottom: 20px;
	    padding-top: 20px;
	}

	.tickets {		
		padding: 5px;
	}

	.tickets-header {
		padding: 5px 0 0 0;
		color: #000;
		background-color: initial;
	}

	.tickets-header .ticket-categories {
		font-weight: bold;
		text-align: center;
		background-color: #fad7d4;
	    border-color: #f7bec3;
	    color: #a94442;
        border: 1px solid transparent;
	    border-radius: 2px;
	    display: block;
	    text-transform: uppercase;
	}

	.tickets-header .tickets-limit {
		display: block;
	}

	.tickets-header .tickets-name {
	    display: block;
	    vertical-align: middle;
	    line-height: 17px;
	    font-size: 20px;
	    color: #000
	}

	.countdown {
		display: block;
		text-transform: lowercase;
		text-align: center;
	}
</style>