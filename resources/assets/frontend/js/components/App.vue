<template>
	<main role="main">
		<header-component></header-component>
		<section class="content">
			<router-view></router-view>
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
			CarouselComponent,
			FooterComponent
		}
	}
</script>

<style>
	
	main {
		
	}
	#banner-01 {
		background-color: #ccc;
		width: 100%;
		height: 480px
	}
	#banner-02 {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
	#banner-03 {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
	#explications {
		background-color: #ccc;
		width: 100%;
		height: 200px
	}
		

	

	.btn-demo {
		display: block;
	    border: 2px solid rgba(255,255,255,.2);
	    border-radius: 5px;
	    color: #fff;
	    font-weight: 700;
	    -webkit-transition: border .3s ease-in-out;
	    transition: border .3s ease-in-out;
	    font-size: 13px;
	}

	.btn-demo:hover {
		border: 2px solid #fff;
		color: #fff;
	}

	.number-of-cards {
		padding-top: 10px;
	    text-align: center;
	    color: white;
	}

	.modal-demo .scratchpad {
		width: 120px;
    	height: 120px !important;
    	margin-bottom: 12px;
    }

	.modal-demo .scratchpad canvas, .scratchpad img {
	    left: 0 !important;
	    right: 0 !important;
	}

	
</style>