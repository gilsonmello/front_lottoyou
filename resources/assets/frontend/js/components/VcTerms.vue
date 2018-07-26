<template>
    <div class="container">
        <h1 class="page-header text-justify" style="border: none; margin: 44px 0 0;">
            Termos e Privacidade
        </h1>

        <div class="row">
            <div class="col-12 text-justify">
                <a class="btn-link" href="/termos_e_condicoes.pdf" target="_blank">
                    Clique aqui para ter acesso aos termos de uso
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VcTerms",
        mounted() {
            setTimeout(() => {
                window.prerenderReady = true;
            }, 1000);
        }
    }
</script>

<style scoped>

</style>