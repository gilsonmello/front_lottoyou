<template>
	<section>
		<div class="vcenter scratch_cards">
			<div class="col-lg-2 col-md-2 col-2 col-sm-2">
				<img class="img-fluid" :src="src(item.scratch_card.img_card_url)">
			</div>
			<div class="col-lg-8 col-5 col-md-7 col-sm-6">
				<div class="row">
					<div class="col-lg-12">
						<span>{{ item.scratch_card.nome }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<span>
							{{ item.scratch_card.discount_tables.quantity }} {{ trans('strings.scratch_cards') }}
						</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<span>Imediatamente jogável</span>
					</div>
				</div>
			</div>

			<div class="col-lg-1 col-3 col-md-2 col-sm-2">
				<span>
					$ {{ (item.total).format(2, true) }}
				</span>
			</div>

			<div class="col-lg-1 col-2 col-md-1 col-sm-2">
				<a class="btn btn-xs btn-danger" v-if="!loading.delete" @click.prevent="removeItem(item, $event)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')"></i>
				</a>
				<a @click.prevent="" v-else class="btn btn-xs btn-danger">
					<i class="fa fa-refresh fa-spin"></i>
				</a>
			</div>
			<!-- <div class="col-lg-12">
				<table class="table">
					<thead>
						<th></th>
						<th>{{ trans('strings.scratch_cards') }}</th>
						<th>{{ trans('strings.quantity') }}</th>
						<th>{{ trans('strings.value') }}</th>
						<th>{{ trans('strings.actions') }}</th>
					</thead>
					<tbody>
						<tr v-for="scratch_cards in purchase.scratch_cards.items">
							<td>
								<img height="124" width="124" :src="app.basePath+scratch_cards.scratch_card.img_card_url">
							</td>
							<td>{{ scratch_cards.scratch_card.nome }}</td>
							<td>{{ scratch_cards.scratch_card.discount_tables.quantity }}</td>
							<td>$ {{ scratch_cards.scratch_card.value }}</td>
							<td>
								<a class="btn btn-xs btn-primary" @click.prevent="" href="#">
									<i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></i>
								</a>
								<a class="btn btn-xs btn-danger" @click.prevent="" href="#" style="cursor:pointer;">
									<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar"></i>
							</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div> -->
		</div>
		<div style="border-bottom: 1px dotted #999;">
				
		</div>	
	</section>
</template>

<script>
	import {routes} from '../../../../api_routes'
	export default {
		props: ['item'],
		mounted: function() {
			
		},
		data() {
			return {
				loading: {
					delete: false
				},
			}
		},
		methods: {
			removeItem(item){
				let removeItemRequest = axios.create();

				removeItemRequest.interceptors.request.use(config => {
					this.loading.delete = true;
				  	return config;
				});

				removeItemRequest.delete(routes.carts.destroy.replace('{hash}', item.hash), {
					
				}).then((response) => {
					if(response.status === 200) {
						this.$store.dispatch('removeItemScratchCard', item)
					}
					this.loading.delete = false;
				}).catch((error) => {
					this.loading.delete = false;
				})
			},
		}
	}
</script>


<style scoped>
	.scratch_cards:last-child{
		margin-bottom: 0;
	}
	.scratch_cards {
		padding: 10px 0 10px 0;
	}
</style>