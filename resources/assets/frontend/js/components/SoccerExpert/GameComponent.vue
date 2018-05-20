<template>
	<div class="row vcenter text-center games">
		<div class="col-2 col-md-5 col-lg-5">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-end;">
				<span style="line-height: 1; text-align: right;">{{ game.house_club.nome }}</span>
				<img v-if="game.house_club.escudo != undefined" width="30" height="30" style="margin-left: 5px;" :title="game.house_club.nome" :src="game.house_club.escudo">				
			</div>
		</div>

		<!-- <div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(index, $event)" type="number" class="form-control">
		</div> -->

		<div class="col-2 col-md-2 col-sm-2 col-lg-1 no-padding" style="text-align: center">
            <span class="x">X</span>
        </div>

        <!-- <div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control" name="">
		</div> -->

		
        <div class="col-2 col-md-5 col-lg-5">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-start;">
				<img v-if="game.out_club.escudo != undefined"  width="30" height="30" style="margin-right: 5px;" :title="game.out_club.nome" :src="game.out_club.escudo">
				<span style="line-height: 1; text-align: left;">{{ game.out_club.nome }}</span>
			</div>
		</div>
				
	</div>
</template>

<script>
	export default {
		props: ['game', 'index', 'ticket'],
		created: function () {
				
        },
        mounted: function() {
        	this.game.result_house_club = this.game.result_house_club != '' ? this.game.result_house_club : ''
        	this.game.result_out_club = this.game.result_out_club != '' ? this.game.result_out_club : '';
        	this.$set(this.game, 'bola_ouro', false);
		},
        activated: function() {
            
        },
        methods: {
        	houseClubResult: function(index, event) {		        

				//Pegando o valor informado pelo usuário
				var input = $(event.currentTarget);

				if(input.val() < 0)
					input.val(input.val() * -1)

	            //this.$emit('houseClubResult', this.game, index);

	            this.game.result_house_club = input.val();

	            this.$emit('updateTicket');
			},
			//Column = rodada disponível no array
			//Line = jogo da roda disponível no array
			outClubResult: function(index, event) {
				var input = $(event.currentTarget);
				
				if(input.val() < 0)
					input.val(input.val() * -1)

				this.game.result_out_club = input.val();

	            this.$emit('updateTicket');
				//this.$emit('outClubResult', this.game, index);
			},
        },
        data: function() {
        	return {}
        },
        computed: {

        }
	}
</script>

<style scoped>
	.row {
		justify-content: center;
		align-items: center;
	}

	.games{
		margin-bottom: 5px;
	}
	
	.container-club {
		display: flex; 
		align-items: center; 
	}

	.x {
		font-weight: bold;
		font-size: 16px;
	}
</style>