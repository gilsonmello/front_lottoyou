<template>
    <div class="row">
        <div class="col-lg-4" v-for="(ticket, index) in cycle.rounds">
            <ticket-component v-on:updateSoccerExpert="updateSoccerExpert" :category="item.soccer_expert" :ticket="ticket" :index="index">
            </ticket-component>
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
        props: ['item', 'cycle', 'index'],
        created: function () {

        },
        mounted: function() {
            
        },
        beforeDestroy() {
            
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
                this.item.total = this.updateTotal();
                this.$eventBus.$on('updateData', () => {
                    this.item.total = this.updateTotal();
                });
            },
            //Atualizando o total de todas as cartelas feitas
            updateTotal: function() {  
                var total = 0.00;
                var value = 0.00;
                
                //Pegando todas as apostas feitas
                this.item.tickets = this.item.tickets.filter((val) => {
                    if(val.complete) {
                        value = parseFloat(val.valor);
                        total += value;
                    }
                    return true;
                });
                return total;            
            },
        },
        data: function() {
            return {
                
            }
        },
        computed: {
            
        }
    }
</script>

<style scoped>

    .row {
        
    }

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