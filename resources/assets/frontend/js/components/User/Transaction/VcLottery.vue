<style scoped>
	
</style>

<template>
	<div>
		{{ lottery_bet.sweepstake.sorteio }}, {{ trans('strings.ticket') }} #{{ lottery_bet.id }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['lottery_bet'],
		mounted() {
		}
	}
</script>