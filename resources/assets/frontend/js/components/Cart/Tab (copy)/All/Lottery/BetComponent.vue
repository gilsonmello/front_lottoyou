<template>
	<div :class="'ticket'+column+' tickets'">
		<!-- <div class="tickets-header">
			<strong>&nbsp;</strong>
			<div class="tools">
				<a class="" href="#" @click.prevent="selectRandom(column, $event)">
					<i class="fa fa-random"></i>
				</a>
				<a class="" href="#" @click.prevent="deleteNumbersChecked(column, $event)">
					<i class="fa fa-close"></i>
				</a>
			</div>
		</div> -->
		<div class="tickets-content">
			<span class="fields" v-for="dicker in lottery.dickers">
				
				<button v-if="verifyNumberSelected(bet.numbers, dicker)" class="btn btn-xs btn-default-color btn-checked">
					{{ dicker }}
				</button>

				<button v-else class="btn btn-xs btn-default-color">
					{{ dicker }}
				</button>

			</span>
		</div>
		<div class="tickets-extras">
			<span class="fields" v-for="dicker in lottery.dickersExtras">
				<button v-if="verifyNumberSelected(bet.numbersExtras, dicker)" class="btn btn-xs btn-default-darking btn-checked">
					{{ dicker }}
				</button>
				<button v-else class="btn btn-xs btn-default-darking">
					{{ dicker }}
				</button>
			</span>
		</div>
		<!-- <div class="tickets-footer">
			<em class="text-caption">
        		Dezenas restantes - 
    			<input v-model="bet.numbers.length - lottery.dickersMaxSelect.length" name="data[LotUserJogo][qtdNumeros1]" id="qtdNumeros1" type="text" disabled>
    			<input v-model="bet.numbersExtras.length - lottery.dickersExtrasMaxSelect.length" name="data[LotUserJogo][qtdNumerosd1]" id="qtdNumerosd1" disabled type="text">
    		</em>
		</div> -->
	</div>
</template>

<script>
	export default {
		props: ['id', 'lottery', 'bet', 'column'],
		mounted: function() {
			
		},
		methods: {
			//Função para verificar comparar os números que o usuário selecionou com as dezenas
			verifyNumberSelected(numbers, dicker) {
				//
				for(var i = 0; i < numbers.length; i++) {
					if(dicker == numbers[i]) {
						return true;
						continue;
					}
				}
			}
		},
		data: function() {
			return {

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
        border-radius: 999px !important;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        -webkit-transition: -webkit-box-shadow 0.15s ease-out;
        -moz-transition: -moz-box-shadow 0.15s ease-out;
        -o-transition: -o-box-shadow 0.15s ease-out;
        transition: box-shadow 0.15s ease-out;
        padding: 0;
    }
</style>