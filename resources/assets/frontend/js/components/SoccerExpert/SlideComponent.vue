<template>
	<div class="col-lg-12">
        <div id="carouselExampleIndicators" data-interval="false" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators" style="bottom: -20px;">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>  
                <li data-target="#carouselExampleIndicators" v-if="item.soccer_expert.ticketsNextWeek.length > 0" data-slide-to="1" class=""></li>               
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.soccer_expert.ticketsWeek">
                            <ticket-component v-on:updateSoccerExpert="updateSoccerExpert" :category="item.soccer_expert" :ticket="ticket" :index="index">
                                
                            </ticket-component>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" v-if="item.soccer_expert.ticketsNextWeek.length > 0">
                    <div class="row">
                        <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.soccer_expert.ticketsNextWeek">
                            <ticket-component v-on:updateSoccerExpert="updateSoccerExpert" :category="item.soccer_expert" :ticket="ticket" :index="index">
                                
                            </ticket-component>
                        </div>
                    </div>
                </div>
                <!-- <div :class="carouselItemClass(index)" v-for="(round, index) in soccer_expert.rounds">
                    <div class="row">
                        <div class="col-lg-12">
                            {{ round.data_termino }}
                        </div>
                    </div>
                    <ticket-component :round="round" :column="index" v-on:houseClubResult="houseClubResult" v-on:outClubResult="outClubResult"></ticket-component>
                </div> -->
            </div>
        </div>
        <a class="carousel-control-prev" id="prev-slide-content" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="fa fa-angle-left" style="color: black"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" id="next-slide-content" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="fa fa-angle-right" style="color: black"></span>
            <span class="sr-only">Next</span>
        </a>


        <div class="modal fade modal-ticket" data-backdrop="static" tabindex="-1" aria-labelledby="nivel2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" v-if="ticket != null">
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom: none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="padding-top: 0;">

                        <modal-ticket-component :category="item.soccer_expert" v-on:updateSoccerExpert="updateSoccerExpert" :ticket="ticket"></modal-ticket-component>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            {{ trans('strings.to_close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>
	import TicketComponent from './TicketComponent'
    import ModalTicketComponent from './Modal/TicketComponent'
	export default {
		components: {
			TicketComponent,
            ModalTicketComponent
		},
		props: ['item'],
		created: function () {

        },
        mounted: function() {
            //Escutando evento, que será executado pelo TicektComponent
            this.$eventBus.$on('openModal',  (ticket) => {
                //Pegando o ticket passado como parâmetro
                this.ticket = ticket
                //Abrindo o modal
                $('.modal-ticket').modal('toggle');
            });            
        },
        beforeDestroy() {
            this.$eventBus.$off('openModal');
        },
        activated() {
            
        },
        methods: {
            formatValue(value) {
                value = parseFloat(value);
                return value.format(2, true);
            },
            backgroundTicket(background) {
                return 'background-image: url('+background+')';
            },
            updateSoccerExpert() {
                this.updateTotal();
            },
            //Atualizando o total de todas as cartelas feitas
            updateTotal: function() {              
                this.item.total = this.getTotalTicketsNextWeek() + this.getTotalTicketsWeek();
            },
            getTotalTicketsWeek() {
                var total = 0.00;
                this.item.soccer_expert.ticketsWeek.filter(function(val) {
                    //Verificando se dezenas extras está habilitado
                    if(val.complete == true) {
                        total += parseFloat(val.valor);
                    }
                });
                return total;
            },
            getTotalTicketsNextWeek() {
                var total = 0.00;
                //Pegando todas as apostas feitas
                this.item.soccer_expert.ticketsNextWeek.filter(function(val) {
                    //Verificando se dezenas extras está habilitado
                    if(val.complete == true) {
                        total += parseFloat(val.valor);
                    }
                });
                return total;
            }
        },
        data: function() {
        	return {
        		quantity_slide: [],
                ticket: null,
        	}
        },
        computed: {
			
		}
	}
</script>

<style scoped>

    .ticket-sweepstake-name {
        display: block;
    }

	#prev-slide-content{
        left: -50px; 
        right: auto;
        width: 30px !important;
    }

    #next-slide-content{
        left: auto; 
        right: -50px;
        width: 30px !important;
    }
    .slide{
        width: 100%;
        margin: 0 auto;
    }

    .fa {
        font-size: 60px !important;
    }

    @media (max-width: 576px) {
    	.slide{
	        width: 90%;
	        margin: 0 auto;
	    }
	    #prev-slide-content{
	        left: 0; 
	        right: auto;
	        width: 30px !important;
	    }

	    #next-slide-content{
	        left: auto; 
	        right: 0;
	        width: 30px !important;
	    }
    }
</style>