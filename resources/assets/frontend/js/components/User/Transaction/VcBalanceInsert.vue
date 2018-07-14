<style scoped>
	
</style>

<template>
	<div>
		${{ insert.value }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	export default {
		name: "VcBalanceInsert",
		props: ['insert'],
		mounted() {
		}
	}
</script>