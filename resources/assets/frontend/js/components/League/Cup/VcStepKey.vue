<template>
    <div class="row key">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="row no-margin">
                <div class="col-lg-7 vcenter-end" style="flex-direction: column; align-items: flex-end;">
                    <h5 style="line-height: 1;" v-if="stepKey.homeTeam">
                        <strong>
                            {{ stepKey.homeTeam.time.nome }}
                        </strong>
                    </h5>
                    <h5 style="line-height: 1;" v-else>
                        <strong>
                            lakdadsk
                        </strong>
                    </h5>
                    <h6 style="line-height: 1;" v-if="stepKey.homeTeam">
                        {{ stepKey.homeTeam.time.nome_cartola }}
                    </h6>
                    <h6 style="line-height: 1;" v-else>
                        isdvslvh
                    </h6>
                </div>
                <div class="col-lg-3 vcenter-end">
                    <div v-if="stepKey.homeTeam">
                        <img style="max-width: 62px;" class="img-fluid" :src="stepKey.homeTeam.time.url_escudo_svg">
                    </div>
                </div>
                <div class="col-lg-2 vcenter-end" style="align-items: center;">
                    <h3 v-if="stepKey.homeTeam">
                        {{ stepKey.home_team_score }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 vcenter" style="justify-content: center;">
            <h3>X</h3>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-5">
            <div class="row no-margin">
                <div class="col-lg-2 vcenter-end" style="align-items: center;">
                    <h3 v-if="stepKey.out_team_score">
                        {{ stepKey.out_team_score }}
                    </h3>
                </div>
                <div class="col-lg-3 vcenter-end">
                    <div>
                        <img v-if="stepKey.outTeam" style="max-width: 62px;" class="img-fluid" :src="stepKey.outTeam.time.url_escudo_svg">
                    </div>
                </div>
                <div class="col-lg-7 vcenter-end" style="flex-direction: column; align-items: flex-start;">
                    <h5 style="line-height: 1;" v-if="stepKey.outTeam">
                        <strong>
                            {{ stepKey.outTeam.time.nome }}
                        </strong>
                    </h5>
                    <h6 style="line-height: 1;" v-if="stepKey.outTeam">
                        {{ stepKey.outTeam.time.nome_cartola }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
    },
    props: ['step', 'stepKey'],
    data () {
        return {

        }
    },
    mounted () {
        
    }
}
</script>

<style scoped>
    .key {
        margin-bottom: 15px;
        padding-bottom: 20px;
        padding-top: 20px;
        border-radius: 4px;
        background-color: #ececec;
    }
</style>
