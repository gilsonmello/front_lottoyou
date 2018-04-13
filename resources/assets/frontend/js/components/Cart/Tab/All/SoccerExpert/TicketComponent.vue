<template>
	<div class="row">
		<div class="col-lg-4 col-12 col-md-4 col-sm-4">
			<div class="tickets" :style="backgroundTicket(round.imagem_capa)">
				<div class="tickets-content" v-for="(game, line) in round.games">
					<game-component :game="game" :column="column" :line="line"></game-component>
				</div>
			</div>
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