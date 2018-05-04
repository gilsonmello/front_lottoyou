<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		index
	</div>
</template>

<script>
	import LoadComponent from '../Load'
	export default {
 		data: function() {
            return {
                loading: {
                    component: true
                }
            }
        },
		mounted: function() {
            this.loading.component = false;
        },
		methods: {
			
		},
        components: {
            LoadComponent
        }
	}
</script>

<style scoped>
	
</style>