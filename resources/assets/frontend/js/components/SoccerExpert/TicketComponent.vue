<template>
	
	<div class="tickets" :style="backgroundTicket(round.imagem_capa)">
		<div class="tickets-content" v-for="(game, line) in round.games">
			<game-component :game="game" :column="column" :line="line" v-on:houseClubResult="houseClubResult" v-on:outClubResult="outClubResult"></game-component>
		</div>
	</div>
		
</template>

<script>
	
	import GameComponent from './GameComponent'
	export default {
		props: ['round', 'column'],
		data: function() {
        	return {
    			
        	}
        },
        methods: {
        	backgroundTicket(background) {
        		return 'background-image: url('+background+')';
        	},
        	houseClubResult(value, column, line, event) {
        		this.$emit('houseClubResult', value, column, line, event);
        	},
        	outClubResult(value, column, line, event) {
        		this.$emit('outClubResult', value, column, line, event);	
        	}
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
</style>