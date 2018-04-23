<template>
	<div class="lottery-card">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-6 col-sm-6">
				<img :alt="lottery.nome" :src="lottery.img_loteria" class="img-fluid">
			</div>
			<div class="col-lg-6 col-md-6 col-6 col-sm-6">
				<span class="text-primary" style="font-weight: bold; font-size: large;">
					{{ lottery.nome }}
				</span>
				<br>
				<span style="font-size: x-large;">
					<b>
						${{ lottery.value }}
					</b>
				</span>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12 col-sm-12">
				<span class="countdown i iHourglass">
                    <i class="md md-alarm"></i>
                    <span class="countdown">
						<span v-if="days > 1">
							{{ days }} {{ trans('strings.days') }} e
						</span>
						<span v-else-if="days == 1">
							{{ days }} {{ trans('strings.day') }} e
						</span>				
						{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
					</span>                                                     
                </span>
			</div>
			<div class="col-lg-6 col-md-6 col-12 col-sm-12">
				<router-link :to="{ name: 'lotteries.show', params: { id: lottery.id } }" class="btn btn-md btn-success">
					{{ trans('strings.play_now') }}
				</router-link>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['lottery'],
		data: function() {
			return {				
    			days: '',
    			hours: '',
    			minutes: '',
    			seconds: ''
			}
		},
		methods: {
			setCountdown(date, timeOut) {
				this.countdown(date, (d, h, m, s, distance) => {
	            	this.days = d;
					this.hours = h;
					this.minutes = m;
					this.seconds = s;
					if(distance < 0) {
						clearInterval(timeOut);
					}
	            });
			},
		},
		mounted: function() {
			/*var date = this.formatDate(this.ticket.data_termino);				
			var timeOut = setInterval(() => {
				this.setCountdown(date, timeOut);
			}, 1000);
			this.setCountdown(date, timeOut);*/
		},
		components: {
			
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