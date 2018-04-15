<template>
	<div class="row vcenter text-center">
        <div class="col-lg-12">
            <strong>{{ game.data }}</strong> &nbsp; {{ game.local }}
        </div>
        
		<div class="col-3 col-md-3 col-lg-3 no-padding">
			<label class="club">{{ game.house_club.abreviacao }}</label>
			<img v-if="game.house_club != undefined" style="width: 30px; height: 30px" :title="game.house_club.nome" :src="game.house_club.escudo">			
		</div>

		<div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(index, $event)" type="number" class="form-control">
		</div>

		<div class="col-2 col-md-2 col-sm-2 col-lg-2" style="text-align: center">
            <span class="x">X</span>
        </div>

        <div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control" name="">
		</div>

        <div class="col-3 col-md-3 col-lg-3 no-padding">
			
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<img v-if="game.out_club.escudo != undefined" style="width: 30px; height: 30px" :title="game.out_club.nome" :src="game.out_club.escudo">
			<label class="club">{{ game.out_club.abreviacao }}</label>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['game', 'index'],
		created: function () {

        },
        mounted: function() {
        	
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
		color: white;
	}

	.x {
		font-weight: bold;
		font-size: 16px;
	}
</style>