<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>
		<h1 class="page-header">{{ trans('strings.cart') }}</h1>
		<!-- <div class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12 text-center">
				<img class="img-fluid" src="https://www.lottoland.com/pt/skins/lottoland/images/checkOut/add_ticket-a9b87d1ccaa94550.jpg" v-if="purchase.quantity == 0">
			</div>
		</div> -->
		<ul class="nav nav-pills nav-justified">
		  	<!--<li class="nav-item" v-if="purchase.items.length > 0">
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
		  	</li> -->
		</ul>

		

		<div v-if="purchase.items.length == 0" class="row">
			<div class="col-lg-12 col-md-12 col-12 col-sm-12 text-center">
				<img class="img-fluid" src="https://www.lottoland.com/pt/skins/lottoland/images/checkOut/add_ticket-a9b87d1ccaa94550.jpg">
			</div>
		</div>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active tab-all" id="all" v-if="purchase.items.length > 0">
	  			
            	<div class="container no-padding" v-for="(item, index) in purchase.items">
					<soccer-expert-component v-if="item.type == 'soccer_expert'" :id="'soccer_expert_'+index" :item="item.soccer_expert"></soccer-expert-component>
					<lottery-component v-else-if="item.type == 'lottery'" :id="'lottery_'+index" :item="item.lottery"></lottery-component> 
					<scratch-card-component v-else-if="item.type == 'scratch_card'" :item="item.scratch_card"></scratch-card-component>
				</div>		
		  	</div>
		  	
		  	<!-- <div class="tab-pane container-fluid tab-scratch_cards" id="scratch_cards" v-if="purchase.scratch_cards.items.length > 0">
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
		  	</div> -->
		  	
		</div>

		
		<div class="container">
			<div class="row vcenter" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					<span class="pull-right">
						Subtotal
					</span>
				</div>

				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<span>
						$ {{ (purchase.sub_total).format(2, true) }}
					</span>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<span>
						Inserir cupom
					</span>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-5 col-12 col-md-5 col-sm-6" v-if="auth != undefined">
					<span v-if="(auth.balance.value - purchase.total) >= 0">
						Saldo disponível: ${{ auth.balance.value }}(Saldo restante: $ {{ (auth.balance.value - purchase.total).format(2, true) }})
					</span>
					<span v-else>
						Saldo disponível: ${{ auth.balance.value }}(Saldo restante: $ 0.00)
					</span>
				</div>
				<div class="col-lg-5 col-12 col-md-5 col-sm-6" v-else>
					<span>
						Saldo disponível: $0.00(Saldo restante: $ 0.00)
					</span>
				</div>
				<div class="col-lg-5 col-6 col-md-5 col-sm-4">
					<span class="pull-right">
						Saldo
					</span>
				</div>
				<div class="col-lg-2 col-6 col-md-2 col-sm-2" v-if="auth">
					<span>
						$ {{ auth.balance.value }}
					</span>
				</div>
				<div class="col-lg-2 col-6 col-md-2 col-sm-2" v-else>
					<span>
						$ 0.00
					</span>
				</div>
			</div>
				
		</div>
		
		<div class="container">
			<div class="row vcenter" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					<span class="pull-right">
						Total a pagar 
					</span>
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<span>
						$ {{ (purchase.total).format(2, true) }}
					</span>
				</div>
			</div>
		</div>
		
		<div class="container" v-if="auth">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px" v-if="auth.balance.value >= purchase.total">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<button class="btn btn-success btn-md" type="submit" @click.prevent="validate($event)">		
						{{ trans('strings.complete_purchase') }}
					</button>
					<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-success">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapState, mapGetters} from 'vuex'
	import ScratchCardComponent from './Tab/All/ScratchCardComponent'
	import LotteryComponent from './Tab/All/LotteryComponent'
	//import SoccerExpertComponent from './Tab/SoccerExpertComponent'
	import AllComponent from './Tab/AllComponent'
	import SoccerExpertComponent from './Tab/All/SoccerExpertComponent'
	import LoadComponent from '../Load'
	import {routes} from '../../api_routes'
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
				loading: {
					component: true
				},
			}
		},
		methods: {
			validate(event) {
				var validateRequest = axios.create();

				validateRequest.interceptors.request.use(config => {
					$(this.$el).find('[type="load"]').removeClass('hide');
		        	$(this.$el).find('[type="submit"]').addClass('hide');
		          	return config;
				});

				validateRequest.post(
					routes.carts.validate, 
					this.purchase, 
					{}
				).then(response => {
					if(response.status === 200) {
						this.completePurchase();
					}
				}).catch((error) => {
					toastr.error(
						error.response.data.msg,
						this.trans('strings.error')
					);
					$(this.$el).find('[type="load"]').addClass('hide');
		        	$(this.$el).find('[type="submit"]').removeClass('hide');
				});			
			},
			completePurchase(event) {

				var completePurchaseRequest = axios.create();

				completePurchaseRequest.interceptors.request.use(config => {					
		          	return config;
				});

				this.purchase['user_id'] = this.auth.id;

				completePurchaseRequest.post(
					routes.carts.complete_purchase, 
					this.purchase, 
					{}
				).then(response => {
					if(response.status === 200) {
						this.$store.dispatch('clearPurchase');
						this.$router.push({
							name: 'orders.finish'
						});
					}
				}).catch((error) => {
					
				});		
			}
		},
		mounted: function() {
			//window.document.title = this.trans('strings.cart')+ ' | ' +window.app.title;
			window.document.title = this.trans('strings.cart');
			this.loading.component = false;
		},
		components: {
			ScratchCardComponent,
			LotteryComponent,
			SoccerExpertComponent,
			AllComponent,
			LoadComponent
		}
	}
</script>

<style scoped>
	
	.row {
		align-items: center;
	}

	.border-dotted {
		border-bottom: 1px dotted #999;
		padding: 10px 0 10px 0;
	}
</style>