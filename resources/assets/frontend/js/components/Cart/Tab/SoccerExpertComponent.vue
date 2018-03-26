<template>
	<section>
		<div v-for="(item, index) in items" v-if="items.length > 0">
			<div class="row vcenter" :href="'#soccer_expert_'+index" data-toggle="collapse">
				<div class="col-lg-2 col-md-2 col-2 col-sm-2">
					<img class="img-fluid" src="http://www.lottoland.com/pt/skins/lottoland/images/lotteryLogos/lt-elGordoPrimitiva.x2-bc4cde5fe7329ee5.png">
				</div>
				<div class="col-lg-8 col-5 col-md-7 col-sm-6">
					<div class="row">
						<div class="col-lg-12 col-12 col-md-12 col-sm-12">
							<span>{{ item.soccer_expert.nome }}</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-12 col-md-12 col-sm-12">
							<span>
								{{ item.rounds.length }} Jogos
							</span>
						</div>
					</div>
				</div>

				<div class="col-lg-1 col-3 col-md-2 col-sm-2">
					<span>
						$ {{ (item.total).format(2, true) }}
					</span>
				</div>

				<div class="col-lg-1 col-2 col-md-1 col-sm-2">
					<a class="btn btn-xs btn-danger" @click.prevent="removeItemSoccerExpert(item)" href="#" style="cursor:pointer;">
						<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
					</a>
				</div>
			</div>
			<round-component :id="'soccer_expert_'+index" :soccer_expert="item"></round-component>
		</div>
	</section>
</template>

<script>
	import RoundComponent from './SoccerExpert/RoundComponent'
	import {routes} from '../../../api_routes'
	import {mapState, mapGetters} from 'vuex'
	export default {
		props: ['items', 'id'],
		data: function() {
			return {
				
			}
		},
		mounted: function() {
		},
		methods: {
			removeItemSoccerExpert(item){
				this.$store.dispatch('removeItemSoccerExpert', item)
				let removeItemRequest = axios.create();
				removeItemRequest.delete(routes.carts.destroy.replace('{hash}', item.hash), {
					
				}).then((response) => {
					if(response.status === 200) {
						
					}
				}).catch((error) => {

				})
			},
		},
		components: {
			RoundComponent
		}
	}
</script>


<style scoped>
	
</style>