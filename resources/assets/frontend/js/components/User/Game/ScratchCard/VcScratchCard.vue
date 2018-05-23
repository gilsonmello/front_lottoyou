<template>
	<div class="col-lg-12 ticket">
		<div class="row ticket-columns no-margin">
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
		props: ['item'],
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
	.ticket-columns {
		padding: 10px 0 10px 0;
	}

	.ticket .ticket-columns:after {
		content: '';
	}

	.ticket {
		background: #212529;
	    cursor: pointer;
	    padding: 0;
	    color: #fff;
	}
</style>