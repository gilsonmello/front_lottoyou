<template>
	<section>
		<div class="container" v-for="(item, index) in items" v-if="items.length > 0">
			<soccer-expert-component v-if="item.type == 'soccer_expert'" :id="'soccer_expert_'+index" :item="item.soccer_expert"></soccer-expert-component>
			<lottery-component v-else-if="item.type == 'lottery'" :id="'#lottery_'+index" :item="item.lottery"></lottery-component> 
			<scratch-card-component v-else-if="item.type == 'scratch_card'" :item="item.scratch_card"></scratch-card-component>
		</div>
	</section>
</template>

<script>
	import ScratchCardComponent from './All/ScratchCardComponent'
	import LotteryComponent from './All/LotteryComponent'
	import SoccerExpertComponent from './All/SoccerExpertComponent'

	export default {
		props: ['items'],
		mounted() {
			
		},
		data() {
			return {

			}
		},
		components: {
			ScratchCardComponent,
			LotteryComponent,
			SoccerExpertComponent
		}
	}
</script>

<style scoped>
	
</style>