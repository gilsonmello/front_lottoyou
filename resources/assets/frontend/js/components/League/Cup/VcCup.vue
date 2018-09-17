<template>
    <div>
        <vc-on-verification 
            :league="league"
            :teams="teams" 
            v-if="league.cup.in_progress === 0" 
        />
        
        <vc-in-progress 
            :league="league"
            v-if="league.cup.in_progress === 1" 
        />
    </div>
</template>

<script>
import {host} from '../../../api_routes.js';
import VcInProgress from './VcInProgress';
import VcOnVerification from './VcOnVerification';
export default {
    methods: {
        
    },
    name: 'VcCup',
    props: ['league'],
    mounted () {

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
        VcInProgress,
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
