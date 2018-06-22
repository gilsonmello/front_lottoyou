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
			'ticket',
			'dickersMaxSel',
			'result'
		],
		mounted() {
			
		},
		methods: {
			verifyNumberSelected() {
				//
				for(var i = 0; i < this.ticket.numbers.length; i++) {
					if(this.dicker == this.ticket.numbers[i].numero && this.ticket.numbers[i].acerto == 1) {
						return 'btn btn-xs btn-success';
						//continue;
					}

					if(this.dicker == this.ticket.numbers[i].numero) {
						return 'btn btn-xs btn-default-color btn-checked';
					}
				}	
				return 'btn btn-xs btn-default-color';		
			}
		}
	}
</script>

<style scoped>
	.btn-hit {
		backgroud-color: green;
	}

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