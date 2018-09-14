<template>
	<section>
		<div class="vcenter soccer_experts no-padding">
			<div class="col-lg-2 col-md-2 col-2 col-sm-2">
				<img class="img-fluid" :alt="item.soccer_expert.nome" :src="item.soccer_expert.imagem_capa">
			</div>
			<div class="col-lg-8 col-5 col-md-7 col-sm-6" :href="'#'+id" data-toggle="collapse">
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>{{ item.soccer_expert.nome }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>
							{{ item.tickets.length}} Jogos
						</span>
					</div>
				</div>
			</div>

			<div class="col-lg-1 col-3 col-md-2 col-sm-2">
				<span>
					$ {{ (item.total).format(2, true) }}
				</span>
			</div>

			<div class="col-lg-1 col-2 col-md-1 col-sm-2">
				<a class="btn btn-xs btn-danger" v-if="!loading.delete" @click.prevent="removeItemSoccerExpert(item, $event)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
				</a>
				<a @click.prevent="" v-else class="btn btn-xs btn-danger">
					<i class="fa fa-refresh fa-spin"></i>
				</a>
			</div>
		</div>

		<div class="collapse row" :id="id" @click.prevent="editTickets">		
			<div class="col-lg-4 col-12 col-md-4 col-sm-4 item" v-for="(ticket, index) in item.tickets">
                <ticket-component :category="item.soccer_expert" :ticket="ticket" :index="index">
                    
                </ticket-component>
            </div>      
		</div>

		<div style="border-bottom: 1px dotted #999;">
			
		</div>

	</section>

</template>

<script>
	import TicketComponent from './SoccerExpert/TicketComponent'
	import SlideComponent from './SoccerExpert/SlideComponent'
	import {routes} from '../../../../api_routes'
	export default {
		props: ['item', 'id'],
		data: function() {
			return {
				loading: {
					delete: false
				},
			}
		},
		mounted: function() {
			
		},
		methods: {
			editTickets() {
				this.$router.push({
                    name: 'soccer_expert.play',
                    params: {
                        slug: this.item.soccer_expert.slug,
					},
					query: {
						hash: this.item.hash
					}
                });
        	},
			removeItemSoccerExpert(item, event){
				let removeItemRequest = axios.create();

				removeItemRequest.interceptors.request.use(config => {
					this.loading.delete = true;
				  	return config;
				});

				removeItemRequest.delete(routes.carts.destroy.replace('{hash}', item.hash), {
					
				}).then((response) => {
					if(response.status === 200) {
						this.$store.dispatch('removeItemSoccerExpert', item)
					}
					this.loading.delete = false;
				}).catch((error) => {
					this.loading.delete = false;
				})
			},
		},
		components: {
			SlideComponent,
			TicketComponent
		}
	}
</script>


<style scoped>

	.item {
		cursor: pointer;
	}

	.collapse.show {
		display: flex !important;
	}
	
	.soccer_experts:last-child{
		margin-bottom: 0;
	}
	.soccer_experts {
		margin-bottom: 10px;
		padding: 10px 0 10px 0;
	}
</style>