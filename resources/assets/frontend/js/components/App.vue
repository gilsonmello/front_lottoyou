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

			router.onReady(() => {
				const authUser = JSON.parse(window.localStorage.getItem('authUser'));
				this.$store.dispatch('setUserObject', authUser);
			});
			
			router.beforeEach((to, from, next) => {
				const authUser = JSON.parse(window.localStorage.getItem('authUser'));
				if(to.meta.requiresAuth == true){
		            if(authUser){
			            next()
			        }else{
			            next({
			                name: 'login'
			            })
			        }
			    }
		        if(to.name == 'login' && authUser){
			        toastr.info('Você já está logado.');
			        next({
			            name: 'home'
			        });
			    }else{
			        next();
			    }
			});

			router.afterEach((to, from) => {
			    var height = $('main').prop('scrollHeight');
			    $('html, body').animate({
			        scrollTop: 0
			    },  300);
			    setTimeout(() => {
			    	if(to.matched.length == 0) {
				    	this.$router.push({name: 'home'});
					}
			    }, 200)
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