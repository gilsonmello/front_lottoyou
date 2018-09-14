<template>
	<div class="col-lg-12 ticket line">
		<div class="row columns no-margin" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''">
	        <div class="col-lg-2">
	            {{ item.scratch_card.nome }}
	        </div>
	        <div class="col-lg-2">
	            {{getSystemCurrency.data.symbol}}{{ item.amount }}
	        </div>
	        <div class="col-lg-2">
	            {{ item.scratch_card_game.length }}
	        </div>
	        <div class="col-lg-2">
	            {{ item.created_at }}
	        </div>
	    </div>
    </div>
</template>

<script>
	import {mapGetters} from 'vuex';
	export default {
		props: ['item', 'index'],
		mounted () {
			
		},
		methods: {
			getValue (total) {
				return parseFloat(total).format(2, true);
			}
		},
		computed: {
			...mapGetters([
				'getSystemCurrency'
            ])
		}
	}
</script>


<style scoped>
	.container-tickets {
		cursor: pointer;
	}

	.collapse.show {
		
	}

	.columns {
		padding: 10px 0 10px 0;
	}

	
</style>