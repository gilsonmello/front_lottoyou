<template>
	<div class="row text-center games no-margin">

		<div class="col-lg-2 no-mobile" style="justify-content: center;" v-if="position == 'left'">
			<img v-if="ticket.gold_ball_game_id != game.id" @click.prevent="goldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball" style="opacity: 0.5;">				
			<img v-if="ticket.gold_ball_game_id == game.id" @click.prevent="changeGoldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball">			
		</div>

		<div class="col-lg-2 mobile" style="justify-content: center;">
			
			<img v-if="ticket.gold_ball_game_id != game.id" @click.prevent="goldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball" style="opacity: 0.5;">				

			<img v-if="ticket.gold_ball_game_id == game.id" @click.prevent="changeGoldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball">			
				
		</div>

		<div class="col-lg-10 col-12 no-padding">
			<div class="row no-margin vcenter">
				<div class="col-4 col-sm-4 col-md-4 col-lg-4">
					<!-- <label class="club">{{ game.out_club.nome }}</label> -->
					<div class="container-club" style="justify-content: flex-end;">
						<span style="line-height: 1; flex: 5; text-align: right;">{{ game.house_club.nome }}</span>
						<img class="shield-img" v-if="game.house_club.escudo != undefined" style="margin-left: 5px;" :title="game.house_club.nome" :src="game.house_club.escudo">				
					</div>
				</div>


				<div class="col-4 col-sm-3 col-md-4 col-lg-3 no-padding" style="text-align: center">
					<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(index, $event)" type="number" class="form-control no-padding">
		            <span class="x">X</span>
		            <input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control no-padding">
		        </div>


				<!-- <div class="col-lg-1 col-2 no-padding">
					<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(index, $event)" type="number" class="form-control no-padding">
				</div>

				<div class="col-2 col-md-2 col-sm-2 col-lg-1 no-padding" style="text-align: center">
		            <span class="x">X</span>
		        </div>

		        <div class="col-lg-1 col-2 no-padding">
					<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control no-padding">
				</div> -->

		        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
					<!-- <label class="club">{{ game.out_club.nome }}</label> -->
					<div class="container-club" style="justify-content: flex-start;">
						<img class="shield-img" v-if="game.out_club.escudo != undefined" style="margin-right: 5px;" :title="game.out_club.nome" :src="game.out_club.escudo">
						<span style="line-height: 1; flex: 5; text-align: left;">{{ game.out_club.nome }}</span>
			
					</div>
				</div>
				<div class="col-lg-12">
		            <span><strong class="info-date">{{ game.day }}, {{ game.data }}</strong></span>
		            <span><strong class="info-local">{{ game.local }}</strong></span>
		        </div>
			</div>
		</div>

		<div class="col-lg-2 no-mobile" style="justify-content: center;" v-if="position == 'right'">
			
			<img v-if="ticket.gold_ball_game_id != game.id" @click.prevent="goldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball" style="opacity: 0.5;">				
				

			<img v-if="ticket.gold_ball_game_id == game.id" @click.prevent="changeGoldBall($event)" src="/img/gold_ball.png" class="img-fluid gold-ball">			
				
		</div>
		
	</div>
</template>

