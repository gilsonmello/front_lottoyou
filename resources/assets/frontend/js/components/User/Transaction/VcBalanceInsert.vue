<style scoped>
	
</style>

<template>
	<div>
		{{getSystemCurrency.data.symbol}}{{ insert.value }}
	</div>
</template>

<script>
	import {routes} from '../../../api_routes';
	import {mapGetters} from 'vuex';
	export default {
		name: "VcBalanceInsert",
		props: ['insert'],
		mounted() {
		},
		computed: {
            ...mapGetters([
				'getSystemCurrency'
            ])
        },
	}
</script>