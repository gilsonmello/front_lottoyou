<template>
	<input type="text" class="form-control date datetimepicker-input" data-toggle="datetimepicker" data-target=".date">
</template>

<script>
	export default {
		watch: {
			
		},
		data(){
			return {
				
			}
		},
		props: ['options'],
		mounted() {
			var vm = this
			
			$('.date').datetimepicker({
				locale: 'pt-br'
			});

			$('.date').on('change.datetimepicker', function(event) {
				vm.$emit('input', event.target.value);
			});

			$('.date').on('show.datetimepicker', function(event) {

			});

			$('.date').on('hide.datetimepicker', function(event) {
				
			});
		},
		methods: {

		}
	}
</script>

<style scoped>
	
</style>