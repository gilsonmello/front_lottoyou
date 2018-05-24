<template>
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <ol class="carousel-indicators" style="bottom: -46px;">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">

                             <div class="carousel-item active">
                                <div class="row">
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'scratch_cards.index' }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/index_2.jpeg">
                                        </router-link>
                                    </div>
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'lotteries.show', params: {id: 3} }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/index_easy_money.png">
                                        </router-link>
                                    </div>
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'scratch_cards.index' }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/index_golden_goal.png">
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'soccer_expert.show', params: {id: 3} }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_4.png">
                                        </router-link>
                                    </div>
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'soccer_expert.show', params: {id: 1} }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_3.png">
                                        </router-link>
                                    </div>
                                    <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <router-link :to="{ name: 'soccer_expert.show', params: {id: 2} }">
                                            <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_5.png">
                                        </router-link>
                                    </div>
                                </div>
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
        <div class="row" id="conteudo" style="">
            <div class="col-lg-12" style="min-height: 50px; background-color: #fff;">
                  
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        created() {

        },
        mounted() {
            $('.carousel').carousel({
              interval: 5000
            })
        },
        activated() {
            
        }
	}
</script>

<style scoped>
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
    .slide{
        width: 85%;
        margin: 0 auto;
    }

    .fa {
        font-size: 60px !important;
    }
</style>