<style scoped>
	
</style>

<template>
	<div>
		{{ lottery_bet.sweepstake.sorteio }}, {{ trans('strings.ticket') }} #{{ lottery_bet.id }}
		<router-link :to="{name: 'users.games', query: {id: lottery_bet.order_item_id, page: 1, column: 'created_at', direction: 'asc'}}" class="btn btn-xs btn-primary">
			<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" :title="trans('strings.view')">
			</i>
		</router-link>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['balance', 'lottery_bet'],
		mounted() {
			
		}
	}
</script>