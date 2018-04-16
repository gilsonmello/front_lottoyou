<template>	
	<div class="tickets" :style="backgroundTicket(ticket.imagem_capa)" @click.prevent="openModal">
		<div class="tickets-content" v-for="(game, index) in ticket.games">
			<game-component :game="game" :index="index"></game-component>
		</div> 
	</div>		
</template>

<script>
	
	import GameComponent from './GameComponent'
	export default {
		props: ['ticket', 'index', 'type'],
		data: function() {
        	return {
    			
        	}
        },
        methods: {
        	openModal() {

        	},
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        },
        mounted: function() {
			
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
	}

	.tickets {
		padding: 10px 20px 10px 20px;
	}
</style>