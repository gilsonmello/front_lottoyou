<template>	
	<div class="tickets" :style="backgroundTicket(ticket.imagem_capa)">
		<div class="row">
            <div class="col-lg-12">
                {{ ticket.data_termino }}
            </div>
        </div>
		<div class="tickets-content" v-for="(game, index) in ticket.games">
			<game-component :game="game" v-on:updateTicket="updateTicket" :index="index"></game-component>
		</div>
	</div>
		
</template>

<script>
	
	import GameComponent from './GameComponent'
	export default {
		props: ['ticket', 'index'],
		data: function() {
        	return {
    			
        	}
        },
        methods: {
        	backgroundTicket(background) {
        		return 'background-image: url('+background+')';
        	},
        	updateTicket() {
        		//Atribuindo o resultado informado para o time da casa
				//Serve para controlar se a rodada foi complemente preenchida
				var complete = true

				//Serve para controlar se a rodada está completamente vazia
				var empty = true;

				//Verificando se encontrou algum dado vazio na rodada, se estiver, complete passa a ser falso, ou seja,
				//Não foi concluído o preenchimento na rodada
				this.ticket.games.filter((val) => {
					
					if((val.result_out_club == '' || val.result_out_club == undefined) 
						|| (val.result_house_club == '' || val.result_house_club == undefined)) {
						complete = false
						
					}
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club != '' || val.result_out_club == undefined) 
						|| (val.result_house_club != '' || val.result_house_club == undefined)) {
						empty = false;
					}

					return true;
				});

				//Se foi completado o preenchimento na rodada
				if(complete == true) {
					this.ticket.complete = true;
					$(this.$el).addClass('complete');
					$(this.$el).removeClass('incomplete');
				} else {
					this.ticket.complete = false;
					$(this.$el).addClass('incomplete');
					$(this.$el).removeClass('complete');
				}

				//Se a rodada está vazia
				if(empty) {
					$(this.$el).removeClass('complete');
					$(this.$el).removeClass('incomplete');
				}
				
				this.$emit('updateSoccerExpert');
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