<style scoped>
	
</style>

<template>
	<div>
		{{ balance.message }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes';
	export default {
		props: ['balance', 'team'],
		mounted () {
			
		}
	}
</script>