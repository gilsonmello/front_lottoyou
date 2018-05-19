<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<h1 class="page-header">{{ trans('strings.lotteries') }}</h1>

		<div class="row" v-if="lotteries.length == 0">
			<div class="col-lg-12">
				<h3>Nenhuma loteria disponível no momento</h3>
			</div>				
		</div>

		<div class="row">
			<div class="col-lg-4 col-12 col-md-6 col-sm-6" v-for="lottery in lotteries">				
				<card-component :lottery="lottery"></card-component>
			</div>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import CardComponent from './CardComponent'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				},
				lotteries: []
			}
		},
		methods: {
			
		},
		mounted: function() {
			//window.document.title = window.app.title +' | '+ this.trans('strings.lotteries');
			window.document.title = this.trans('strings.lotteries');
			
			var lotteriesRequest = axios.create();
	        lotteriesRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			lotteriesRequest.get(routes.lotteries.index, {}, {}).then(response => {
				if(response.status === 200){
					this.lotteries = response.data
					this.loading.component = false
				}
			}).catch((error) => {
				
			});
		},
		components: {
			LoadComponent,
			CardComponent
		},
		watch: {

		}
	}
</script>

<style scoped>
	.lottery-card {
		position: relative;
	    padding: 24px;
	    margin-bottom: 15px;
	    background: #ffffff;
	    color: #313534;
	    border-radius: 3px;
	    border: 1px solid rgba(83, 88, 88, 0.15)
	}

	.lottery-card:before {
		content: '';
	    position: absolute;
	    display: block;
	    width: 4px;
	    left: -1px;
	    top: -1px;
	    bottom: -1px;
		background: #2196f3;
	}
</style>