<template>	
	<nav class="navbar navbar-expand-md navbar-dark bg-lottoyou" style="padding: 0;">
      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      	</button>
      	<div class="collapse navbar-collapse" id="navbarCollapse">
	        <ul class="navbar-nav" style="">

	        	<router-link tag="li" :to="{ name: 'home' }">
          			<a class="nav-link">{{ trans('strings.home') }}</a>
				</router-link>

	            <router-link tag="li" :to="{ name: 'scratch_cards.index' }">
          			<a class="nav-link">{{ trans('strings.scratch_cards') }}</a>
				</router-link>

          		<router-link tag="li" :to="{ name: 'soccer_expert.index' }">
          			<a class="nav-link">{{ trans('strings.soccer_expert') }}</a>
				</router-link>
	            
	            <router-link tag="li" :to="{ name: 'lotteries.index' }">
	            	<a class="nav-link">{{ trans('strings.lotteries') }}</a>
            	</router-link>

				<router-link tag="li" :to="{ name: 'cartola.index' }">
	            	<a class="nav-link">{{ trans('strings.cartola') }}</a>
            	</router-link>

				<li class="no-mobile">
					<a>&nbsp</a>
				</li>
				<li class="no-mobile">
					<a>&nbsp</a>
				</li>
				<li class="no-mobile">
					<a>&nbsp</a>
				</li>

				<router-link class="world_cup_now" tag="li" :to="{ name: 'soccer_expert.play', params: {slug: 'special'} }">
					<a class="nav-link">
						{{ trans('strings.libertadores_now') }}
					</a>
				</router-link>
	            <!-- <li class="nav-item">
	          		<router-link class="nav-link" :to="{ name: 'lotteries.index' }">
	          			{{ trans('strings.lotteries') }}</span>
	          		</router-link>
	            </li> -->
	          	<!-- <li class="nav-item">
	            	<a class="nav-link" href="#">Link</a>
	          	</li>
	          	<li class="nav-item">
	            	<a class="nav-link disabled" href="#">Disabled</a>
	          	</li> -->
	        </ul>
      	</div>
    </nav>
</template>
<script>
	export default {
	    methods: {
	        interval() {
	            if($('.world_cup_now').hasClass('active')) {
                    $('.world_cup_now')
                        .removeClass('active')
                        .css({
                            visibility: 'hidden'
                        });
                }  else {
                    $('.world_cup_now')
                        .addClass('active')
                        .css({
                            visibility: 'visible'
                        });
                }

            },
            handleSetInterval() {

                var time = setInterval(this.interval, 800);

                $('.world_cup_now').mouseover(() => {
                    clearInterval(time);
                    time = null;
                    $('.world_cup_now')
                        .addClass('active')
                        .css({
                            visibility: 'visible'
                        });
                });

                $('.world_cup_now').mouseout(() => {
                    $('.world_cup_now')
                        .addClass('active')
                        .css({
                            visibility: 'visible'
                        });
                    time = null;
                    time = setInterval(this.interval, 800);
                });
            }
        },
		mounted() {
	        this.handleSetInterval();
		}
	}
</script>

<style scoped>
	.navbar-nav {
		text-align: center;
	}

	.nav-link {
	    color: inherit !important;
	}

	.navbar-dark .navbar-nav .nav-link {
		font-weight: bold;
	}

	.navbar-nav {
		width: 100%;
		text-align: center;
		display: initial;
	}

	.navbar-nav li {
		color: white;
		display: inline-block;
	}

	.navbar-nav li.active {
		color: #535353;
	    cursor: default;
	    text-shadow: none;
	    background: #ffe066;
	    box-shadow: inset 0 3px 0 -1px rgba(0,0,0,.2);
	}

	.navbar-nav li {
		padding-right: 10px;
		padding-left: 10px;
	}

	@media (max-width: 992px) {
		
	}

	@media (max-width: 767px) {
		
		.nav-link {
			padding: 10px;
		}

		.navbar-toggler {
			margin-top: 10px;
		    margin-bottom: 10px;
		    margin-left: 15px;
		}

		.navbar-nav {
			display: block;
		}
	}

	@media (max-width: 576px) {
		.navbar-nav {
			display: flex;
			text-align: left;
		}

		.navbar-nav li {
			padding-left: 15px !important;
		}

		.navbar-toggler {
			margin-top: 10px;
		    margin-bottom: 10px;
		}
		
		
		.navbar-collapse {
			
		}
	}
</style>