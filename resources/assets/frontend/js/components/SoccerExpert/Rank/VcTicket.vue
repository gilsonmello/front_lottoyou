<template>	
	<section class="col-lg-12 line">
		<div class="row columns collapsed no-margin" data-toggle="collapse" :data-target="'.'+ticket.id" :style="index % 2 == 0 ? 'background-color: rgba(0, 0, 0, 0.05);': ''">
			<div class="col-lg-4 col-md-4 col-4 col-sm-4">
				{{ ticket.nome }}
			</div>
			<div class="col-lg-3 col-3 col-sm-3 col-md-3">
				$ {{ ticket.valor }}
			</div>
			<div class="col-lg-4 col-4 col-sm-4 col-md-4">
				{{ ticket.data_termino }}
			</div>
	    </div>

    	<div :class="'collapse '+ticket.id">
			<load-component v-if="loading.game"></load-component>	 
			<div class="row no-margin" v-else>
				<div class="col-lg-4 col-sm-6 col-md-6 col-12" v-for="(group, index) in groups">
					<vc-group :group="group" :category="category" :index="index"></vc-group>
				</div>
			</div>
			<span>&nbsp;</span>
		</div>
    
    </section>
</template>

<script>
	import {routes} from '../../../api_routes'
	import LoadComponent from '../../Load'
	import VcGroup from './VcGroup'
	export default {
		props: ['index', 'ticket', 'category'],
		methods: {
			init() {
    			var date = this.formatDate(this.ticket.data_termino);
    			var timeOut = setInterval(() => {
    				this.countdown(date, (d, h, m, s, distance) => {
		            	this.days = d;
						this.hours = h;
						this.minutes = m;
						this.seconds = s;
						if(distance < 0) {
							clearInterval(timeOut);
						}
		            });
    			}, 1000);
        	}
		},
		mounted() {			
			var interval = setInterval(() => {
				if($(this.$el).find('.'+this.ticket.id).length > 0) {
					clearInterval(interval);

					$(this.$el).find('.'+this.ticket.id).on('show.bs.collapse', (event) => {
					  	this.loading.game = true;
					  	const groupRequest = axios.create();

					  	groupRequest.interceptors.request.use(config => {
							return config;
						});

						let url = routes.soccer_rounds.groups.replace('{round_id}', this.ticket.id);

						groupRequest.get(url, {}, {}).then(response => {
							if(response.status === 200) {
								this.groups = response.data;
								this.loading.game = false;
							}
						}).catch((error) => {
							this.loading.game = false;
						});
					});

					$(this.$el).find('.'+this.ticket.id).on('hide.bs.collapse', (event) => {
						this.groups = []
					})
				}
			});	
			//this.init();	
			this.ticket.valor = parseFloat(this.ticket.valor).format(2, true);	
		},
		data() {
			return {
				loading: {
					game: false
				},
				days: '',
    			hours: '',
    			minutes: '',
    			seconds: '',
    			games: [],
    			groups: []
			}
		},
		components: {
			VcGroup,
			LoadComponent
		}
	}
</script>

<style scoped>

	.collapse {
		padding-top: 20px;
	}

	.columns {
		padding: 10px 0 10px 0;
	}

	.line .columns:after {
		font-family: 'FontAwesome';
		content: "\f068";
		float: right;
	}

	.line .collapsed:after {
		content: "\f067";
	}	

</style>