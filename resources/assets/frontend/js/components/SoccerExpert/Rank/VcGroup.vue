<template>	
	<div class="group" @click="newTab">
		<div class="row">
			<div class="col-lg-6">
				<img :src="category.imagem_capa" class="img-fluid">
			</div>
			<div class="col-lg-6">
				<h5>{{ trans('strings.group') }} #{{ group.identificacao }}</h5>
				<h5>{{ trans('strings.quantity') }} {{ group.count }}</h5>
				<h5>
					{{ group.status == 1 ? trans('strings.available') : trans('strings.unavailable') }}
				</h5>
			</div>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	import LoadComponent from '../../Load'
	export default {
		props: ['index', 'group', 'category'],
		methods: {
			newTab() {
				/*let url = this.$router.resolve({
					name: 'soccer_groups.ranking',
					params: {
						id: this.group.id
					}
				});*/
				this.$router.push({
					name: 'soccer_groups.ranking',
					params: {
						id: this.group.id
					}
				});
				//window.open(url.href, '_blank');
			},
			init() {
    			
        	},
		},
		mounted() {			
							
		},
		data() {
			return {
				
			}
		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	
	.group {
		cursor: initial;
	    position: relative;
	    background: #ffffff;
	    color: #313534;
	    cursor: pointer;
	    border: 1px solid;
	    border-radius: 3px;
	    border-color: black;
	}

	.img-fluid {
		min-height: 100%;
	}

</style>