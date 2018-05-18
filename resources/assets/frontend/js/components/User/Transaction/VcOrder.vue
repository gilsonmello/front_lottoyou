<style scoped>
	
</style>

<template>
	<div>
		Clique no botão para visualizar os itens da compra&nbsp;
		<router-link class="btn btn-xs btn-primary" :to="{ name: 'orders.show', params: { id: order.id } }">
	        <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" :title="trans('strings.view')"></i>
	    </router-link>

	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['order']
	}
</script>