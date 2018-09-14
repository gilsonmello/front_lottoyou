<template>
	<div class="col-lg-12 collapse" :id="id"  @click.prevent="editSoccerExpert($event)">
        <div id="carouselExampleIndicators" data-interval="false" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators" style="bottom: -46px;">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>  
                <li data-target="#carouselExampleIndicators" v-if="item.soccer_expert.ticketsNextWeek.length > 0" data-slide-to="1" class=""></li>               
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.soccer_expert.ticketsWeek">
                            <ticket-component v-on:updateSoccerExpert="updateSoccerExpert" :ticket="ticket" :index="index">
                                
                            </ticket-component>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" v-if="item.soccer_expert.ticketsNextWeek.length > 0">
                    <div class="row">
                        <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(ticket, index) in item.soccer_expert.ticketsNextWeek">
                            <ticket-component v-on:updateSoccerExpert="updateSoccerExpert" :ticket="ticket" :index="index">
                                
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
    </div>    
</template>

<script>
	import TicketComponent from './TicketComponent'
	export default {
		components: {
			TicketComponent
		},
		props: ['item', 'id'],
		created: function () {

        },
        mounted: function() {
            
        },
        activated: function() {
            
        },
        methods: {
            editSoccerExpert(event) {
                var el = $(event.target);

                //Verificando se não está clicando nos botões de controle do slide
                //Caso não, volto para tela de edição
                if(!el.parent().hasClass('carousel-indicators') && !el.parent().hasClass('carousel-control-prev')
                    && !el.parent().hasClass('carousel-control-next')
                    ) {
                    this.$router.push({
                        name: 'soccer_expert.play',
                        params: {
                            slug: this.item.soccer_expert.slug,
                            hash: this.item.hash
                        }
                    });
                }
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
        		quantity_slide: []
        	}
        },
        computed: {
			
		}
	}
</script>

<style scoped>
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