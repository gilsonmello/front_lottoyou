<template>
	<section class="col-lg-12 line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+item.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-2">
	      		{{ item.soccer_expert.nome }}
	      	</div>
	      	<div class="col-lg-2">
	      		$ {{ item.amount }}
	      	</div>
	      	<div class="col-lg-2">
	      		1
	      	</div>
	      	<div class="col-lg-2">
	      		{{ item.created_at }}
	      	</div>
        </div>

        <div :class="'collapse '+item.id">
        	<load-component v-if="loading.game"></load-component>
			<div class="row no-margin" v-else>
				<div class="col-lg-6 col-sm-6 col-md-6 col-12 no-padding">
					<vc-ticket :ticket="item.soccer_expert_game" :category="item.soccer_expert"></vc-ticket>
				</div>
			</div>
		</div>
	</section>

</template>

<script>
	import VcTicket from './VcTicket'
	export default {
		props: ['item', 'index'],
		data: function() {
        	return {
        		loading: {
					game: false
				},
        	}
        },
        methods: {
            getGameTotal(item) {
                return parseFloat(item.data.total).format(2, true);
            },
        	backgroundTicket(background) {
        		return 'background-image: url('+background+'); background-size: 100% 100%; background-repeat: no-repeat;';
        	},
        	init() {
    			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.item.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.item.id).on('show.bs.collapse', (event) => {
					  	
					});

					$(this.$el).find('.'+this.item.id).on('hide.bs.collapse', (event) => {
						
					})
				}
			});
        	}
        },
        mounted() {	
            this.init();

		},
		components: {
			VcTicket
		},
		computed: {
			
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
		content: "\f068";
		float: right;
	}

	.line .collapsed:after {
		content: "\f067";
	}
</style>