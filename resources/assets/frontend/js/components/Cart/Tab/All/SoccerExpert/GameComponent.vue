<template>
	<div class="row vcenter text-center">

		<div class="col-lg-12">
			<span><strong>{{ game.local }} {{ game.data }}</strong></span>
		</div>

        <div class="col-2 col-md-5 col-lg-2 no-padding">
			<!-- <span style="display: block;">{{ game.house_club.nome }}</span> -->
			<img v-if="game.house_club != undefined" style="width: 30px; height: 30px" :title="game.house_club.nome" :src="game.house_club.escudo">			
		</div>

	 	<div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_house_club" type="text" class="form-control">
		</div> 

		<div class="col-2 col-md-2 col-sm-2 col-lg-2" style="text-align: center">
            <span class="x">X</span>
        </div>

        <div class="col-lg-2 col-2 no-padding">
			<input min="0" v-model="game.result_out_club" type="text" class="form-control" name="">
		</div>

        <div class="col-2 col-md-5 col-lg-2 no-padding">
			<!-- <span style="display: block;">{{ game.out_club.nome }}</span> -->
			<!-- <label class="club">{{ game.out_club.nome }}</label> -->
			<img v-if="game.out_club.escudo != undefined" style="width: 30px; height: 30px" :title="game.out_club.nome" :src="game.out_club.escudo">
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
		justify-content: center;
	}

	.x {
		font-weight: bold;
		font-size: 16px;
	}
</style>