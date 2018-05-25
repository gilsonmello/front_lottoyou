<style scoped>
	.btn-xs {
        margin: 2px;
        font-size: 25px;
        color: white;
        width: 42px;
        background-color: #0056b1;
        border-color: #0056b1;
        border-radius: 999px;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        -webkit-transition: -webkit-box-shadow 0.15s ease-out;
        -moz-transition: -moz-box-shadow 0.15s ease-out;
        -o-transition: -o-box-shadow 0.15s ease-out;
        transition: box-shadow 0.15s ease-out;
        padding: 0;
    }

    .btn-default-darking {
    	background-color: #0090b1;
	    border-color: black;
	    color: black;
    }
</style>

<template>
	<section class="row no-margin text-left">		
		
		<div class="col-lg-12">
			<h5>Números sorteados</h5>
			<button v-for="(number, index) in result.numbers" class="btn btn-xs btn-default-color">
				{{ number.numero }}
			</button>
		</div>		

		
		<div class="col-lg-12" v-if="result.numbers_extras.length > 0">
			<h5>Números Extras sorteados</h5>
			<button v-for="(number_extra, index) in result.numbers_extras" class="btn btn-xs btn-default-darking">
				{{ number_extra.numero }}
			</button>
		</div>		

	</section>
</template>

<script>
	export default {
		props: ['result', 'index'],
		methods: {
		},
		data() {
			return {
				
			}
		},
		mounted() {
			
		},
		components: {
		}
	}
</script>
