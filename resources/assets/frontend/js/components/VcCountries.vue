<template>
	<select @change="changeValue($el)">
        <option :selected="country == value.id ? 'selected' : ''" :value="value.id" :key="index" v-for="(value, index) in countries">
            {{ value.name }}
        </option>
    </select>
</template>

<script>
    import { routes } from '../api_routes';
	export default {
		watch: {},
		data () {
			return {
                
			}
		},
		props: ['countries', 'country'],
		mounted () {      
            /* $(this.$el).datepicker(options).on("change", (event) => {
			    this.$emit('input', event.target.value);
			}); */
		},
		methods: {
			changeValue (event) {
				this.$emit('input', parseInt(event.options[event.selectedIndex].value));
            }
		}
	}
</script>

<style scoped>
	
</style>