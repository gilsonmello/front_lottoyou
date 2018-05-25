<template>
	<section class="col-lg-12 ticket line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+item.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''"> 	
    		<div class="col-lg-2">
	      		{{ item.lottery.nome }}
	      	</div>
	      	<div class="col-lg-2">
	      		$ {{ getGameTotal(item) }}
	      	</div>
	      	<div class="col-lg-2">
	      		{{ item.data.tickets.length }}
	      	</div>
	      	<div class="col-lg-2">
	      		{{ item.created_at }}
	      	</div>
        </div>

        <div :class="'collapse '+item.id">
        	<br>
			<load-component v-if="loading.game"></load-component>	
			<div class="row no-margin" style="display: flex !important;" v-else>
				
				<vc-ticket v-for="(ticket, idx) in item.data.tickets" :tickets="item.data.tickets" :dickers="dickers" :dickersMaxSel="dickersMaxSel" :dickersExtras="dickersExtras" :item="item" :dickersExtrasSelect="dickersExtrasSelect" :ticket="ticket" :index="idx" :key="idx"></vc-ticket>
				
			</div>

			<div class="row no-margin text-left">
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						<label for="date">
							{{ trans('strings.sweepstake_date') }}
						</label>
					    <h5>
				      		{{ item.data.sweepstake.data_fim }}
				      	</h5>
				  	</div>
				</div>
				<div class="col-lg-3 col-12 col-md-4 col-sm-4">
					<div class="form-group">
						
					</div>
				</div>
			</div>
			<hr>
		</div>

	</section>
</template>

<script>
	import VcTicket from './VcTicket'
	export default {
		props: ['item', 'id', 'index'],
		data: function() {
			return {
				dickers: [],
				dickersMaxSel: [],
				dickersExtras: [],
				dickersExtrasSelect: [],
				loading: {
					game: false
				},
				next_lottery: {
					days: '',
	    			hours: '',
	    			minutes: '',
	    			seconds: ''
				},
			}
		},
		mounted() {
			
		 	for (var i = 1; i <= this.item.data.lottery.dezena; i++) {
            	this.dickers.push(i);
            }
            for (var i = 1; i <= this.item.data.lottery.dezena_sel; i++) {
            	this.dickersMaxSel.push(i);
            }
            for (var i = 1; i <= this.item.data.lottery.dezena_extra; i++) {
            	this.dickersExtras.push(i);
            }
            for (var i = 1; i <= this.item.data.lottery.dezena_extra_sel; i++) {
            	this.dickersExtrasSelect.push(i);
            }
            var date = this.formatDate(this.item.data.sweepstake.data_fim);				
			var timeOut = setInterval(() => {
				this.setCountdown(date, timeOut);
			}, 1000);
			this.setCountdown(date, timeOut);
		},
		methods: {
			getGameTotal(item) {
                return parseFloat(item.data.total).format(2, true);
            },
            setCountdown(date, timeOut) {
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
			VcTicket
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