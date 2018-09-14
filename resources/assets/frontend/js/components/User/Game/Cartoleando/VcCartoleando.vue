<template>
	<section class="col-lg-12 ticket line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+item.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-2 col-3 col-sm-3">
	      		{{ item.cartoleando.name }}
	      	</div>
	      	<div class="col-lg-2 col-3 col-sm-3">
	      		{{getSystemCurrency.data.symbol}}{{ item.amount }}
	      	</div>
	      	<div class="col-lg-2 col-2 col-sm-2">
	      		{{ item.quantity }}
	      	</div>
	      	<div class="col-lg-2 col-4 col-sm-4">
	      		{{ item.created_at }}
	      	</div>
        </div>

        <div :class="'collapse '+item.id">
        	
			<load v-if="loading.sweepstake"></load>	
			<div class="row no-margin" style="display: flex !important;" v-else>
				
			
			</div>
		</div>

	</section>
</template>

<script>
	import {routes} from '../../../../api_routes';
	import LoadComponent from '../../../Load';
	import {mapGetters} from 'vuex';
	export default {
		props: ['item', 'id', 'index'],
		data () {
			return {
				loading: {
					game: false,
					sweepstake: false
				},
			}
		},
		mounted () { 
			let interval = setInterval(() => {
				if($(this.$el).find('.'+this.item.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.item.id).on('show.bs.collapse', (event) => {

					});

					$(this.$el).find('.'+this.item.id).on('hide.bs.collapse', (event) => {
						
					})
				}
			}, 1000);
            /*var date = this.formatDate(this.item.data.sweepstake.data_fim);				
			var timeOut = setInterval(() => {
				this.setCountdown(date, timeOut);
			}, 1000);
			this.setCountdown(date, timeOut);*/
		},
		methods: {
			getGameTotal(item) {
                return parseFloat(item.data.total).format(2, true);
            },
		},
		components: {
			
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

	.line .columns:after {
		font-family: 'FontAwesome';
		content: "\f077";
		position: absolute;
    	right: 0;
	}

	.line .collapsed:after {
		content: "\f078";
	}	

</style>