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
							{{ item.tickets.length }} Jogos
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
				<a class="btn btn-xs btn-danger" type="trigger" @click.prevent="removeItem(item, $event)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
				</a>
				<a @click.prevent="" type="load" class="hide btn btn-xs btn-danger">
					<i class="fa fa-refresh fa-spin"></i>
				</a>
			</div>
		</div>


		<div :id="id" class="collapse">
			<div class="container-tickets" style="display: flex;" @click.prevent="editLottery(item.id, item.hash, $event)">
				<ticket-component v-for="(ticket, index) in item.tickets" :tickets="item.tickets" :dickers="dickers" :dickersMaxSel="dickersMaxSel" :dickersExtras="dickersExtras" :item="item" :dickersExtrasSelect="dickersExtrasSelect" :ticket="ticket" :index="index" :key="index">
					
				</ticket-component>
			</div>
		</div>

		<div style="border-bottom: 1px dotted #999;">
			
		</div>		
	</section>
</template>

<script>
	import BetComponent from './Lottery/BetComponent'
	import TicketComponent from './Lottery/TicketComponent'
	import {routes} from '../../../../api_routes'
	export default {
		props: ['item', 'id'],
		data: function() {
			return {
				dickers: [],
				dickersMaxSel: [],
				dickersExtras: [],
				dickersExtrasSelect: []
			}
		},
		mounted() {
		 	for (var i = 1; i <= this.item.lottery.dezena; i++) {
            	this.dickers.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_sel; i++) {
            	this.dickersMaxSel.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_extra; i++) {
            	this.dickersExtras.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_extra_sel; i++) {
            	this.dickersExtrasSelect.push(i);
            }
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
			removeItem(item, event){
				let removeItemRequest = axios.create();

				removeItemRequest.interceptors.request.use(config => {
		        	$(this.$el).find('[type="load"]').removeClass('hide');
		        	$(this.$el).find('[type="trigger"]').addClass('hide');
				  	return config;
				});

				removeItemRequest.delete(routes.carts.destroy.replace('{hash}', item.hash), {
					
				}).then((response) => {
					if(response.status === 200) {
						this.$store.dispatch('removeItemLottery', item)
					}
				}).catch((error) => {

				})
			},
		},
		components: {
			BetComponent,
			TicketComponent
		}
	}
</script>


<style scoped>
	.lotteries:last-child{
		margin-bottom: 0;
	}
	.lotteries {
		padding: 10px 0 10px 0;
	}

	.collapse.show {
		display: flex !important;
	}
</style>