<template>
    <div>
        <div class="row" v-if="league.classic.winner_id">            
            <div class="col-12 col-lg-6">
                <div class="row no-margin">
                    <div class="col-lg-3">
                        <div>
                            <img :src="league.classic.winnerTeam.time.url_escudo_svg" class="img-fluid team-shield winner"/>
                        </div>
                    </div>
                    <div class="col-lg-9 vcenter" style="flex-direction: column; justify-content: center; align-items: flex-start;">
                        <h4 class="">CAMPEÃO</h4>
                        <p class="no-margin">
                            Parabéns {{league.classic.winnerTeam.time.nome_cartola}}!<br>
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
                            <img :src="league.classic.loserTeam.time.url_escudo_svg" class="img-fluid team-shield loser"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center" style="margin: 10px 0 0 0">{{league.classic.loserTeam.time.nome}}</h4>
                        <p class="text-center no-margin">
                            {{league.classic.loserTeam.time.nome_cartola}}                            
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
                            <img :src="league.classic.thirdTeam.time.url_escudo_svg" class="img-fluid team-shield loser"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center" style="margin: 10px 0 0 0">{{league.classic.thirdTeam.time.nome}}</h4>
                        <p class="text-center no-margin">
                            {{league.classic.thirdTeam.time.nome_cartola}}                            
                        </p>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['league']
}
</script>

<style scoped>
    .team-shield.winner {
        width: 130px;
        height: 147px;
    }

    .team-shield.loser {
        height: 70px;
        width: 70px;
    }
</style>
