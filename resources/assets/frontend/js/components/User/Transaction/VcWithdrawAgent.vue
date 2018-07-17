<style scoped>
	
</style>

<template>
	<div>
		{{ withdraw.name }}, {{ withdraw.bank }}, {{ withdraw.number }}, {{ withdraw.finished == 0 ? trans('strings.in_progress') : trans('strings.is_finished') }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		name: "VcWidraw",
		props: ['withdraw'],
		mounted() {
		}
	}
</script>