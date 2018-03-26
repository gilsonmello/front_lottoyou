<template>
	<section>
		<div v-for="(item, index) in items" v-if="items.length > 0">
			<div class="row vcenter lotteries" :href="'#lottery_'+index" data-toggle="collapse">
				<div class="col-lg-2 col-md-2 col-2 col-sm-2">
					<img class="img-fluid" src="http://www.lottoland.com/pt/skins/lottoland/images/lotteryLogos/lt-elGordoPrimitiva.x2-bc4cde5fe7329ee5.png">
				</div>
				<div class="col-lg-8 col-5 col-md-7 col-sm-6">
					<div class="row">
						<div class="col-lg-12 col-12 col-md-12 col-sm-12">
							<span>{{ item.lottery.nome }}</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-12 col-md-12 col-sm-12">
							<span>
								{{ item.betting.length }} Jogos
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-12 col-md-12 col-sm-12">
							<span>
								Sorteio: {{ item.sweepstake.data_fim }}
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
					<a class="btn btn-xs btn-danger" @click.prevent="removeItemLottery(item)" href="#" style="cursor:pointer;">
						<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
					</a>
				</div>
			</div>
			<bet-component :id="'lottery_'+index" :lottery="item"></bet-component>
		</div>
	</section>
</template>

<script>
	import BetComponent from './Lottery/BetComponent'
	import {routes} from '../../../api_routes'
	import {mapState, mapGetters} from 'vuex'
	export default {
		props: ['items', 'id'],
		data: function() {
			return {
				dickers: []
			}
		},
		mounted: function() {
			console.log(this.items)
		},
		methods: {
			removeItemLottery(item){
				this.$store.dispatch('removeItemLottery', item)

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
			BetComponent
		}
	}
</script>


<style scoped>
	.lotteries:last-child{
		margin-bottom: 0;
	}
	.lotteries {
		margin-bottom: 10px;
		padding: 10px 0 10px 0;
	    border-bottom: 1px dotted #999;
	}
</style>