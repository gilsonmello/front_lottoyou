<template>
	<section class="col-lg-12 ticket line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+item.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-2 col-3 col-md-3 col-sm-3">
	      		{{ item.lottery.nome }}
	      	</div>
	      	<div class="col-lg-2 col-3 col-md-3 col-sm-3">
	      		{{getSystemCurrency.data.symbol}}{{ item.amount }}
	      	</div>
	      	<div class="col-lg-2 col-2 col-md-3 col-sm-2">
	      		{{ item.lottery_games.length }}
	      	</div>
	      	<div class="col-lg-2 col-4 col-md-3 col-sm-4">
	      		{{ item.created_at }}
	      	</div>
        </div>

        <div :class="'collapse '+item.id">
        	
			<load-component v-if="loading.sweepstake"></load-component>	
			<div class="row no-margin" style="display: flex !important;" v-else>
				
				<vc-ticket v-for="(ticket, idx) in item.lottery_games" :result="result" :dickers="dickers" :dickersMaxSel="dickersMaxSel" :dickersExtras="dickersExtras" :item="item" :dickersExtrasSelect="dickersExtrasSelect" :ticket="ticket" :index="idx" :key="idx"></vc-ticket>
			</div>

			<div class="row text-left" v-if="item.lottery_games">
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						<label for="date">
							{{ trans('strings.sweepstake') }}(s)
						</label>
					    <h5>
				      		{{ item.lottery_games[0].sweepstake.data_fim }}
				      	</h5>
				  	</div>
				</div>
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						
					</div>
				</div>
			</div>
		</div>

	</section>
</template>

<script>
	import {routes} from '../../../../api_routes';
	import VcTicket from './VcTicket';
	import LoadComponent from '../../../Load';
	import {mapGetters} from 'vuex';
	export default {
		props: ['item', 'id', 'index'],
		data () {
			return {
				dickers: [],
				dickersMaxSel: [],
				dickersExtras: [],
				dickersExtrasSelect: [],
				result: {
					result: {
						numbers: [],
						numbers_extras: []
					}
				},
				loading: {
					game: false,
					sweepstake: false
				},
				next_lottery: {
					days: '',
	    			hours: '',
	    			minutes: '',
	    			seconds: ''
				},
			}
		},
		mounted () { 
			let interval = setInterval(() => {
				if($(this.$el).find('.'+this.item.id).length > 0) {
					clearInterval(interval);
					$(this.$el).find('.'+this.item.id).on('show.bs.collapse', (event) => {

					  	/*const sweepstakeRequest = axios.create();

						sweepstakeRequest.interceptors.request.use(config => {
							this.loading.sweepstake = true;
				        	return config;
						});

						let url = routes.lotteries.sweepstake.replace('{sweepstake_id}', this.item.data.sweepstake.id);

						sweepstakeRequest.get(url, {}, {}).then(response => {
							if(response.status === 200) {
								this.result = response.data;
								this.loading.sweepstake = false;
							}
						}).catch((error) => {
							
						});*/
					});

					$(this.$el).find('.'+this.item.id).on('hide.bs.collapse', (event) => {
						
					})
				}
			}, 1000);

		 	for (var i = 1; i <= this.item.lottery.dezena; i++) {
            	this.dickers.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_sel; i++) {
            	this.dickersMaxSel.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_extra; i++) {
            	this.dickersExtras.push(i);
            }
            for (var i = 1; i <= this.item.lottery.dezena_extra_sel; i++) {
            	this.dickersExtrasSelect.push(i);
            }
            /*var date = this.formatDate(this.item.data.sweepstake.data_fim);				
			var timeOut = setInterval(() => {
				this.setCountdown(date, timeOut);
			}, 1000);
			this.setCountdown(date, timeOut);*/
		},
		methods: {
			getGameTotal (item) {
                return parseFloat(item.data.total).format(2, true);
            },
            setCountdown (date, timeOut) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.next_lottery.days = d;
					this.next_lottery.hours = h;
					this.next_lottery.minutes = m;
					this.next_lottery.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
					}
	            });
			},
		},
		components: {
			VcTicket,
			LoadComponent
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
    	margin-right: 10px; 
	}

	.line .collapsed:after {
		content: "\f078";
	}	

</style>