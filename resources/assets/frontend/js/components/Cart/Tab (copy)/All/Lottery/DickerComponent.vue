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
			'dickersMaxSel'
		],
		mounted() {
			
		},
		methods: {
			verifyNumberSelected() {
				//
				for(var i = 0; i < this.ticket.numbers.length; i++) {
					if(this.dicker == this.ticket.numbers[i]) {
						return 'btn btn-xs btn-default-color btn-checked';
						//continue;
					}
				}		
				return 'btn btn-xs btn-default-color';		
			},
			clickNumber: function(event) {
				var btn = $(event.target);
				
				//Se o botão está selecionado
				if(btn.hasClass('btn-checked')){
					//Removo a seleção
					btn.removeClass('btn-checked');
					//Removo o número do array
					this.ticket.numbers = this.ticket.numbers.filter((val) => {
						return val != this.dicker;
					});
					
				} else {
					//Verifica se já selecionou todos as dezenas
					if(this.ticket.numbers.length != this.dickersMaxSel.length) {
						//Adiciono a seleção
						btn.addClass('btn-checked');
						//Adiciono no array
						this.ticket.numbers.push(this.dicker);
					}
				}

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