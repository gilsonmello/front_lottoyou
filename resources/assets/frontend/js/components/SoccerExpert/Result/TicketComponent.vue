<template>
	
	<div class="col-lg-6">
		<h4 data-toggle="collapse" :data-target="'#'+ticket.nome.replace(' ', '_')">{{ ticket.nome }}</h4>

		<div class="collapse" :id="ticket.nome.replace(' ', '_')">
		  	<div class="card card-body">
		    	{{ ticket.nome }}
		  	</div>
		</div>

	</div>
</template>

<script>
	export default {
		props: ['ticket'],
		mounted() {
			var div_collapse = $(this.$el);
			var nome = this.ticket.nome.replace(' ', '_');
			var interval = setInterval(() => {
				nome = this.ticket.nome.replace(' ', '_');
				if($(this.$el).find('#'+nome).length > 0) {
					clearInterval(interval);
					$(this.$el).find('#'+nome).on('shown.bs.collapse', (event) => {
					  	console.log('asdasd');
					});
				}
			});			
		},
		data() {
			return {
				collapse: false
			}
		}
	}
</script>

<style scoped>
	
</style>