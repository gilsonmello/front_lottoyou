<template>
	<section>
		<div class="vcenter lotteries no-padding" :href="'#'+id" data-toggle="collapse">
			<div class="col-lg-2 col-md-2 col-2 col-sm-2">
				<img class="img-fluid" :alt="item.lottery.nome" :src="item.lottery.img_loteria">
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
				<a class="btn btn-xs btn-danger" @click.prevent="removeItem(item)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
				</a>
			</div>
		</div>


		<div :id="id" class="collapse">
			<div class="container-tickets" style="display: flex;" @click.prevent="editLottery(item.id, item.hash, $event)">
				<div :style="column == 0 ? 'margin: 0 5px 0 15px;' : 'margin: 0 5px 0 5px;'" class="no-padding col-lg-2 col-10 col-md-5 col-sm-5" v-for="(bet, column) in item.betting">
					<bet-component :id="id" :bet="bet" :column="column" :lottery="item"></bet-component>
				</div>
			</div>
		</div>

		<div style="border-bottom: 1px dotted #999;">
			
		</div>		
	</section>
</template>

<script>
	import BetComponent from './Lottery/BetComponent'
	import {routes} from '../../../../api_routes'
	export default {
		props: ['item', 'id'],
		data: function() {
			return {
				dickers: []
			}
		},
		mounted: function() {
			
		},
		methods: {
			editLottery(id, hash, $event) {
				this.$router.push({
					name: 'lotteries.show',
					params: {
						id: id,
						hash: hash
					}
				})
			},
			removeItem(item){
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
	}

	.collapse.show {
		display: flex !important;
	}
</style>