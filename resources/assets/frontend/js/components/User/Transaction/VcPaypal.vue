<style scoped>
	
</style>

<template>
	<div>
		{{ trans('strings.deposit') }} #{{ paypal.balance_order_id }}, {{ trans('strings.'+paypal.payment_status) }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['paypal'],
		mounted() {
		}
	}
</script>