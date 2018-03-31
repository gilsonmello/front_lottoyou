<template>
	<div :id="id" class="collapse">
		<div class="row container-tickets" style="overflow: auto; flex-wrap: nowrap;" @click.prevent="editLottery(lottery.id, lottery.hash, $event)">
			<div class="col-lg-2 col-10 col-md-5 col-sm-5" v-for="(bet, column) in lottery.betting">
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
							
							<button v-if="verifyNumberSelected(bet.numbers, dicker)" @click.prevent="clickNumber(column, dicker, $event)" class="btn btn-xs btn-default-color btn-checked">
								{{ dicker }}
							</button>

							<button v-else @click.prevent="clickNumber(column, dicker, $event)" class="btn btn-xs btn-default-color">
								{{ dicker }}
							</button>

						</span>
					</div>
					<div class="tickets-extras">
						<span class="fields" v-for="dicker in lottery.dickersExtras">
							<button v-if="verifyNumberSelected(bet.numbersExtras, dicker)" @click.prevent="clickNumberExtras(column, dicker, $event)" class="btn btn-xs btn-default-darking btn-checked">
								{{ dicker }}
							</button>
							<button v-else @click.prevent="clickNumberExtras(column, dicker, $event)" class="btn btn-xs btn-default-darking">
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
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['id', 'lottery'],
		mounted: function() {
			
		},
		methods: {
			clickNumberExtras(column, dicker, $event) {

			},
			editLottery(id, hash, $event) {
				this.$router.push({
					name: 'lotteries.show',
					params: {
						id: id,
						hash: hash
					}
				})
			},
			clickNumber(colunm, dicker, event) {

			},
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