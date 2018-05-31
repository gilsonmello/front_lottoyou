<template>
	<button :class="verifyNumberSelected()">
		{{ dicker }}
	</button>
</template>

<script>
	export default {
		props: [
			'index',
			'dicker',
			'item',
			'tickets',
			'ticket',
			'dickersExtrasSelect',
			'result'
		],
		mounted() {
			
		},
		methods: {
			verifyNumberSelected() {
				//
				for(var i = 0; i < this.ticket.numbers_extras.length; i++) {
					if(this.dicker == this.ticket.numbers_extras[i].numero && this.ticket.numbers_extras[i].acerto == 1) {
						return 'btn btn-xs btn-success';
						//continue;
					}
					if(this.dicker == this.ticket.numbers_extras[i]) {
						return 'btn btn-xs btn-default-darking btn-checked';
						//continue;
					}
				}		
				return 'btn btn-xs btn-default-darking';				
			}
		}
	}
</script>

<style scoped>
	.btn-xs {
        margin: 2px;
        width: 28px;
        height: 28px;
        font-size: 12px;
        
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        -webkit-transition: -webkit-box-shadow 0.15s ease-out;
        -moz-transition: -moz-box-shadow 0.15s ease-out;
        -o-transition: -o-box-shadow 0.15s ease-out;
        transition: box-shadow 0.15s ease-out;
        padding: 0;
    }
</style>