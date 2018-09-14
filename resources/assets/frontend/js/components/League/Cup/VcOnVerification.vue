<template>
    <div>
        <br>
        <div class="row">
            <div class="col-12">
                <h1 style="display: inline-block">
                    {{ trans('strings.participants') }}
                </h1>
            </div>
        </div>

        <div class="row">
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
    </div>
</template>

<script>
export default {
    props: ['teams'],
    data () {
        return {

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
</style>
