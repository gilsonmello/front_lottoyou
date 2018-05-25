<template>
	<section class="col-lg-12 line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+sweepstake.id" :style="index % 2 == 0 ? 'background-color: rgba(255,255,255,.05);': ''">
			<div class="col-lg-2">
	    		{{ sweepstake.sorteio }}
	    	</div>
	    	<div class="col-lg-2">
	    		{{ sweepstake.concurso }}
	    	</div>
	    	<div class="col-lg-2">
	    		${{ sweepstake.premio }}
	    	</div>
	    	<div class="col-lg-2">
	    		{{ sweepstake.data_fim }}
	    	</div>
	    </div>

    	<div :class="'collapse '+sweepstake.id">
			<vc-result v-for="(result, index) in sweepstake.results" :key="index" :result="result" :index="index">
			</vc-result>
			<div class="row no-margin">
				<div class="col-12">
					<h4 class="text-left" v-if="sweepstake.results.length == 0">
						{{ trans('strings.unfinished_sweepstake') }}
					</h4>
				</div>
			</div>
		</div>
    
    </section>
</template>

<style scoped>
	.collapse {
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.columns {
		padding: 10px 0 10px 0;
	}

	.columns:after {
		font-family: 'FontAwesome';
		content: "\f068";
		float: right;
	}

	.collapsed:after {
		content: "\f067";
	}	

	.line {
		background: #212529;
	    cursor: pointer;
	    padding: 0;
	    color: #fff;
	}
</style>

<script>
	import {routes} from '../../../api_routes'
	import LoadComponent from '../../Load'
	import VcResult from './VcResult'
	export default {
		props: ['index', 'sweepstake'],
		mounted() {
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.sweepstake.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.sweepstake.id).on('show.bs.collapse', (event) => {
					  	
					});

					$(this.$el).find('.'+this.sweepstake.id).on('hide.bs.collapse', (event) => {
						
					})
				}
			}, 1000);
		},
		data() {
			return {

			}
		},
		components: {
			VcResult
		}
	}
</script>