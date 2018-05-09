<template>	
	<section class="ticket">
		<div class="row ticket-columns collapsed" data-toggle="collapse" :data-target="'.'+ticket.id" :style="index % 2 == 0 ? 'background-color: rgba(255,255,255,.05);': ''">
	    	<div class="col-lg-2">
	    		{{ ticket.nome }}
	    	</div>
	    	<div class="col-lg-2">
	    		$ {{ ticket.valor }}
	    	</div>
	    	<div class="col-lg-2">
	    		{{ ticket.data_termino }}
	    	</div>
	    	<div class="col-lg-1">
	    		<button class="btn btn-xs btn-info" @click="">Resultado</button>
	    	</div>
	    </div>
	</section>
</template>

<script>
	import {routes} from '../../../../api_routes'
	import LoadComponent from '../../../Load'
	export default {
		props: ['index', 'bet'],
		methods: {
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
			//this.init();	
			this.bet.valor = parseFloat(this.bet.valor).format(2, true);	
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
    			games: [],
    			groups: []
			}
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>

	.collapse {
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.ticket-columns {
		padding: 10px 0 10px 0;
	}

	.ticket .ticket-columns:after {
		font-family: 'FontAwesome';
		content: "\f068";
		float: right;
	}

	.ticket .collapsed:after {
		content: "\f067";
	}	

	.ticket {
		background: #212529;
	    cursor: pointer;
	    padding: 0;
	}

	.row {
		margin: 0;
	}
</style>