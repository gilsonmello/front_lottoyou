<template>
    <load v-if="loading.steps"/> 
    <div v-else>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
                    <ol class="carousel-indicators" style="bottom: -46px;">
                        <li v-for="(step, index) of steps" :key="index" data-target="#carouselExampleIndicators" :data-slide-to="index" :class="step.current_step == 1 ? 'active' : ''"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div v-for="(step, index) of steps" :key="index" :class="step.current_step == 1 ? 'carousel-item active' : 'carousel-item'">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="text-center">{{getStepName(step.type_step)}}</h1>
                                    <h4 class="text-center">{{step.round}}ª RODADA DO BRASILEIRÃO</h4>
                                </div>
                            </div>
                            
                            <vc-step-key :step="step" :stepKey="stepKey" v-for="(stepKey, indexKey) of step.keys" :key="indexKey" />
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
import {host} from '../../../api_routes.js';
import VcStepKey from './VcStepKey';
export default {
    methods: {
        getStepName (typeStep) {
            let types = {
                F: 'Final',
                S: 'Semifinal',
                Q: 'Quartas de Finais',
                O: 'Oitavas de Finais',
                I: 'Fase Inicial',
                T: '3º Lugar'
            }
            return types[typeStep];
        },
        getSteps () {
            let req = axios.create();
            let url = host+'/leagues/'+this.league.slug+'/cup/steps';
            this.loading.steps = true;
            req.get(url)
                .then(response => {
                    this.steps = response.data;
                    this.loading.steps = false;
                })
                .catch(error => {
                    this.loading.steps = false;
                });
        }
    },
    props: ['league'],
    mounted () {
        this.getSteps();
    },
    data () {
        return {
            steps: [],
            loading: {
                steps: true
            }
        }
    },
    components: {
        VcStepKey
    }
}
</script>

<style scoped>
    #prev-slide-content {
        left: 0; 
        align-items: flex-start;
        font-size: 50px;
        right: auto;
        width: 30px !important;
    }

    #next-slide-content {
        left: auto; 
        align-items: flex-start;
        font-size: 50px;
        right: 0;
        width: 30px !important;
    }

    .slide{
        width: 97%;
        margin: 0 auto;
    }
</style>