<script>
	export default {
		props: ['game', 'index', 'ticket', 'position'],
		created: function () {

        },
        mounted: function() {
        	this.game.result_house_club = this.game.result_house_club != '' ? this.game.result_house_club : ''
        	this.game.result_out_club = this.game.result_out_club != '' ? this.game.result_out_club : '';
        },
        activated: function() {
            
        },
        methods: {
        	changeGoldBall(event) {
				this.ticket.games.forEach((value) => {
        			value.bola_ouro = false;
				});
	        	this.ticket.choseGoldBall = false;
	        	this.ticket.gold_ball_game_id = null;
	        	this.$eventBus.$emit('chooseGoldBall', false);
        	},
        	goldBall(event) {
        		this.ticket.games.forEach((value) => {
        			value.bola_ouro = false;
				});
	        	this.game.bola_ouro = true;
	        	this.ticket.choseGoldBall = true;
	        	this.$eventBus.$emit('chooseGoldBall', true);
	        	this.ticket.gold_ball_game_id = this.game.id;
        	},
        	houseClubResult: function(index, event) {		        

				//Pegando o valor informado pelo usuário
				var input = $(event.currentTarget);

				if(input.val() < 0) {
					input.val(input.val() * -1)
				}

				if(input.val() >= 10) {
					swal({
					  	title: 'Deseja continuar?',
					  	text: "Número maior do que 10!",
					  	type: 'warning',
					  	showCancelButton: true,
					  	confirmButtonColor: '#3085d6',
					  	cancelButtonColor: '#d33',
					  	confirmButtonText: 'Sim',
					  	cancelButtonText: 'Desfazer'
					}).then((result) => {
					  	if(result.dismiss) {
				  			input.val("");
					  	}	
						this.game.result_house_club = input.val();
						this.$emit('updateTicket');
					});
				} else {
					this.game.result_house_club = input.val();
					this.$emit('updateTicket');
				}
	            //this.$emit('houseClubResult', this.game, index);

			},
			//Column = rodada disponível no array
			//Line = jogo da roda disponível no array
			outClubResult: function(index, event) {
				var input = $(event.currentTarget);
				
				if(input.val() < 0)
					input.val(input.val() * -1)
				
				if(input.val() >= 10) {
					swal({
					  	title: 'Deseja continuar?',
					  	text: "Número maior do que 10!",
					  	type: 'warning',
					  	showCancelButton: true,
					  	confirmButtonColor: '#3085d6',
					  	cancelButtonColor: '#d33',
					  	confirmButtonText: 'Sim',
					  	cancelButtonText: 'Desfazer'
					}).then((result) => {
					  	if(result.dismiss) {
				  			input.val("");
					  	}	
						this.game.result_house_club = input.val();
						this.$emit('updateTicket');
					});
				} else {
					this.game.result_house_club = input.val();
					this.$emit('updateTicket');
				}
				//this.$emit('outClubResult', this.game, index);
			},
        },
        data: function() {
        	return {}
        },
        computed: {

        },
        watch: {
        }
	}
</script>

<style scoped>

	.shield-img {
		width: 40px; 
		height: 40px; 
	}

	input {
		text-align: center;
	}

	span {
		line-height: 1.2;
	}

	.info-date {
		display: block;
		margin-top: 3px;
	}

	.info-local {
		display: block;
		font-size: 12px
	}

	.row {
		color: white;
		justify-content: center;
		align-items: center;
	}

	.games {
		margin-bottom: 10px;
		align-items: flex-start;
	}
	
	.container-club {
		display: flex; 
		align-items: center; 
	}

	.result {
		font-weight: bold;
		font-size: 22px;
	}

	.gold-ball {
		font-size: 30px;
	    color: gold;
	    line-height: 1;
	    cursor: pointer;
	    margin-right: 5px;
	    height: 40px;
	    width: 40px;
	}

	.x {
		font-weight: bold;
		font-size: 16px;
		display: inline-block;
	}

	.form-control {
		display: inline-block;
    	width: 40px;
	}

	@media (min-width: 768px) and (max-width: 992px) {
		.container-club .shield-img {
			height: 20px;
			width: 20px;
		}
		.container-club span {
			font-size: 12px;
		}
		.gold-ball {
			height: 30px;
			width: 30px;
		}
	}

	@media (min-width: 576px) and (max-width: 768px) {

	}

	@media (max-width: 576px) {
		.container-club .shield-img {
			height: 20px;
			width: 20px;
		}
		.container-club span {
			font-size: 10px;
		}
		.container-club {
			justify-content: space-around;
		}

		.gold-ball {
			height: 30px;
			width: 30px;
		}
	}
</style>