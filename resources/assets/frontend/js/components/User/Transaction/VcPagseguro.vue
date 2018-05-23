<style scoped>
	
</style>

<template>
	<div>
		{{ trans('strings.deposit') }} #{{ pagseguro.balance_order_id }}, {{ trans('strings.'+pagseguro.status) }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['pagseguro'],
		mounted() {
		}
	}
</script>