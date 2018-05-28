<style scoped>
	
</style>

<template>
	<div>
		{{ soccer_expert_bet.round.nome }}, {{ trans('strings.group') }} #{{ soccer_expert_bet.group.id }}
		<router-link :to="{name: 'users.games', query: {id: soccer_expert_bet.order_item_id, page: 1, column: 'created_at', direction: 'asc'}}" class="btn btn-xs btn-primary">
			<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" :title="trans('strings.view')">
			</i>
		</router-link>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['soccer_expert_bet'],
		mounted() {
		}
	}
</script>