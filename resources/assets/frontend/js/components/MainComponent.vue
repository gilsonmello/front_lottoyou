<template>
	<router-view></router-view>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import LoadComponent from './Load'
	import router from '../router'
	export default {
		data: function() {
			return {
				
			}
		},
		methods: {

		},
		created: function() {
			
		},
		mounted: function() {
			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent,
			LoadComponent
		}
	}
</script>

<style>

</style>