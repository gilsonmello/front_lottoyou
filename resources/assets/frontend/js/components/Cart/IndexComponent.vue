<template>
	<div class="container-fluid">
		<h1 class="page-header">{{ trans('strings.cart') }}</h1>
		<!-- <div class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12 text-center">
				<img class="img-fluid" src="https://www.lottoland.com/pt/skins/lottoland/images/checkOut/add_ticket-a9b87d1ccaa94550.jpg" v-if="purchase.quantity == 0">
			</div>
		</div> -->
		<ul class="nav nav-pills nav-justified">
		  	<li class="nav-item" v-if="purchase.items.length > 0">
			    <a class="nav-link active" data-toggle="pill" href="#all">{{ trans('strings.all') }}</a>
		  	</li>
		  	<li class="nav-item" v-if="purchase.scratch_cards.items.length > 0">
			    <a class="nav-link" data-toggle="pill" href="#scratch_cards">
			    	{{ trans('strings.scratch_cards') }}
			    </a>
		  	</li>
		  	<li class="nav-item" v-if="purchase.lotteries.items.length > 0">
			    <a class="nav-link" data-toggle="pill" href="#lotteries">
			    	{{ trans('strings.lotteries') }}
			    </a>
		  	</li>

		  	<li class="nav-item" v-if="purchase.soccer_expert.items.length > 0">
			    <a class="nav-link" data-toggle="pill" href="#soccer_expert">
			    	{{ trans('strings.soccer_expert') }}
			    </a>
		  	</li>
		</ul>

		

		<div v-if="purchase.items.length == 0" class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12 text-center">
				<img class="img-fluid" src="https://www.lottoland.com/pt/skins/lottoland/images/checkOut/add_ticket-a9b87d1ccaa94550.jpg">
			</div>
		</div>

		<!-- Tab panes -->
		<div class="tab-content">
			<br>
		  	<div class="tab-pane active container-fluid" id="all" v-if="purchase.items.length > 0">
		  		<all-component :items="purchase.items"></all-component>
		  	</div>
		  	<div class="tab-pane container-fluid tab-scratch_cards" id="scratch_cards" v-if="purchase.scratch_cards.items.length > 0">
		  		<scratch-card-component :scratchcards="purchase.scratch_cards.items"></scratch-card-component>
		  	</div>
		  	
		  	<div class="tab-pane container-fluid tab-lotteries" id="lotteries" v-if="purchase.lotteries.items.length > 0">
		  		<lottery-component :items="purchase.lotteries.items"></lottery-component>
		  	</div>
		  	
		  	<div class="tab-pane container-fluid tab-soccer_experts" id="soccer_expert" v-if="purchase.soccer_expert.items.length > 0">
		  		<soccer-expert-component :items="purchase.soccer_expert.items"></soccer-expert-component>
		  	</div>
		</div>

	</div>
</template>

<script>
	import {mapState, mapGetters} from 'vuex'
	import ScratchCardComponent from './Tab/ScratchCardComponent'
	import LotteryComponent from './Tab/LotteryComponent'
	import SoccerExpertComponent from './Tab/SoccerExpertComponent'
	import AllComponent from './Tab/AllComponent'
	export default {
		computed: {
			...mapState({
                User: state => state.User
            }),
            ...mapGetters([
                'auth', 'purchase'
            ])
		},
		data: function() {
			return {
				
			}
		},
		mounted: function() {
			window.document.title = window.app.title +' | '+ this.trans('strings.cart');
		},
		components: {
			ScratchCardComponent,
			LotteryComponent,
			SoccerExpertComponent,
			AllComponent
		}
	}
</script>

<style scoped>
	.vcenter {
		margin: 10px;
	}


</style>