<template>
	<div :style="index == 0 ? 'margin: 0 5px 0 15px;' : 'margin: 0 5px 0 5px;'" class="no-padding col-lg-2 col-8 col-md-5 col-sm-5">
		<div :class="'tickets'+' '+wow(index)">
			<div class="tickets-header">
				<!-- <strong>{{ column }}</strong> -->
				<strong>&nbsp;</strong>
				<div class="tools">
					<a class="" href="#" @click.prevent="selectRandom($event)">
						<i class="fa fa-random"></i>
					</a>
					<a class="" href="#" @click.prevent="deleteNumbersChecked($event)">
						<i class="fa fa-trash-o"></i>
					</a>
					<a v-if="index >= 5" class="" href="#" @click.prevent="deleteTicket($event)">
						<i class="fa fa-close"></i>
					</a>
				</div>
			</div>
			<div class="tickets-content">
				<dicker-component v-for="(dicker, index) in dickers" :ticket="ticket" :tickets="tickets" :item="item" :index="index" :key="index" :dicker="dicker" :dickersMaxSel="dickersMaxSel">					
				</dicker-component>
			</div>
			<div class="tickets-extras">
				<dicker-extra-component v-for="(dicker, index) in dickersExtras" :ticket="ticket" :tickets="tickets" :item="item" :index="index" :key="index" :dicker="dicker" :dickersExtrasSelect="dickersExtrasSelect">					
				</dicker-extra-component>
			</div>
			<div class="tickets-footer">
				<em class="text-caption" style="display: block">
            		{{trans('strings.dickers_selected')}} - <input v-if="ticket.numbers != undefined && dickersMaxSel.length > 0" v-model="ticket.numbers.length" type="text" disabled>
        		</em>
				<em class="text-caption" style="display: block" v-if="dickersExtrasSelect.length > 0">
            		<!-- D. {{trans('strings.extras_selected').toLowerCase()}}  - <input v-if="ticket.numbersExtras != undefined && dickersExtrasSelect.length > 0" v-model="dickersExtrasSelect.length - ticket.numbersExtras.length" disabled type="text"> -->
					D. {{trans('strings.extras_selected').toLowerCase()}}  - <input v-if="ticket.numbersExtras != undefined && dickersExtrasSelect.length > 0" v-model="ticket.numbersExtras.length" disabled type="text">
        		</em>
			</div>
		</div>
	</div>
</template>

