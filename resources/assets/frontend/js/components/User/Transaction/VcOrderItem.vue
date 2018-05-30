<style scoped>
	
</style>

<template>
	<div>
		<span v-if="order_item.scratch_card">
			{{ order_item.scratch_card.nome }}, Qtd. {{ typeof order_item.data == 'object' ? order_item.data.scratch_card.discount_tables.quantity : '' }}
		</span>
		<span v-else-if="order_item.soccer_expert">
			{{ order_item.soccer_expert.nome }}, Qtd. {{ typeof order_item.data == 'object' ? order_item.data.tickets.length : '' }}
		</span>
		<span v-else-if="order_item.lottery">
			{{ order_item.lottery.nome }}, Qtd. {{ typeof order_item.data == 'object' ? order_item.data.tickets.length : '' }}
		</span>
		<router-link :to="{name: 'users.games', query: {id: order_item.id, page: 1, column: 'created_at', direction: 'asc'}}" class="btn btn-xs btn-primary">
			<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" :title="trans('strings.view')">
			</i>
		</router-link>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['order_item'],
		mounted() {
			this.order_item.data = JSON.parse(this.order_item.data);
		}
	}
</script>