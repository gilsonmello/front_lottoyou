<template>
	<div class="container">
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
		  	<div class="tab-pane active container-fluid tab-all" id="all" v-if="purchase.items.length > 0">
	  			<transition name="fade" mode="out-in">
                    <keep-alive>
		  				<all-component :items="purchase.items"></all-component>
				  	</keep-alive>
		  		</transition>
		  	</div>
		  	<div class="tab-pane container-fluid tab-scratch_cards" id="scratch_cards" v-if="purchase.scratch_cards.items.length > 0">
		  		<transition name="fade" mode="out-in">
                    <keep-alive>
		  				<scratch-card-component :scratchcards="purchase.scratch_cards.items"></scratch-card-component>
		  			</keep-alive>
		  		</transition>		
		  	</div>
		  	
		  	<div class="tab-pane container-fluid tab-lotteries" id="lotteries" v-if="purchase.lotteries.items.length > 0">
		  		<transition name="fade" mode="out-in">
                    <keep-alive>
		  				<lottery-component :items="purchase.lotteries.items"></lottery-component>
	  				</keep-alive>
		  		</transition>	
		  	</div>
		  	
		  	<div class="tab-pane container-fluid tab-soccer_experts" id="soccer_expert" v-if="purchase.soccer_expert.items.length > 0">
		  		<transition name="fade" mode="out-in">
                    <keep-alive>
		  				<soccer-expert-component :items="purchase.soccer_expert.items"></soccer-expert-component>
	  				</keep-alive>
		  		</transition>
		  	</div>
		</div>

		
		<div class="container-fluid">
			<div class="row vcenter" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					<span class="pull-right">
						Subtotal
					</span>
				</div>

				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<span>
						$ {{ (purchase.total).format(2, true) }}
					</span>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<span>
						Inserir cupom
					</span>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-5 col-12 col-md-5 col-sm-6">
					<span>
						Saldo disponível: $ 20.00(Saldo restante: $ 0.00)
					</span>
				</div>
				<div class="col-lg-5 col-6 col-md-5 col-sm-4">
					<span class="pull-right">
						Saldo
					</span>
				</div>
				<div class="col-lg-2 col-6 col-md-2 col-sm-2">
					<span>
						$ 20.00
					</span>
				</div>
			</div>
				
		</div>
		
		<div class="container-fluid">
			<div class="row vcenter" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					<span class="pull-right">
						Total a pagar 
					</span>
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<span>
						R$ 100,00
					</span>
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<button class="btn btn-success btn-md" @click.prevent="completePurchase($event)">		
						Confirmar
					</button>
				</div>
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
		methods: {
			completePurchase(event) {
				this.$router.push({
					name: 'orders.finish'
				});
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

	.row {
		align-items: center;
	}

	.border-dotted {
		border-bottom: 1px dotted #999;
		padding: 10px 0 10px 0;
	}
</style>