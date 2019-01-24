<template>
    <load v-if="loading.steps"/> 
    <div v-else>
        <br>
        <div class="row" v-if="league.cup.winner_id">
            
            <div class="col-12 col-lg-6">
                <div class="row no-margin">
                    <div class="col-lg-3">
                        <div>
                            <img :src="league.cup.winnerTeam.time.url_escudo_svg" class="img-fluid team-shield winner"/>
                        </div>
                    </div>
                    <div class="col-lg-9 vcenter" style="flex-direction: column; justify-content: center; align-items: flex-start;">
                        <h4 class="">CAMPEÃO</h4>
                        <p class="no-margin">
                            Parabéns {{league.cup.winnerTeam.time.nome_cartola}}!<br>
                            Você ganhou a taça, foi o mito da liga e pode tirar onda com a galera. Prepare seu time para novas conquistas.
                        </p>                        
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <h6 class="text-center">
                            <strong>
                                2º Lugar
                            </strong>
                        </h6>
                    </div>
                    <div class="col-lg-12 vcenter-end">
                        <div>
                            <img :src="league.cup.loserTeam.time.url_escudo_svg" class="img-fluid team-shield loser"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center" style="margin: 10px 0 0 0">{{league.cup.loserTeam.time.nome}}</h4>
                        <p class="text-center no-margin">
                            {{league.cup.loserTeam.time.nome_cartola}}                            
                        </p>                        
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <h6 class="text-center">
                            <strong>
                                3º Lugar
                            </strong>
                        </h6>
                    </div>
                    <div class="col-lg-12 vcenter-end">
                        <div>
                            <img :src="league.cup.thirdTeam.time.url_escudo_svg" class="img-fluid team-shield loser"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center" style="margin: 10px 0 0 0">{{league.cup.thirdTeam.time.nome}}</h4>
                        <p class="text-center no-margin">
                            {{league.cup.thirdTeam.time.nome_cartola}}                            
                        </p>                        
                    </div>
                </div>
            </div>
        </div>
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
                            <br>
                            
                            <vc-step-key :step="step" :stepKey="stepKey" :index="indexKey" v-for="(stepKey, indexKey) of step.keys" :key="indexKey" />
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
                Q: 'Quartas de Final',
                O: 'Oitavas de Final',
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
        top: 70px;
        right: auto;
        width: 30px !important;
    }

    #next-slide-content {
        left: auto; 
        align-items: flex-start;
        font-size: 50px;
        top: 70px;
        right: 0;
        width: 30px !important;
    }

    .slide{
        width: 97%;
        margin: 0 auto;
    }

    .team-shield.winner {
        width: 130px;
        height: 147px;
    }

    .team-shield.loser {
        height: 70px;
        width: 70px;
    }
</style>
