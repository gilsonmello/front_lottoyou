<template>
	<input type="text" class="form-control" placeholder="dd/mm/yyyy">
</template>

<script>
	export default {
		watch: {
			
		},
		data(){
			return {
				
			}
		},
		props: ['options', 'value'],
		mounted() {
			$.fn.datepicker.dates['pt-br'] = {
		        days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
		        daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
		        daysMin: ["Do", "Se", "Te", "Qua", "Qui", "Se", "Sa"],
		        months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		        monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
		        today: "Hoje",
		        clear: "Limpar",
		        format: "dd/mm/yyyy",
		        titleFormat: "MM yyyy",
		        weekStart: 0
		    };
		    
		    let options = {
				
			};

			options['language'] = 'pt-br';
		    if(this.options != undefined) {
		    	options = this.options;
		    }
			
			$(this.$el).val(this.value);
			$(this.$el).datepicker(options).on("change", (event) => {
				this.$emit('input', event.target.value);
			});
		},
		methods: {
			updateValue(val) {
				$(this.$el).val(val);
			}
		}
	}
</script>

<style scoped>
	
</style>