<template>
	<section>
		<div class="row vcenter" :href="'#lottery_'+id" data-toggle="collapse">
			<div class="col-lg-2 col-md-2 col-2 col-sm-2">
				<img class="img-fluid" src="http://www.lottoland.com/pt/skins/lottoland/images/lotteryLogos/lt-elGordoPrimitiva.x2-bc4cde5fe7329ee5.png">
			</div>
			<div class="col-lg-8 col-5 col-md-7 col-sm-6">
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>{{ items.lottery.nome }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>
							{{ items.betting.length }} Jogos
						</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>
							Sorteio: {{ items.sweepstake.data_fim }}
						</span>
					</div>
				</div>
			</div>

			<div class="col-lg-1 col-3 col-md-2 col-sm-2">
				<span>
					$ {{ (items.total).format(2, true) }}
				</span>
			</div>

			<div class="col-lg-1 col-2 col-md-1 col-sm-2">
				<a class="btn btn-xs btn-danger" @click.prevent="removeItemLottery(items)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
				</a>
			</div>
		</div>
		<bet-component :id="'lottery_'+id" :lottery="items"></bet-component>		
	</section>
</template>

<script>
	import BetComponent from './BetComponent'
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
			removeItemLottery(lottery){
				this.$store.dispatch('removeItemLottery', lottery)
			},
		},
		components: {
			BetComponent
		}
	}
</script>


<style scoped>
	.btn {
		display: block;
	}
</style>