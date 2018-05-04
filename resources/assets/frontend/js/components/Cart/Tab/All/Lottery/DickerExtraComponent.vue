<template>
	<button @click.prevent="clickNumber($event)" :class="verifyNumberSelected()">
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
			'dickersExtrasSelect'
		],
		mounted() {
			
		},
		methods: {
			verifyNumberSelected() {
				//
				for(var i = 0; i < this.ticket.numbersExtras.length; i++) {
					if(this.dicker == this.ticket.numbersExtras[i]) {
						return 'btn btn-xs btn-default-darking btn-checked';
						//continue;
					}
				}		
				return 'btn btn-xs btn-default-darking';				
			},
			clickNumber: function(event) {
				var btn = $(event.target);
				if(btn.hasClass('btn-checked')){
					btn.removeClass('btn-checked');
					this.ticket.numbersExtras = this.ticket.numbersExtras.filter((val) => {
						return val != this.dicker;
					});
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.ticket.numbersExtras.length != this.dickersExtrasSelect.length) {
						btn.addClass('btn-checked');
						this.ticket.numbersExtras.push(this.dicker);
					}
				}				
			},
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