<template>
	<div class="row collapse" :id="id">
        <div class="col-lg-12 no-padding">
	        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" @click.prevent="editSoccerExpert">
	            <ol class="carousel-indicators" style="bottom: -46px;">
	                <li data-target="#carouselExampleIndicators" :data-slide-to="index" v-for="(to, index) in quantity_slide" :class="indicatorsClass(index)"></li>                
	            </ol>
	            <div class="carousel-inner" role="listbox">
					<div :class="carouselItemClass(index)" v-for="(round, index) in soccer_expert.rounds">
	                    <ticket-component :round="round" :column="index"></ticket-component>
	                </div>
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
		props: ['soccer_expert', 'id'],
		created: function () {

        },
        mounted: function() {
            
        },
        activated: function() {
            this.indicators();
        },
        methods: {
            editSoccerExpert(id, hash, $event) {
                this.$router.push({
                    name: 'soccer_expert.show',
                    params: {
                        id: this.soccer_expert.id,
                        hash: this.soccer_expert.hash
                    }
                })
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