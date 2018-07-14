<style scoped>
	
</style>

<template>
	<div>
		{{ withdraw.name }}, {{ withdraw.bank }}, {{ withdraw.number }}
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