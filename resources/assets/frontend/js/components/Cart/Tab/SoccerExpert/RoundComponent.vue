<template>
	<div :id="id" class="collapse">
		<div class="row container-tickets" style="overflow: auto; flex-wrap: nowrap;" @click.prevent="editSoccerExpert(soccer_expert.id, soccer_expert.hash, $event)">
        	<div class="col-lg-5 col-10 col-md-5 col-sm-5" v-for="(round, column) in soccer_expert.rounds">
        		<div :class="'ticket'+column+' tickets'">
        			
        			<div class="tickets-content well">
						<div class="row vcenter text-center">
							<div class="col-lg-12 col-12 col-sm-12 col-md-12">
								<h3>{{ column + 'ª '+ trans('strings.round') }}</h3>
							</div>	
						</div>
						<div class="row vcenter-end text-center" style="margin-bottom: 10px;" v-for="(game, line) in round.games">
							<div class="col-xs-5 col-md-5 col-lg-3 no-padding">
								
								<label class="club">{{ game.house_club.nome }}</label>		
								<img v-if="game.house_club.shields != undefined && game.house_club.shields.length > 0" width="30" height="30" :src="game.house_club.shields[0].dimensao">

								<img v-else width="30" height="30" :src="'https://s.glbimg.com/es/sde/f/equipes/2014/04/14/'+game.house_club.nome.toLowerCase()+'_60x60.png'">
								
							</div>
							<div class="col-lg-2 no-padding">
								<input v-model="game.result_house_club" type="number" class="form-control">
							</div>

							<div class="col-2 col-md-2 col-sm-2 col-lg-1" style="text-align: center">
			                    x
			                </div>

			                <div class="col-lg-2 no-padding">
								<input v-model="game.result_out_club" type="number" class="form-control" name="">
							</div>

			                <div class="col-xs-5 col-md-5 col-lg-3 no-padding">
								
								<label class="club">{{ game.out_club.nome }}</label>
								<img v-if="game.out_club.shields != undefined && game.out_club.shields.length > 0" width="30" height="30" :src="game.out_club.shields[0].dimensao">

								<img v-else width="30" height="30" :src="'https://s.glbimg.com/es/sde/f/equipes/2014/04/14/'+game.out_club.nome.toLowerCase()+'_60x60.png'">

							</div>
						</div>
					</div>
        		</div>
        		
        	</div>
        </div>
	</div>
</template>

<script>
	export default {
		props: ['soccer_expert', 'id'],
		mounted(){

		},
		methods: {
			editSoccerExpert(id, hash, $event) {
				this.$router.push({
					name: 'soccer_expert.show',
					params: {
						id: id,
						hash: hash
					}
				})
			},
		},
		data() {
			return {

			}
		},
	}
</script>

<style scoped>
	.row label {
		display: block;
	}
</style>