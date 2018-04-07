<template>	
	<nav class="navbar navbar-expand-md navbar-dark bg-lottoyou" style="padding: 0;">
      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      	</button>
      	<div class="collapse navbar-collapse" id="navbarCollapse">
	        <ul class="navbar-nav" style="text-align: center;">
	          	<li class="nav-item">
	          		<router-link class="nav-link" :to="{ name: 'home' }">
	          			{{ trans('strings.home') }} <span class="sr-only">(current)</span>
	          		</router-link>
	            </li>
	            <li class="nav-item">
	          		<router-link class="nav-link" :to="{ name: 'scratch_cards.index' }">
	          			{{ trans('strings.scratch_card') }}</span>
	          		</router-link>
	            </li>
	            <li class="nav-item">
	          		<router-link class="nav-link" :to="{ name: 'soccer_expert.index' }">
	          			{{ trans('strings.soccer_expert') }}</span>
	          		</router-link>
	            </li>
	            <li class="nav-item">
	          		<router-link class="nav-link" :to="{ name: 'lotteries.index' }">
	          			{{ trans('strings.lotteries') }}</span>
	          		</router-link>
	            </li>
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

	}
</script>

<style scoped>
	ul {
		width: 100%;
		text-align: center;
		display: initial;
	}
	ul li {
		display: inline-block;
	}

	.navbar-dark .navbar-nav .nav-link {
		font-weight: bold;
		color: white;
	}

	.navbar-dark .navbar-nav .nav-link.active {
		color: #535353;
	    cursor: default;
	    text-shadow: none;
	    background: #ffe066;
	    box-shadow: inset 0 3px 0 -1px rgba(0,0,0,.2);
	}

	.nav-item {
		padding-right: 20px;
	}
</style>