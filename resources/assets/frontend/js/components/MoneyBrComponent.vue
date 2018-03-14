<template>
	<input type="text" class="form-control">
</template>

<script>
	export default {
		watch: {
			mask: function (value) {
				
			},
			ph: function(value){
				
			}
		},
		data(){
			return {
				placeholder: ''
			}
		},
		props: [],
		mounted: function() {
			var vm = this;
			$(this.$el).maskMoney({
		        thousands: '.',
		        decimal: ',',
		        affixesStay: false,
		        allowZero: true,
		        prefix: 'R$ ',
		    }).on('change', function(event) {
		    	vm.$emit('input', event.target.value);
		    });
		},
		methods: {

		}
	}
</script>

<style scoped>
	
</style>