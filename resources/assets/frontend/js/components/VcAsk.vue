<template>
    <div class="container">
        <h1 class="page-header text-justify" style="border: none; margin: 44px 0 0;">
            {{ trans('strings.ask') }}
        </h1>

       <h6>
           Sinta-se a vontade para nos enviar uma mensagem.
           <br>Pode ser uma dúvida, sugestão, crítica, elogio ou qualquer outro assunto, sua mensagem será bem vinda! Entre em contato com nosso e-mail: contato@lottoyou.bet
       </h6>
    </div>
</template>

<script>
    export default {
        metaInfo () {
			return {
				title: this.trans('strings.ask')+ ' | '+this.trans('strings.lottoyou'),
				meta: [
					{ name: 'description', content: this.trans('strings.ask') },
					{
						'property': 'og:title',
						'content': this.trans('strings.ask'),
						'vmid': 'og:title'
					},
					{
						'property': 'og:description',
						'content': this.trans('strings.ask'),
						'vmid': 'og:description'
					}
				]
		    }
		},
        name: "VcAsk",
        mounted() {
            setTimeout(() => {
                window.prerenderReady = true;
            }, 1000);
        }
    }
</script>

<style scoped>

</style>