<template>
	<div class="row vcenter text-center games">

		<div class="col-2 col-md-5 col-lg-5" style="padding-left: 0; padding-right: 2px;">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-end;">
				<span style="line-height: 1;">{{ game.house_club.nome }}</span>
				<img v-if="game.house_club.escudo != undefined" style="width: 30px; height: 30px; margin-left: 5px;" :title="game.house_club.nome" :src="game.house_club.escudo">				
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
				{{ game.result_house_club }}
			</span>
            <span class="x">X</span>
            <span class="result">
				{{ game.result_out_club }}
			</span>
        </div>

        <!-- <div class="col-lg-1 col-2 no-padding">
			<input min="0" v-model="game.result_out_club" @change.prevent="outClubResult(index, $event)" type="number" class="form-control no-padding" name="">
		</div> -->

        <div class="col-2 col-md-5 col-lg-5" style="padding-right: 0; padding-left: 2px;">
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<div class="container-club" style="justify-content: flex-start;">
				<img v-if="game.out_club.escudo != undefined" style="width: 30px; height: 30px; margin-right: 5px;" :title="game.out_club.nome" :src="game.out_club.escudo">
				<span style="line-height: 1;">{{ game.out_club.nome }}</span>
			</div>
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
		created: function () {

        },
        mounted: function() {
        	
        },
        activated: function() {
            
        },
        methods: {
        	
        },
        data: function() {
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

	.x {
		font-weight: bold;
		font-size: 16px;
	}
</style>