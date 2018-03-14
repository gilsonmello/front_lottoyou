<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<h1 class="page-header">{{ trans('strings.lotteries') }}</h1>
		<div class="row">
			<div class="col-lg-4" v-for="lottery in lotteries">				
				<div class="lottery-card">
					<div class="row">
						<div class="col-lg-6">
							<img src="http://www.lottoland.com/pt/skins/lottoland/images/lotteryLogos/lt-elGordoPrimitiva.x2-bc4cde5fe7329ee5.png" class="img-fluid">
						</div>
						<div class="col-lg-6">
							<div class="pull-right">
								<span class="text-primary" style="font-weight: bold; font-size: large;">
									{{ lottery.sorteio }}
								</span>
								<br>
								<span style="font-size: x-large;">
									<b>
										{{ lottery.premio }}
									</b>
								</span>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-6">
							<span class="countdown i iHourglass">
                                <i class="md md-alarm"></i>
                                295 Dias, 13H e 9M                                                        
                            </span>
						</div>
						<div class="col-lg-6">
							<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="btn btn-md btn-success">
								{{ trans('strings.play_now') }}
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				},
				lotteries: []
			}
		},
		mounted: function() {
			window.document.title = window.app.title +' | '+ this.trans('strings.lotteries');
			
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
			LoadComponent
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