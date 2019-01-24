<template>
    <load v-if="loading.teams"/>
    <div v-else>
        <br>
        <div class="row">
            <div class="col-12">
                <h1>Como funciona</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header" style="padding: 0;">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.14/img/tempo.svg)">
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
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header" style="padding: 0">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.14/img/disputa.svg)">
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
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card" style="min-height: 350px;">
                    <div class="card-header" style="padding: 0">
                        <div class="help-image" style="background-image: url(https://cartolafc.globo.com/dist/3.18.14/img/trofeu.svg)">

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

        <br>
        <div class="row" v-if="teams.length > 0">
            <div class="col-12">
                <h1 style="display: inline-block">
                    {{ trans('strings.participants') }}
                </h1>
            </div>
        </div>

        <div class="row" v-if="teams.length > 0">
            <div class="col-12 col-lg-6 col-sm-6 col-md-6" v-for="(team, index) of teams" :key="index">
                <div class="row no-margin row-team">
                    <div class="col-lg-1">
                        <img class="" alt="confirmado na liga" title="confirmado na liga" src="https://cartolafc.globo.com/dist/3.18.13/img/icone_aprovado.svg">
                    </div>
                    <div class="col-lg-3">
                        <div class="cartola-shield">
                            <img class="shield" :src="team.team.time.url_escudo_svg" :alt="team.team.time.nome">
                            <img class="photo" :src="team.team.time.foto_perfil" :alt="team.team.time.nome"/>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="cartola-cartoleiro">
                            <h4><strong>{{ team.team.time.nome }}</strong></h4>
                            <h4>{{ team.team.time.nome_cartola }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row vcenter" v-if="teams.length == 0">
            <div class="col-12">
                <h1>Ainda não há nenhum time cadastrado nesta liga</h1>
            </div>
        </div>
    </div>
</template>

<script>
import {host} from '../../../api_routes.js';
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
    },
    created () {
        this.getTeams();
    },
    mounted () {
        
    },
    props: ['league'],
    data () {
        return {
            teams: [],
            loading: {
                teams: true,
            }
        }
    }
}
</script>

<style scoped>
    .row-team {       
        padding: 18px 30px;
        background-color: #ececec;
        margin-top: 6px;
        border-radius: 4px;
    }
    .row-team:last { 
        margin-top: 0;
    } 

    .cartola-shield {
        display: inline-block;
        width: 5.2rem;
        position: relative;
    }

    .cartola-shield .shield {
        width: 100%;
    }

    .cartola-shield .photo {
        right: -20%;
        bottom: 0;
        width: 60%;
        height: auto;
        position: absolute;
        border: 2px solid #fff;
        border-radius: 50%;
    }

    .cartola-cartoleiro {
        margin-left: 27px;
    }

    .cartola-cartoleiro h4 {
        margin: 0;
        line-height: 1;
    }
    
    .help-image {
        height: 167px;
        overflow: hidden;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    @media (max-width: 992px) {
		
	}

	@media (max-width: 767px) {
		
    }
    @media (min-width: 576px) and (max-width: 768px) {
		
	}

	@media (max-width: 576px) {
		
	}
</style>
