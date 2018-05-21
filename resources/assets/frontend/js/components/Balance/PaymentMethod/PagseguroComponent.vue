<template>
	<div class="row">
		<div class="col-lg-12">
			<h4 class="choice-payment-method-msg">Você escolheu Pagseguro como forma de pagamento</h4>
			<div class="row">
				<div class="col-lg-12 col-12 col-sm-12 col-md-12">
				    <strong>
				    	<label for="amount">* Quantia a ser depositada &nbsp;
				    	<i class="fa fa-info" title="Mínimo de $15.00"></i>
				    </label>
				    </strong>
					<div class="input-group">
						<div class="input-group-addon">@</div>
					    <input type="number" v-model="amount" required class="form-control" id="amount" aria-describedby="amount" :placeholder="'Por favor, indique o valor em USD'" maxlength="5">
				  	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<input type="checkbox" v-model="terms" required name="terms" id="terms">
					&nbsp;Eu li e aceito os <router-link :to="{ name: 'terms.index' }" target="_blank">termos e condições</router-link> de uso deste site.                    
				</div>
			</div>

			<hr>
			<form @submit.prevent="">
				<div class="row">
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_name" :placeholder="trans('strings.card_name')">
								{{ trans('strings.card_name') }}
							</label>
							<input type="text" v-model="card_name" class="form-control">
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_personal_id" :placeholder="trans('strings.card_personal_id')">
								{{ trans('strings.card_personal_id') }}
							</label>
							<inputmask :mask="'999.999.999-99'" :greedy="false" v-model="card_personal_id"></inputmask>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="form-group">
							<label for="card_birth_date" :placeholder="trans('strings.card_birth_date')">
								{{ trans('strings.card_birth_date') }}
							</label>
							<datepicker v-model="card_birth_date" :options="{}"></datepicker>
						</div>
					</div>
				</div>

				<div class="row" style="align-items: flex-end">
					<div class="col-lg-6 col-12">
						<div class="form-group">
							<label for="card_number" :placeholder="trans('strings.card_number')">
								{{ trans('strings.card_number') }}
							</label>
							<div class="input-group">
								<inputmask v-model="card_number" :mask="'9'" :repeat="20" :greedy="false" :rightAlign="false"> 
								</inputmask>

		                    	<span class="input-group-addon fa fa-credit-card-alt"></span>
		                	</div>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_month" :placeholder="trans('strings.card_month')">
								{{ trans('strings.card_month') }}
							</label>
							<div class="input-group">
								<inputmask :mask="'99'" v-model="card_month"></inputmask>
		                    	<span class="input-group-addon fa fa-calendar"></span>
		                	</div>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_year" :placeholder="trans('strings.card_year')">
								{{ trans('strings.card_year') }}
							</label>
							<div class="input-group">
								<inputmask :mask="'9999'" v-model="card_year"></inputmask>
		                    	<span class="input-group-addon fa fa-calendar"></span>
		                	</div>
						</div>
					</div>

					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label for="card_cvv" :placeholder="trans('strings.card_cvv')">
								{{ trans('strings.card_cvv') }}
							</label>
							<inputmask :mask="'999'" v-model="card_cvv"></inputmask>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12 buttons">
						<button type="submit" class="btn btn-success">Efeutuar compra</button>
						<button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-success">
							<i class="fa fa-refresh fa-spin"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	import {routes} from '../../../api_routes'
	import VcLoad from '../../Load'
	export default {
		data: function() {
			return {
				amount: '',
				terms: '',
				loading: {
					component: true,
				},
				session_id: '',
				card_name: '',
				card_personal_id: '',
				card_birth_date: '',
				card_number: '',
				card_month: '',
				card_year: '',
				card_cvv: '',
				query: {
					page: 1,
					column: 'pontuacao',
					direction: 'desc',
					nickname: '',
					valor: '',
					data_termino: '',
				}
			}
		},
		mounted() {
			const sessionRequest = axios.create();
			sessionRequest.interceptors.request.use(config => {
	        	return config;
			});
			let url = "/pagseguro/get_session_id";

			sessionRequest.get(url, {}, {}).then(response => {
				if(response.status === 200){
					this.session_id = response.data
				}
			}).catch((error) => {
				
			});

			/*$.getScript("https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js", function( data, textStatus, jqxhr ) {
			});*/





		}
	}
</script>

<style scoped>
	.choice-payment-method-msg {
	    background-color: #EFEFEF;
	    padding: 15px;
	    font-size: 17px;
	    display: inline-block;
	    width: 100%;
	    -webkit-transition: background-color 0.5s ease;
	    -moz-transition: background-color 0.5s ease;
	    -o-transition: background-color 0.5s ease;
	    transition: background-color 0.5s ease;
	}

	.buttons {
		margin: 15px auto;
	}

	.input-group {
		display: flex;
	}
</style>