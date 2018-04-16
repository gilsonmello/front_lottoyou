<template>
	<section style="margin-left: -15px; margin-right: -15px">
		<div class="vcenter soccer_experts" :href="'#'+id" data-toggle="collapse">
			<div class="col-lg-2 col-md-2 col-2 col-sm-2">
				<img class="img-fluid" :alt="item.soccer_expert.nome" :src="item.soccer_expert.imagem_capa">
			</div>
			<div class="col-lg-8 col-5 col-md-7 col-sm-6">
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>{{ item.soccer_expert.nome }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-12 col-md-12 col-sm-12">
						<span>
							{{ item.ticketsWeek.length + item.ticketsNextWeek.length }} Jogos
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
				<a class="btn btn-xs btn-danger" @click.prevent="removeItemSoccerExpert(item)" href="#" style="cursor:pointer;">
					<i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" :title="trans('strings.delete')" data-original-title="Deletar"></i>
				</a>
			</div>
		</div>

		<div class="collapse" :id="id">
			
		
		<div class="row">
            <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.ticketsWeek">
                <ticket-component :ticket="ticket" :index="index">
                    
                </ticket-component>
            </div>
            <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.ticketsNextWeek">
                <ticket-component :ticket="ticket" :index="index">
                    
                </ticket-component>
            </div>
        </div>

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
				
			}
		},
		mounted: function() {
			
		},
		methods: {
			removeItemSoccerExpert(item){
				this.$store.dispatch('removeItemSoccerExpert', item)
				let removeItemRequest = axios.create();
				removeItemRequest.delete(routes.carts.destroy.replace('{hash}', item.hash), {
					
				}).then((response) => {
					if(response.status === 200) {
						
					}
				}).catch((error) => {

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
	section {
		margin-right: -15px;
		margin-left: -15px;
	}

	.soccer_experts:last-child{
		margin-bottom: 0;
	}
	.soccer_experts {
		margin-bottom: 10px;
		padding: 10px 0 10px 0;
	    border-bottom: 1px dotted #999;
	}
</style>