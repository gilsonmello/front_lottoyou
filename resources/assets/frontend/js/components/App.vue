<template>
	<load-component v-if="loading.component == true"></load-component>
	<main role="main" v-else>
		<header-component></header-component>
		<section class="content">
			<transition name="fade" mode="out-in">
	            <keep-alive>
					<router-view></router-view>
				</keep-alive>
			</transition>
		</section>
		<br>
		<footer-component></footer-component>
	</main>
</template>

<script>
	import HeaderComponent from './HeaderComponent'
	import SliderComponent from './SliderComponent'
	import CarouselComponent from './CarouselComponent'
	import FooterComponent from './FooterComponent'
	import router from '../router'
	import LoadComponent from './Load'
	export default {
		data: function() {
			return {
				loading: {
					component: true
				}
			}
		},
		methods: {

		},
		beforeCreate: function() {
			
		},
		beforeMount: function() {
			this.loading.component = true
		},
		created: function() {
			
		},
		mounted: function() {

			this.loading.component = false
			
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

			var time = setTimeout(() => {
				var header = $('.header');
		    	$('body').css({
		    		'padding-top': header[0].clientHeight
		    	});
		    	if(header[0].length > 0){
					clearInterval(time);
				}
	    	});

			
		},
		components: {
			HeaderComponent,
			SliderComponent,
			CarouselComponent,
			FooterComponent,
			LoadComponent
		}
	}
</script>

<style>
	
	

</style>