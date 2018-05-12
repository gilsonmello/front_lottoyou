<template>		
	<div class="tickets">
		<!-- <header class="tickets-header">	
			<span class="text-center tickets-name">
            	{{ ticket.nome }} - $ {{ value }}
            </span> 
            <span class="countdown">
				<span v-if="days > 1">
					{{ days }} {{ trans('strings.days') }} e
				</span>
				<span v-else-if="days == 1">
					{{ days }} {{ trans('strings.day') }} e
				</span>				
				{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
			</span>		
            <span class="ticket-categories">
            	{{ category.nome }}
            </span>
		</header> -->
		<div class="tickets-content" :style="backgroundTicket(ticket.imagem_capa)">
			<div class="row no-margin">
				<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in ticket.games">
					<vc-game :game="game" :ticket="ticket" :index="index"></vc-game>
				</div>
			</div>
		</div>
		<!-- <footer class="tickets-footer">
			<div class="row">
				<div class="col-lg-12">
					<em class="text-caption">Termina em: {{ ticket.data_termino }}</em>
				</div>
			</div>
		</footer> -->
	</div>
</template>

<script>
	import VcGame from './VcGame'
	export default {
		props: ['ticket', 'index', 'type', 'category'],
		data: function() {
        	return {
        		loading: {
					game: false
				},
    			value: 0.00,
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: ''
        	}
        },
        methods: {
            getGameTotal(item) {
                return parseFloat(item.data.total).format(2, true);
            },
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        	init() {
    			let value = parseFloat(this.ticket.valor);
		        this.value = value.format(2, true); 
		        var date = this.formatDate(this.ticket.data_termino);				
				var timeOut = setInterval(() => {
    				this.setCountdown(date, timeOut);
    			}, 1000);
    			this.setCountdown(date, timeOut);    	
		    },
		    setCountdown(date, timeOut) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.days = d;
					this.hours = h;
					this.minutes = m;
					this.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
						this.valid = false
					}
	            });
			},
        },
        mounted() {	
            this.init();
		},
		components: {
			VcGame
		},
		computed: {
			
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
		padding: 0;
	}

	.tickets-header {
		padding: 5px 0 0 0;
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
		color: #000;
	}
</style>