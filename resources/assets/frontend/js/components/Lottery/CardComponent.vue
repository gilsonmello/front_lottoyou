<template>
	<div class="tickets">
		<header class="tickets-header">
			<div class="extras" v-if="lottery.new == 1">
				<img :src="app.basePath+'img/new.png'" alt="new" class="img-fluid">
			</div>
			<img class="header-image img-fluid" :alt="lottery.nome" :src="lottery.img_loteria">
			<div class="descript">
        <h2 class="ng-binding">
          {{ lottery.nome }}
        </h2>
        <p>Realize seu sonho por apenas 1 dólar</p>
      </div>
		</header>
		<div class="tickets-body">
			<div class="amount">
				<!-- <h4>$ {{ lottery.value }}</h4> -->
				<span class="countdown">
					<span v-if="days > 1">
						{{ days }} {{ trans('strings.days') }} e
					</span>
					<span v-else-if="days == 1">
						{{ days }} {{ trans('strings.day') }} e
					</span>				
					{{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
				</span>
			</div>
			<div class="jackpot-table">
				<div class="row vcenter">
					<div class="col-lg-8 col-12 col-md-8 col-sm-12">
						<a href="#" @click.prevent="handleJackpotTable($event)" class="btn description">
							<i class="fa fa-money" aria-hidden="true"></i>
							&nbsp;
							Tabela de Premios
						</a>
					</div>
				</div>
			</div>
		</div>

		<footer class="tickets-footer">
			<router-link :to="{ name: 'lotteries.play', params: { slug: lottery.slug } }" class="btn btn-md btn-primary">
				{{ trans('strings.play_now') }}
			</router-link>
		</footer>
	</div>
</template>

<script>
export default {
  props: ['lottery', 'index'],
  data: function() {
    return {				
        days: '',
        hours: '',
        minutes: '',
        seconds: ''
    }
  },
  beforeDestroy() {
    this.$eventBus.$off('handleJackpotTable');
  },
  methods: {
    handleJackpotTable() {
      this.$eventBus.$emit('handleJackpotTable', this.index);
    },
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
    var date = this.formatDate(this.lottery.sweepstakes[0].data_fim);
        
    var timeOut = setInterval(() => {
      this.setCountdown(date, timeOut);
    }, 1000);
    this.setCountdown(date, timeOut);
  },
  components: {
    
  },
  watch: {

  }
};
</script>

<style scoped>
	.tickets {
		background: #efefef;
	    border-radius: 5px;
	    margin-bottom: 30px;
	    position: relative;
		padding: 15px;
	}

	.tickets-footer {
		color: #666;
	    background: rgba(255,255,255,.3);
	    border-bottom: 1px solid #eee;
	    font-size: 15px;
	    cursor: pointer;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	}

	.tickets-body .amount {
		background: linear-gradient(87.71deg, #1DB2E0 0%, #6AD1ED 50.77%, #1DB2E0 100%);
	    color: #FFFFFF;
	    padding: 15px 0 15px 0;
	    font-weight: bold;
	    text-align: center;
	    box-shadow: 0px -6px 5px -3px rgba(0,0,0,0.3);
	    position: relative;
	}

	.tickets-body .jackpot-table {
		background: #0f546d;
	    color: #fff;
	    padding: 10px;
	    font-size: 13px;
	    font-weight: 700;
	}
	.tickets-body .jackpot-table a.demo {
		display: block;
	    border: 2px solid rgba(255,255,255,.2);
	    border-radius: 5px;
	    color: #fff;
	    font-weight: 700;
	    -webkit-transition: border .3s ease-in-out;
	    transition: border .3s ease-in-out;
	    font-size: 13px;
    	margin: 10px 0 10px 0;
	}

	.tickets-body .jackpot-table a.description {
		cursor: pointer;
    	color: #fff;
    	margin: 10px 0 10px 0;
	}
	.tickets-body .jackpot-table a.demo:hover {
		border: 2px solid #fff;
	}

	.tickets-body .btn {
		padding: 0
	}

	.tickets-header {
		position: relative;
		text-align: center;
	}
	
	.tickets-header:hover .descript {
	    opacity: 1;
	}

	.tickets-header .descript {
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    background-color: rgba(239,239,239,.95);
	    z-index: 2;
	    opacity: 0;
	    -webkit-transition: opacity .3s ease-in-out;
	    transition: opacity .3s ease-in-out;
	    text-align: center;
	    color: #666;
	}
</style>