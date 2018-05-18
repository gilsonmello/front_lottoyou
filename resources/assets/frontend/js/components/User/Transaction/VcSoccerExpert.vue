<style scoped>
	
</style>

<template>
	<div>
		{{ soccer_expert_bet.round.nome }}, {{ trans('strings.group') }} #{{ soccer_expert_bet.group.id }}
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