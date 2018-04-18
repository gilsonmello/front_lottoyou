<template>		
	<div class="tickets">
		<header class="tickets-header">			
            <span class="text-center tickets-name">{{ ticket.nome }} - ${{ value }}</span>   
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
				<div class="col-lg-12 col-sm-6 col-md-6 col-12" v-for="(game, index) in ticket.games">
					<game-component :game="game" :ticket="ticket" :index="index"></game-component>
				</div>
			</div>
		</div>
		<footer class="tickets-footer">
			<div class="row">
				<div class="col-lg-12">
					<em class="text-caption">
						Termina em: {{ ticket.data_termino }} às {{ ticket.hora_termino }} hrs
					</em>
				</div>
			</div>
		</footer>
	</div>		
</template>

<script>
	
	import GameComponent from './GameComponent'
	export default {
		props: ['ticket', 'index', 'type', 'category'],
		data: function() {
        	return {
    			value: 0.00
        	}
        },
        methods: {
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        },
        mounted: function() {
			let value = parseFloat(this.ticket.valor);
            this.value = value.format(2, true);
		},
		components: {
			GameComponent
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
	    cursor: default;
	}

	.tickets {
		
		padding: 5px;
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
</style>