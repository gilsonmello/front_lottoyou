<template>
	<section class="table-ranking-body">
		
		<div class="row collapsed" data-toggle="collapse" :data-target="'.'+bet.owner_id"> 	
    		<div class="col-lg-2">
	      		{{ index + 1 }}
	      	</div>
	      	<div class="col-lg-2">
	      		<img :src="bet.owner.photo" style="width: 100%; height: 50px;">
	      	</div>
	      	<div class="col-lg-2">
	      		{{ bet.owner.nickname }}
	      	</div>
	      	<div class="col-lg-2">
	      		{{ bet.pontuacao }}
	      	</div>
        </div>

        <div :class="'collapse '+bet.owner_id">
			<load-component v-if="loading.game"></load-component>	    	
			<vc-game></vc-game>
		</div>
	</section>
</template>

<script>
	import VcGame from './VcGame'
	export default {
		props: ['index', 'bet'],
		data() {
			return {
				loading: {
					game: false
				},
			}
		},
		mounted() {
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.bet.owner_id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.bet.owner_id).on('show.bs.collapse', (event) => {
					  	this.loading.game = true;
					  	const gameRequest = axios.create();
					  	gameRequest.interceptors.request.use(config => {
							return config;
						});

						let url = routes.soccer_rounds.groups.replace('{round_id}', this.ticket.id);

						gameRequest.get(url, {}, {}).then(response => {
							if(response.status === 200) {
								this.groups = response.data;
								this.loading.game = false;
							}
						}).catch((error) => {
							this.loading.game = false;
						});
					});

					$(this.$el).find('.'+this.bet.owner_id).on('hide.bs.collapse', (event) => {
						this.groups = []
					})
				}
			});
		},
		components: {
			VcGame
		}
	}
</script>

<style scoped>
	.table-ranking-body {
		padding-bottom: 10px;
		padding-top: 10px;
	}
</style>