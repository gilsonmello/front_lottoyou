<template>	
	<div class="tickets">
		<header class="tickets-header">			
            <span class="text-center tickets-name">{{ ticket.nome }} - ${{ value }}</span>   
            <span class="text-center tickets-limit">
				{{ ticket.limite == null ? 'Ilimitado' : ticket.limite }}
            	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de Jogadores"></i>
            </span>       
            <span class="ticket-categories">
            	{{ category.nome }}
            </span>     
		</header>
		<div class="tickets-content" :style="backgroundTicket(ticket.imagem_capa)">
			<div class="row">
				<div :class="verifyCol(ticket.games)" v-for="(game, index) in ticket.games">
					<game-component :game="game" v-on:updateTicket="updateTicket" :index="index"></game-component>
					<br>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-12">
					<button class="btn btn-success btn-md" @click.prevent="openModal">
						{{ trans('strings.to_play') }}
					</button>
					<button class="btn btn-danger btn-md" @click.prevent="openModal">
						{{ trans('strings.to_update') }}
					</button>
				</div>
			</div>
		</div> 		
		<footer class="tickets-footer">
			<div class="row">
				<div class="col-lg-12">
					<em class="text-caption">Termina em: {{ ticket.data_termino }} às {{ ticket.hora_termino }} hrs</em>
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
        	verifyCol(game) {
        		if(game.length > 1) {
        			return 'col-lg-12 col-sm-12 col-md-12 col-12'
        		}
        		return 'col-lg-12 col-sm-12 col-md-12 col-12'
        	},
        	openModal() {
		     	this.$eventBus.$emit('openModal', this.ticket);	
        	},
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
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
					
					if((val.result_out_club === '' || val.result_out_club === null) 
						|| (val.result_house_club === '' || val.result_house_club === null)) {
						complete = false
						
					}
					
					//Se encontrou algum diferente de vazio, é porque a rodada não encontra-se completamente vazia
					if((val.result_out_club !== '' && val.result_out_club !== null) 
						|| (val.result_house_club !== '' && val.result_house_club !== null)) {
						empty = false;
					}

					return true;
				});

				//Se foi completado o preenchimento na rodada
				if(complete === true) {
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

        	//Escutando o close do modal, para atualizar os tickets na tela do usuário
            $('.modal-ticket')
	            .on('hidden.bs.modal', (event) => {
	                this.updateTicket();
	            });

			this.updateTicket();
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
	    padding-bottom: 5px;
	    padding-top: 20px;
	}

	.tickets {
		/*padding: 10px 20px 10px 20px;*/
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
        padding: 15px 25px 15px 25px;
	    border: 1px solid transparent;
	    border-radius: 2px;
	    display: block;
	    text-transform: uppercase;
	}

	.tickets-header .tickets-limit {
		display: block;
	}

	.tickets-header .tickets-name {
	    padding: 11px 24px;
	    display: block;
	    vertical-align: middle;
	    line-height: 17px;
	    font-size: 20px;
	    color: #000
	}
</style>