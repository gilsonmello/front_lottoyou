<template>
	<div class="row vcenter text-center games no-margin">

		<div class="col-1 col-md-1 col-lg-1 col-sm-1 no-padding">
			<img src="/img/gold_ball.png" class="img-fluid gold-ball" v-if="game.bola_ouro == 1">
		</div>

		<div class="col-4 col-md-5 col-lg-4" style="padding-left: 0; padding-right: 2px;">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-end;">
				<span style="line-height: 1; text-align: right; white-space: nowrap;">{{ game.game.house_club.nome }}</span>
				<img v-if="game.game.house_club.escudo != undefined" style="width: 30px; height: 30px; margin-left: 5px;" :title="game.game.house_club.nome" :src="game.game.house_club.escudo">
			</div>
		</div>

		<!-- <div class="col-lg-1 col-2 no-padding">
			<input min="0" v-model="game.result_house_club" @change.prevent="houseClubResult(index, $event)" type="number" class="form-control no-padding">
		</div> -->

		<!-- <div class="col-2 col-md-2 col-sm-2 col-lg-1 no-padding" style="text-align: center">
            <span class="x">X</span>
        </div> -->

        <div class="col-2 col-md-2 col-sm-2 col-lg-2 no-padding" style="text-align: center">
			<span class="result">
				{{ game.resultado_clube_casa }}
			</span>
            <span class="x">X</span>
            <span class="result">
				{{ game.resultado_clube_fora }}
			</span>
        </div>

        <!-- <div class="col-lg-1 col-2 no-padding">
			<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control no-padding" name="">
		</div> -->

        <div class="col-4 col-md-5 col-lg-4" style="padding-right: 0; padding-left: 2px;">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-start;">
				<img v-if="game.game.out_club.escudo != undefined" style="width: 30px; height: 30px; margin-right: 5px;" :title="game.game.out_club.nome" :src="game.game.out_club.escudo">
				<span style="line-height: 1; flex: 5; text-align: left;">{{ game.game.out_club.nome }}</span>
			</div>
		</div>

		<div class="col-1 col-md-1 col-lg-1 col-sm-1 no-padding">
			<span v-if="game.pontuacao != null"><strong>{{ game.pontuacao }}pts</strong></span>
		</div>

		<!-- <div class="col-lg-12">
            <span><strong class="info-date">{{ game.day }}, {{ game.data }}</strong></span>
            <span><strong class="info-local">{{ game.local }}</strong></span>
        </div> -->

	</div>
</template>

<script>
	export default {
		props: ['game', 'index', 'ticket'],
		created() {

        },
        mounted() {

        },
        activated() {
            
        },
        methods: {
        	
        },
        data() {
        	return {}
        },
        computed: {

        }
	}
</script>

<style scoped>
	input {
		text-align: center;
	}

	span {
		line-height: 1;
	}

	.info-date {
		display: block;
	}

	.info-local {
		display: block;
		font-size: 16px
	}

	.row {
		color: white;
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
	    -webkit-box-flex: 2;
	    -ms-flex: 2;
	    flex: 1;
	    height: 40px;
	    width: 40px;
	}

	.x {
		font-weight: bold;
		font-size: 16px;
	}

	@media (max-width: 576px) {
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