<style scoped>
	
</style>

<template>
	<div>
		{{ scratch_card.theme.nome }}, {{ trans('strings.ticket')}} #{{ scratch_card.id }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		props: ['scratch_card']
	}
</script>