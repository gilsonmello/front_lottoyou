<template>
	<div :style="index == 0 ? 'margin: 0 5px 0 15px;' : 'margin: 0 5px 0 5px;'" class="no-padding col-lg-2 col-8 col-md-5 col-sm-5">
		<div :class="'tickets'+' '+wow(index)">
			<!-- <div class="tickets-header">
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
			</div> -->
			<div class="tickets-content">
				<dicker-component v-for="(dicker, index) in dickers" :ticket="ticket" :tickets="tickets" :item="item" :index="index" :key="index" :dicker="dicker" :dickersMaxSel="dickersMaxSel">					
				</dicker-component>
			</div>
			<div class="tickets-extras">
				<dicker-extra-component v-for="(dicker, index) in dickersExtras" :ticket="ticket" :tickets="tickets" :item="item" :index="index" :key="index" :dicker="dicker" :dickersExtrasSelect="dickersExtrasSelect">					
				</dicker-extra-component>
			</div>
			<!-- <div class="tickets-footer">
				<em class="text-caption" style="display: block">
            		Dezenas restantes - <input v-if="ticket.numbers != undefined && dickersMaxSel.length > 0" v-model="dickersMaxSel.length - ticket.numbers.length" name="data[LotUserJogo][qtdNumeros1]" type="text" disabled>
        			<input v-if="ticket.numbersExtras != undefined && dickersExtrasSelect.length > 0" v-model="dickersExtrasSelect.length - ticket.numbersExtras.length" disabled type="text">
        		</em>
			</div> -->
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
		},
		watch: {
			
		}
	}
</script>

<style scoped>
	.tickets {
		margin-bottom: 15px;
	}
	
	.text-caption {
		font-size: 11px;
	}
</style>