<style scoped>
	
</style>

<template>
	<div>
		{{ scratch_card.theme.nome }}, {{ trans('strings.ticket')}} #{{ scratch_card.id }}
		<router-link :to="{name: 'users.games', query: {id: scratch_card.order_item_id, page: 1, column: 'created_at', direction: 'asc'}}" class="btn btn-xs btn-primary">
			<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" :title="trans('strings.view')">
			</i>
		</router-link>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['cartoleando']
	}
</script>