<script>
	import DickerComponent from './DickerComponent'
	import DickerExtraComponent from './DickerExtraComponent'
	export default {
		components: {
			DickerComponent,
			DickerExtraComponent
		},
		mounted() {
			this.refreshTicket();
		},
		props: [
			'index', 
			'ticket', 
			'tickets',
			'item',
			'dickers',
			'dickersMaxSel',
			'dickersExtras',
			'dickersExtrasSelect'
		],
		methods: {
			wow(bet) {
				return bet.complete && bet.completeExtras ? 'complete' : ''
			},
			deleteTicket($event) {
				this.$emit('deleteTicket', this.index)
			},
			clickNumberExtra: function(event) {
				var btn = $(event.currentTarget);					

				//Se o número de dezenas extras selecionada for igual ao número de dezenas extras possíveis
				if(this.ticket.numbersExtras.length == this.dickersExtrasSelect.length) {
					this.ticket.completeExtras = true
				} else {
					this.ticket.completeExtras = false
				}
				
				//Se a aposta foi selecionada
				if(this.ticket.complete === true && this.ticket.completeExtras === true) {
					$(this.$el).find('.ticket'+ticket).addClass('complete');
					$(this.$el).find('.ticket'+ticket).removeClass('incomplete');
				}else {
					$(this.$el).find('.ticket'+ticket).addClass('incomplete');
					$(this.$el).find('.ticket'+ticket).removeClass('complete');
				}	

				if(this.ticket.numbersExtras.length == 0 && this.ticket.numbers.length == 0) {
					$(this.$el).find('.ticket'+ticket).removeClass('complete');
					$(this.$el).find('.ticket'+ticket).removeClass('incomplete');
				}
			},
			//Função para remover números duplicados em um array
			removeRepeatedNumbers: function(numbers, interval) {
				for(var i = 0; i < numbers.length; i++) {
					for(var j = i + 1; j < numbers.length; j++){
						if(numbers[i] == numbers[j]) {
							numbers[i] = Math.floor(Math.random()*interval) + 1;
							this.removeRepeatedNumbers(numbers, interval)
						}
					}
				}
				return numbers;
			},
			selectRandom: function(event) {
				//Números randomicos
				var numbersRand = [];

				//Pegando números aleatórios entre as dezenas selecionáveis
				//Por exemplo: 1 até 60
				var dickersLength = this.dickers.length;

				//Adiciono no array somente a quantidade de número mínima
				for(var i = 1; i <= this.item.lottery.dezena_sel_min; i++) {
					var rand = Math.floor(Math.random()*dickersLength) + 1;
					numbersRand.push(rand);
				}

				//Adicionando os novos números ao array de números
				this.ticket.numbers = this.removeRepeatedNumbers(
					numbersRand,
					dickersLength
				);
				this.ticket.complete = true;

				//Deselecionando todos os números
				$('.ticket'+this.index).find('button').removeClass('btn-checked');
				
				//Percorrendo os números e adicionando a classe btn-checked
				for(var i = 0; i < numbersRand.length; i++) {
					var btn = $('.ticket'+this.index+' .tickets-content').find('button')[numbersRand[i] - 1];
					$(btn).addClass('btn-checked');
				}

				//Números extras randomicos
				var numbersExtrasRand = []
				
				//Pegando números aleatórios entre as dezenas extras selecionáveis
				//Por exemplo: 1 até 20
				var dickersExtrasLength = this.dickersExtras.length;

				//Adiciono no array somente a quantidade de número mínima
				for(var i = 1; i <= this.dickersExtrasSelect.length; i++) {
					var rand = Math.floor(Math.random()*dickersExtrasLength) + 1;
					numbersExtrasRand.push(rand);
				}
				
				this.ticket.numbersExtras = this.removeRepeatedNumbers(
					numbersExtrasRand,
					this.dickersExtrasSelect.length
				);

				//Se as dezenas extras estão habilitadas
				if(this.isEnabledDickersExtras()) {
					this.ticket.completeExtras = true;
				}

				//Percorrendo os números extras e adicionando a classe btn-checked
				for(var i = 0; i < numbersExtrasRand.length; i++) {
					var btn = $('.ticket'+this.index+' .tickets-extras').find('button')[numbersExtrasRand[i] - 1];
					$(btn).addClass('btn-checked');
				}
				$('.ticket'+this.index).removeClass('incomplete');
				$('.ticket'+this.index).addClass('complete');
			},
			deleteNumbersChecked: function(event) {
				$(this.$el).find('.btn-checked').removeClass('btn-checked');
				$(this.$el).find('.tickets').removeClass('incomplete');
				$(this.$el).find('.tickets').removeClass('complete');
				this.ticket.numbers = [];
				this.ticket.numbersExtras = [];
				this.ticket.completeExtras = false;
				this.ticket.complete = false;

				this.$emit('refreshNumbersChecked');
			},
			refreshTicket: function() {
				
				//console.log(this.item.lottery.dezena_sel_min)
				//Se o usuário selecionou todas as dezenas possíveis
				if(this.ticket.numbers.length >= this.item.lottery.dezena_sel_min) {
					this.ticket.complete = true
				} else {
					this.ticket.complete = false
				}

				let numbersLen = this.ticket.numbers.length - 1;
				numbersLen = numbersLen < 0 ? 0 : numbersLen;
				//console.log(this.item.prices)
				this.ticket.value = this.item.prices[numbersLen] 
					? this.item.prices[numbersLen].valor
					: this.item.prices[this.item.prices.length - 1].valor
				//console.log(this.ticket.value)

				//Se o número de dezenas extras selecionada for igual ao número de dezenas extras possíveis
				if(this.ticket.numbersExtras.length == this.dickersExtrasSelect.length) {
					this.ticket.completeExtras = true
				} else {
					this.ticket.completeExtras = false
				}

				//Verifico se existe dezenas extras,
				//Caso não, faço a verificação somente nas dezenas
				if(this.isEnabledDickersExtras()) {
					if(this.ticket.complete === true && this.ticket.completeExtras === true) {
						$(this.$el).find('.tickets').addClass('complete');
						$(this.$el).find('.tickets').removeClass('incomplete');
					} else {
						$(this.$el).find('.tickets').addClass('incomplete');
						$(this.$el).find('.tickets').removeClass('complete');
					}	
				} else {
					if(this.ticket.complete === true) {
						$(this.$el).find('.tickets').addClass('complete');
						$(this.$el).find('.tickets').removeClass('incomplete');
					} else {
						$(this.$el).find('.tickets').addClass('incomplete');
						$(this.$el).find('.tickets').removeClass('complete');
					}	
				}

				//Se não tem nenhuma dezena selecionada
				if(this.ticket.numbersExtras.length == 0 && this.ticket.numbers.length == 0) {
					$(this.$el).find('.tickets').removeClass('complete');
					$(this.$el).find('.tickets').removeClass('incomplete');
				}
				
				this.$emit('refreshTickets');
			},	
			isEnabledDickersExtras: function() {
				if(this.dickersExtrasSelect.length > 0) {
					return true
				}
				return false
			},		
		},
		watch: {
			'ticket.numbers': function(newValue, oldValue) {
				this.refreshTicket();
			},
			'ticket.numbersExtras': function(newValue, oldValue) {
				this.refreshTicket();
			}
		}
	}
</script>

<style scoped>
	.text-caption {
		font-size: 11px;
		margin-bottom: 2px;
	}
</style>