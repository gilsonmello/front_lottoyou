<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
        <!-- <h3 class="">&nbsp;</h3> -->
        <div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
        			<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="active show" id="play-component">
	                    {{ trans('strings.play_on_the') }} {{ lottery.sorteio }}
	                </router-link>
	                <router-link :to="{ name: 'lotteries.results', params: { id: lottery.id } }" class="show" id="result-component">
	                    Resultado 
	               	</router-link>
        		</div>
        	</div>
        </div>
        
        <form>
        	<div class="row">
	        	<div class="col-lg-12">
	        		<h4>{{ lottery.sorteio }}</h4>
	        	</div>
	        </div>

	        <div class="row">
				<div class="col-lg-2 tickets" v-for="numberTicket in numberTickets">
					<div :class="'ticket'+numberTicket">
						<h5>{{ numberTicket }}</h5>
						<span class="fields" v-for="dicker in dickers">
							<button @click.prevent="clickNumber(numberTicket, dicker)" class="btn btn-xs btn-default-color">
								{{ dicker }}
							</button>
							<input type="hidden" :name="'field'+dicker">
						</span>
					</div>
				</div>
			</div>
		</form>
		
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	import PlayComponent from './PlayComponent'
	import ResultComponent from './ResultComponent'
	export default {
		activated: function() {
			
		},
		beforeRouteUpdate: function(to, from, next) {
			const showRequest = axios.create();
            this.id = to.params.id;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			showRequest.get(routes.lotteries.show.replace('{id}', this.id), {}, {}).then(response => {
				if(response.status === 200){
					this.lottery = response.data
					this.loading.component = false
					next();
				}
			}).catch((error) => {
				next(false);
			});
        },
		data: function() {
			return {
				loading: {
					component: true
				},
				lottery: {},
				id: '',
				active_tab: 'play-component',
				numberTickets: [],
				dickers: []
			}
		},
		mounted: function() {
			const showRequest = axios.create();
			this.id = this.$route.params.id;
			showRequest.interceptors.request.use(config => {
	        	this.loading.component = true
			  	return config;
			});
			showRequest.get(routes.lotteries.show.replace('{id}', this.id), {}, {}).then(response => {
				if(response.status === 200){
					this.lottery = response.data
					this.loading.component = false
					
					var result = [];
					var numbers = [];
				 	for (var i = 1; i <= this.lottery.category.dezena; i++) {
		            	this.dickers.push(i);
		            };
		            for (var i = 1; i <= this.lottery.category.dezena_sel; i++) {
		            	this.numberTickets.push(i);
		            };
				
				}
			}).catch((error) => {
				
			});
			
		},
		methods: {
			clickNumber: function(ticket, number) {
				console.log(ticket)
				console.log(number)
			}
		},
		computed: {
			
		},
		components: {
			LoadComponent,
			PlayComponent,
			ResultComponent
		}
	}
</script>

<style scoped>
	.btn-xs {
		margin: 2px;
		width: 28px;
    	height: 28px;
    	font-size: 12px;
    	border-radius: 999px !important;
    	-webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
	    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
	    -webkit-transition: -webkit-box-shadow 0.15s ease-out;
	    -moz-transition: -moz-box-shadow 0.15s ease-out;
	    -o-transition: -o-box-shadow 0.15s ease-out;
	    transition: box-shadow 0.15s ease-out;
	    padding: 0;
	}

	.btn-default-color {
		background-color: #ffffff;
	    border-color: #00003f;
	    color: #00003f;
	}

	.btn-xs:hover {
		color: #969c9c;
    	text-decoration: none;
	}

	.btn-checked {
	    background-color: #000053;
	    border-color: #000000;
	    color: #ffffff;
	}
</style>