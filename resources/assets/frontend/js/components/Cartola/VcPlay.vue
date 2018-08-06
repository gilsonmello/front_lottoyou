<template>
    <load-component v-if="loading.component == true"></load-component>
	<div class="container" v-else>

	</div>
</template>

<script>
export default {
    metaInfo () {
        return {
            title: this.trans('strings.lotteries'),
            meta: this.meta
        }
    },
    data() {
        return {
            loading: {
                component: true,
            },
            leagues: [],
            indexClicked: null,
            meta: [],
            awards: [],
            item: {
                
            }
        } 
    },
    mounted () {

    }
}
</script>


<style scoped>

</style>

