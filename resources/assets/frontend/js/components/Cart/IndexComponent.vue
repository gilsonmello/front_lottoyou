<template>
	<div class="container-fluid">
		<h1 class="page-header">{{ trans('strings.cart') }}</h1>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12 text-center">
				<img class="img-fluid" src="https://www.lottoland.com/pt/skins/lottoland/images/checkOut/add_ticket-a9b87d1ccaa94550.jpg" v-if="purchase.count == 0">
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				purchase: {
					scratch_cards: {
						items: []
					},
					soccer_expert: {
						items: []
					},
					lotteries: {
						items: []
					},
					count: 0,
					total: 0.00,
					created_at: '',
					updated_at: ''
				}
			}
		}
	}
</script>

<style scoped>
	
</style>