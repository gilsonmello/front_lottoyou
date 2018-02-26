<template>
	<main role="main">
		<header-component></header-component>
		<section class="content">
			<router-view></router-view>
		</section>
	</main>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import router from '../router'
	export default {
		data: function() {
			return {

			}
		},
		methods: {

		},
		created: function() {
			router.beforeEach((to, from, next) => {
			    if(to.meta.requiresAuth == true){
		            next()
			    }
		        next();
			});

			router.afterEach((to, from) => {
			    var height = $('main').prop('scrollHeight');
			    $('html, body').animate({
			        scrollTop: 0
			    },  300);
			});
		},
		mounted: function() {
			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent
		}
	}
</script>

<style>
	body {
		padding-top: 10rem;
		min-height: 75rem;
		background-color: #fff
	}
	main {
		
	}

	.vcenter {
		display: flex;
	    align-items: center;
	}

	.page-header {
		color: #000;
	    padding-bottom: 10px;
	    margin: 44px 0 22px;
	    border-bottom: 1px solid #eeeeee;
	}
</style>