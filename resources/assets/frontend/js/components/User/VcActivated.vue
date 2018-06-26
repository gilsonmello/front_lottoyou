<template>
    <load-component v-if="loading.component"></load-component>
    <div class="container" v-else>
        <h1>Ativado</h1>
    </div>
</template>

<script>
import LoadComponent from '../Load'
export default {
    name: "VcActivated",
    data() {
        return {
            loading: {
                component: true
            }
        }
    },
    components: {
        LoadComponent
    }
}
</script>

<style scoped>

</style>