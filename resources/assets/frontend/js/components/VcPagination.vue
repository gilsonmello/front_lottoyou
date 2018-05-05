<template>
	<nav aria-label="">
  		<ul class="pagination">
    		<li :class="{ 'page-item': true, disabled: source.current_page == 1}">
      			<a class="page-link" href="#" @click.prevent="navigate(source.current_page - 1, $event)" tabindex="-1">
      				&laquo;
      			</a>
	    	</li>
			<li :class="{ 'page-item': true, active: page === source.current_page }" v-for="(page, index) in pages">
				<a class="page-link" href="#" @click.prevent="navigate(page, $event)">
					{{ page }}
				</a>
			</li>
			<li :class="{ 'page-item': true, disabled: source.current_page == source.last_page}">
	      		<a class="page-link" href="#" @click.prevent="navigate(source.current_page + 1, $event)">
	      			&raquo;
	      		</a>
	    	</li>
  		</ul>
	</nav>
</template>

<script>
	import {range} from 'lodash'
	export default {
		props: ['source'],
		mounted() {
			this.pages = range(1, this.source.last_page + 1);
		},
		methods: {
			navigate(page, event) {
				this.$emit('paginate', page);
			}
		},
		data() {
			return {
				pages: []
			}
		},
		watch: {
			'source': function(newValue, oldValue) {
			}
		}
	}
</script>

<style scoped>
	
</style>