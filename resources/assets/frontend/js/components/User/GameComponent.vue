<template>
	<load-component v-if="loading.component == true"></load-component>
    <vc-soccer-expert v-else></vc-soccer-expert>
</template>

<script>
    import {routes} from '../../api_routes'
    import {mapState, mapGetters} from 'vuex'
	import LoadComponent from '../Load'
    import VcPagination from '../VcPagination'
    import VcSoccerExpert from './Game/VcSoccerExpert'
    export default {
    	data() {
    		return {
    			loading: {
                    component: true
                },
                games: [],
                model: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                }
    		}
    	},
        methods: {
            
        },
        mounted: function() {
            this.loading.component = false;
        },
        components: {
        	LoadComponent,
            VcPagination,
            VcSoccerExpert
        },
        computed: {
            ...mapState({
                User: state => state.User
            }),
            ...mapGetters([
                'auth'
            ])
        },
    }
</script>

<style scoped>

</style>