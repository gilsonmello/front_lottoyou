<template>
	<div class="row">
        <div class="col-lg-12">
	        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	            <ol class="carousel-indicators" style="bottom: -46px;">
	                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>  
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>               
	            </ol>
	            <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(round, index) in soccer_expert.rounds">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{ round.data_termino }}
                                    </div>
                                </div>
                                
                                <ticket-component :round="round" :column="index" v-on:houseClubResult="houseClubResult" v-on:outClubResult="outClubResult"></ticket-component>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4 col-12 col-md-4 col-sm-4" v-for="(round, index) in soccer_expert.rounds">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{ round.data_termino }}
                                    </div>
                                </div>
                                
                                <ticket-component :round="round" :column="index" v-on:houseClubResult="houseClubResult" v-on:outClubResult="outClubResult"></ticket-component>
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
    </div>
</template>

<script>
	import TicketComponent from './TicketComponent'
	export default {
		components: {
			TicketComponent
		},
		props: ['soccer_expert'],
		created: function () {

        },
        mounted: function() {
            
        },
        activated: function() {
            this.indicators();
        },
        methods: {
        	houseClubResult(value, column, line, event) {
        		this.$emit('houseClubResult', value, column, line, event);
        	},
        	outClubResult(value, column, line, event) {
        		this.$emit('outClubResult', value, column, line, event);	
        	},
        	carouselItemClass(index){
        		return index == 0 ? 'carousel-item active' :  'carousel-item';
        	},
        	indicatorsClass(index) {
        		return index == 0 ? 'active' :  '';
        	},
        	dataSlideTo(index) {
        		
        	},
        	indicators() {
        		for(var i = 0; i < this.soccer_expert.rounds.length; i++) {
        			this.quantity_slide.push(i);
        		}
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