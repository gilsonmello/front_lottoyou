<template>
	<load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
		<h1 class="page-header">{{ trans('strings.soccer_expert') }}</h1>
		<div class="row">
			<div class="col-12 col-md-6 col-sm-6 col-lg-4" v-for="soccer_category in soccer_categories">
				<div class="soccer-expert-card">
					<header class="soccer-expert-header">
						<div class="extras">
							<img src="https://www.grandesloterias.com/images/badges/new-badge_pt.png" alt="Novo" class="game-badge">
						</div>
						<img class="header-image img-fluid" alt="" src="http://www.gopontoaponto.com.br/grupo3/img/soccer-expert/categoria/3.jpg">
						<div class="descript">
						</div>
					</header>
					<div class="soccer-expert-body">
						<a :data-id="soccer_category.id" href="#" @click.prevent="" class="btn description">
							<i class="fa fa-money" aria-hidden="true"></i>
							&nbsp;
							{{ soccer_category.nome }}
						</a>
					</div>
					<footer class="soccer-expert-footer">
						<button class="btn btn-success btn-md play" @click.prevent="handlePlay">
							{{ trans('strings.play') }}
						</button>
					</footer>
				</div>	
			</div>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../api_routes'
	import LoadComponent from '../Load'
	export default {
		created: function() {

		},
		activated: function() {
			
		},
		methods: {
			handlePlay: function(el) {

			}
		},
		data: function() {
			return {
				loading: {
					component: true
				},
				soccer_categories: []
			}
		},
		mounted: function() {
			window.document.title = window.app.title +' | '+ this.trans('strings.soccer_expert');
			/*$(this.$el).find('.scratchpad').each(function () {
				$(this).wScratchPad({
					bg: '/img/raspadinha/0.01.png',
					fg: '/files/RaspadinhasTemas/PIRATAS/capa.png',
                    scratchMove: function (e, percent) {
                    	console.log(percent)
                    }
				});
			});*/

			const soccerExpertRequest = axios.create();
			soccerExpertRequest.interceptors.request.use(config => {
				return config;
			});
			soccerExpertRequest.get(routes.soccer_categories.index, {}).then(response => {
	            if(response.status === 200) {
	            	this.loading.component = false
	            	this.soccer_categories = response.data
				}
	        }).catch((error) => {
	        	if(error.response.data.msg) {
					toastr.error(error.response.data.msg);
	        	}
	        });		
		},
		computed: {

		},
		watch: {

		},
		components: {
			LoadComponent
		}
	}
</script>

<style scoped>
	.row {

	}

	.soccer-expert-card {
		background: #efefef;
	    border-radius: 5px;
	    padding: 15px;
	    margin-bottom: 30px;
	    position: relative;
	}

	.soccer-expert-card .soccer-expert-body {
		background: #0f546d;
	    color: #fff;
	    padding: 10px;
	    font-size: 13px;
	    font-weight: 700;
	}

	.soccer-expert-card .soccer-expert-body a.description {
		cursor: pointer;
    	color: #fff;
	}

	.soccer-expert-card .soccer-expert-body a.demo:hover {
		border: 2px solid #fff;
	}

	.soccer-expert-card footer {
		margin-bottom: 20px;
	}

	.soccer-expert-card footer .play {
		width: 100%;
	}

	.extras img {
		position: absolute;
		top: -15px;
	    left: -5px;
	    z-index: 4;
	}
</style>