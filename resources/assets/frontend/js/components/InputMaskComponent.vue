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
		props: ['mask', 'ph', 'repeat', 'greedy', 'rightAlign'],
		mounted: function(){
			this.placeholder = this.ph != undefined ? this.ph : " ";
			
			var options = {}

			if(this.mask != undefined) {
				options['mask'] = this.mask;
			}

			if(this.ph != undefined) {
				options['ph'] = this.ph;
			}

			if(this.repeat != undefined) {
				options['repeat'] = this.repeat;
			}

			if(this.greedy != undefined) {
				options['greedy'] = this.greedy;
			}

			if(this.rightAlign != undefined) {
				options['rightAlign'] = this.rightAlign;
			}

			options['showMaskOnHover'] = false
			options['showMaskOnFocus'] = false
			options['onBeforeWrite'] = (event, buffer, caretPos, opts) => {
				if(event.target != undefined){
					this.$emit('input', event.target.value);
				}
			}
			$(this.$el).inputmask(options);
		},
		methods: {

		}
	}
</script>