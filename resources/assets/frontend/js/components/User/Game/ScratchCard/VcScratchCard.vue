<template>
	<div class="col-lg-12 ticket line">
		<div class="row columns no-margin" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''">
	        <div class="col-lg-2">
	            {{ item.scratch_card.nome }}
	        </div>
	        <div class="col-lg-2">
	            {{ getValue(item.data.total) }}
	        </div>
	        <div class="col-lg-2">
	            {{ item.data.scratch_card.discount_tables.quantity }}
	        </div>
	        <div class="col-lg-2">
	            {{ item.created_at }}
	        </div>
	    </div>
    </div>
</template>

<script>
	
	export default {
		props: ['item', 'index'],
		mounted: function() {
			
		},
		methods: {
			getValue(total) {
				return parseFloat(total).format(2, true);
			}
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