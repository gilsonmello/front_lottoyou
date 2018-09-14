<template>
    <div>
        <div class="row">
            <div class="col-12">
                <h1>Como funciona</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header" style="padding: 0">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.13/img/tempo.svg)">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4><strong>Duração</strong></h4>
                        <p>
                            O mata-mata é uma liga rápida que pode durar de 2 a 5 rodadas. Todo mundo pode participar, mas só quem é Cartoleiro PRO pode criá-lo!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header" style="padding: 0">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.11/img/disputa.svg)">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4><strong>Disputa</strong></h4>
                        <p>
                            A cada rodada os times disputam dois a dois para ver qual faz mais pontos - quem perde sai, quem ganha garante seu lugar nas disputas da rodada seguinte.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header" style="padding: 0">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.11/img/trofeu.svg)">

                        </div>
                    </div>
                    <div class="card-body">
                        <h4><strong>Vencedor</strong></h4>
                        <p>
                            Ao final, dois times disputam a Taça do Campeão! O terceiro lugar é disputado entre os dois times que perderam na semifinal.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <vc-on-verification :teams="teams" v-if="league.cup.in_progress === 0" />
        <vc-on-progress v-if="league.cup.in_progress === 1" />
    </div>
</template>

<script>
import {host} from '../../../api_routes.js';
import VcOnProgress from './VcOnProgress';
import VcOnVerification from './VcOnVerification';
export default {
    methods: {
        getTeams () {
            let req = axios.create();
            let url = host+'/leagues/'+this.league.slug+'/cup/teams';
            this.loading.teams = true;
            req.get(url)
                .then(response => {
                    this.loading.teams = false;
                    this.teams = response.data
                })
                .catch(error => {
                    this.loading.teams = false;
                });
        },
        getSteps () {
            let req = axios.create();
            let url = host+'/leagues/'+this.league.slug+'/cup/teams';
            this.loading.steps = true;
            req.get(url)
                .then(response => {
                    this.loading.steps = false;
                    this.teams = response.data;
                })
                .catch(error => {
                    this.loading.teams = false;
                });
        }
    },
    name: 'VcCup',
    props: ['league'],
    mounted () {
        //Se a liga ainda não foi sorteada
        if(this.league.cup.in_progress === 0) {
            this.getTeams();
        } else {
            this.getSteps();
        }
    },
    data () {
        return {
            steps: [],
            teams: [],
            loading: {
                component: false,
                teams: false,
            }
        }
    },
    components: {
        VcOnProgress,
        VcOnVerification
    }
}
</script>

<style scoped>
    .help-image {
        height: 167px;
        overflow: hidden;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style>
