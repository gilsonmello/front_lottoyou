<template>
	<load v-if="loading.component == true" />
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
	  			
            	<div class="container no-padding" v-for="(item, index) in purchase.items" :key="index">
					<soccer-expert-component v-if="item.type === 'soccer_expert'" :id="'soccer_expert_'+index" :item="item.soccer_expert" />
					<lottery-component v-else-if="item.type === 'lottery'" :id="'lottery_'+index" :item="item.lottery"/>
					<scratch-card-component v-else-if="item.type === 'scratch_card'" :item="item.scratch_card" />
					<vc-cartoleando v-else-if="item.type === 'cartoleando'" :item="item.cartoleando" />
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

		
		<!-- <div class="container">
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
		</div> -->

		<!-- <div class="container">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-12 col-12 col-md-12 col-sm-12">
					<span>
						Inserir cupom
					</span>
				</div>
			</div>
		</div> -->

		<div class="container">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-5 col-12 col-md-5 col-sm-6" v-if="auth != undefined">
					<span v-if="(auth.balance.value - purchase.total) >= 0">
						Saldo disponível: {{getSystemCurrency.data.symbol}}{{ auth.balance.value }} (Saldo restante: {{getSystemCurrency.data.symbol}}{{ (auth.balance.value - purchase.total).format(2, true) }})
					</span>
					<span v-else>
						Saldo disponível: {{getSystemCurrency.data.symbol}}{{ auth.balance.value }}(Saldo restante: {{getSystemCurrency.data.symbol}}0.00)
					</span>
				</div>
				<div class="col-lg-5 col-12 col-md-5 col-sm-6" v-else>
					<span>
						Saldo disponível: {{getSystemCurrency.data.symbol}}0.00(Saldo restante: {{getSystemCurrency.data.symbol}}0.00)
					</span>
				</div>
				<div class="col-lg-5 col-6 col-md-5 col-sm-4">
					<span class="pull-right">
						Saldo
					</span>
				</div>
				<div class="col-lg-2 col-6 col-md-2 col-sm-2" v-if="auth">
					<span>
						{{getSystemCurrency.data.symbol}}{{ auth.balance.value }}
					</span>
				</div>
				<div class="col-lg-2 col-6 col-md-2 col-sm-2" v-else>
					<span>
						{{getSystemCurrency.data.symbol}}0.00
					</span>
				</div>
			</div>
				
		</div>
		
		<div class="container">
			<div class="row vcenter" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					<span class="pull-right">
						{{ trans('strings.total_value') }} 
					</span>
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<span>
						{{getSystemCurrency.data.symbol}}{{ (purchase.total).format(2, true) }}
					</span>
				</div>
			</div>
		</div>
		
		<div class="container" v-if="auth">
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px" v-if="auth.balance.value >= purchase.total && purchase.items.length > 0">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<button class="btn btn-primary btn-md btn-complete-purchase" v-if="!loading.paying" type="submit" @click.prevent="validate($event)">		
						{{ trans('strings.complete_purchase') }}
					</button>
					<button @click.prevent="" v-else class="btn-load pull-right btn btn-md btn-primary">
						<i class="fa fa-refresh fa-spin"></i>
					</button>
				</div>
			</div>
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px" v-if="purchase.total > auth.balance.value">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<router-link class="btn btn-primary btn-md" :to="{name: 'balances.deposit'}">
						{{ trans('strings.deposit') }}
					</router-link>
				</div>
			</div>
		</div>
		<div class="container" v-else>
			<div class="row vcenter border-dotted" style="margin: 10px -15px 10px -15px">
				<div class="col-lg-10 col-8 col-md-10 col-sm-10">
					
				</div>
				<div class="col-lg-2 col-4 col-md-2 col-sm-2">
					<button class="btn btn-primary btn-md" type="button" @click.prevent="login($event)">		
						{{ trans('strings.login') }}
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapState, mapGetters} from 'vuex';
	import ScratchCardComponent from './ScratchCardComponent'
	import LotteryComponent from './LotteryComponent'
	//import SoccerExpertComponent from './SoccerExpertComponent'
	import SoccerExpertComponent from './SoccerExpertComponent';
	import VcCartoleando from './VcCartoleando';
	import {routes} from '../../api_routes'
	export default {
		metaInfo () {
			return {
				title: this.trans('strings.cart')+ ' | '+ this.trans('strings.lottoyou'),
				meta: [
					{
						name: 'description',
            			content: this.trans('strings.cart'),
					}
				]
		    }
		},
		computed: {
            ...mapGetters([
				'auth', 
				'purchase',
				'getSystemCurrency'
            ])
		},
		data: function() {
			return {
				loading: {
					component: true,
					paying: false,
				},
			}
		},
		methods: {
			login() {
				$('.modal-login').modal('toggle');
			},
			validate(event) {
				var validateRequest = axios.create();

				validateRequest.interceptors.request.use(config => {
					this.loading.paying = true;
		          	return config;
				});

				let headers = {};
				if(this.auth) {
					headers.headers = {
						'Content-Type' : 'application/json',
						'Accept' : 'application/json',
						'Authorization': 'Bearer ' + this.auth.access_token
					};
				} 

				validateRequest.post(
					routes.carts.validate, 
					this.purchase, 
					headers
				).then(response => {
					if(response.status === 200) {
						this.completePurchase();
					}
				}).catch((error) => {
					toastr.error(
						error.response.data.msg,
						this.trans('strings.error')
					);
					this.loading.paying = false;
				});			
			},
			completePurchase(event) {

				var completePurchaseRequest = axios.create();

				completePurchaseRequest.interceptors.request.use(config => {					
		          	return config;
				});

				//this.purchase['user_id'] = this.auth.id;

				completePurchaseRequest.post(
					routes.carts.complete_purchase, 
					this.purchase, 
				{
					headers: {
						'Content-Type' : 'application/json',
						'Accept' : 'application/json',
						'Authorization': 'Bearer ' + this.auth.access_token
					}
				}).then(response => {
					if(response.status === 200) {
						this.refreshAuthPromise()
							.then((response) => {
								if (response.status === 200) {
									//window.localStorage.setItem('authUser', JSON.stringify(response.data))
									//Pegando os dados do usuário no localstorage
									let access_token = JSON.parse(window.localStorage.getItem('access_token'));
									access_token = access_token != null ? access_token : null;

									//Token para refresh
									let refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
									refresh_token = refresh_token != null ? refresh_token : '';

									response.data.access_token = access_token;
									response.data.refresh_token = refresh_token;

									this.$store.dispatch('setUserObject', response.data);
									this.$store.dispatch('clearPurchase');
									this.$router.push({
										name: 'users.transactions'
									});	
									this.teamRequest();	
								}								
							}).catch((error) => {

							});						
					}
					this.loading.paying = false;
				}).catch((error) => {
					this.loading.paying = false;
				});		
			}
		},
		mounted () {
			//window.document.title = this.trans('strings.cart')+ ' | ' +window.app.title;
			//window.document.title = this.trans('strings.cart');
			this.$store.dispatch('setLoginOptions', {
				redirectToHome: false, 
				redirectToHomeOnLogout: false
			});
			this.loading.component = false;
            setTimeout(() => {
                window.prerenderReady = true;
            }, 1000);
		},
		components: {
			ScratchCardComponent,
			LotteryComponent,
			SoccerExpertComponent,
			VcCartoleando
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