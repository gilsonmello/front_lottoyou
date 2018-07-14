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
</style>

<script>
import {mapGetters} from 'vuex';
import {routes} from '../../../api_routes'
export default {
    computed: {
        ...mapGetters([
            'auth'
        ])
    },
    components: {

    },
    data () {
        return {
            loading: {
                component: false,
                submit: false
            },
            amount: '',
            terms: '',
            country: '',
            countries: [],
            number: '',
            bank: '',
            agency: '',
            name: '',
            account_type: '1',
            identification: '',
            operation: '',
            value: 10.00
        }
    },
    mounted() {
        if(this.auth.balance.value >= 10) {
            this.init();
        } else {
            swal({
                title: 'Saldo menor do que $10.00',
                type: 'warning',
                showCloseButton: true,
                showConfirmButton: false,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: this.trans('strings.yes'),
                cancelButtonText: this.trans('strings.cancel')
            }).then((result) => {
                this.$router.push({
                    name: 'users.account'
                });
            });
        }
    },
    methods: {
        init() {
            this.getCountries();
        },
        requestAgent() {
            let request = axios.create();
            request.interceptors.request.use(config => {
                this.loading.submit = true;
                return config;
            });
            
            let url = routes.balance.agent_withdraw;
            
            request.post(url, {
                owner_id: this.auth.id,
                country_id: this.country,
                number: this.number,
                bank: this.bank,
                agency: this.agency,
                name: this.name,
                account_type: this.account_type,
                identification: this.identification,
                operation: this.operation,
                value: this.value
            }).then(response => {
                if(response.status === 200) {
                    this.refreshAuth();
                    if(response.data.message) {
                        toastr.success(response.data.message);
                    }
                    this.$router.push({
                        name: 'users.transactions'
                    });
                }
            }).catch((error) => {
                if(error.response.data.message) {
                    toastr.error(error.response.data.message);
                }
                this.loading.submit = false;
            })
        },
        submitAgent(el) {
            if(this.value <= this.auth.balance.value && this.value > 0) {
                swal({
                    title: this.trans('strings.do_you_wish_to_continue'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: this.trans('strings.yes'),
                    cancelButtonText: this.trans('strings.cancel')
                }).then((result) => {
                    if(result.dismiss) {
                        
                    } else {
                        this.requestAgent();
                    }
                });
            } else {
                toastr.error(
                    'Informe um saldo maior do que 0',
                    this.trans('strings.error')
                );
            }
        },
        getAmount() {
            let value = $("#amount").val();
            this.amount = value;
            value = value.replace(/\$\ /g, '');
            value = value.replace(/ /g, '');
            value = value.replace(/,/g, '');
            return value;
        },
        setMask() {
            let vm = this;
            VMasker(document.querySelector("#amount")).maskMoney({
                // Decimal precision -> "90"
                precision: 2,
                // Decimal separator -> ",90"
                separator: '.',
                // Number delimiter -> "12.345.678"
                delimiter: ',',
                unit: '$',
            });
            $("#amount").on("blur", function(event) {
                let value = $(this).val();
                vm.amount = value;
                value = parseFloat(vm.getAmount());
                vm.value = parseFloat(value).format(2, true);
                if(value > vm.auth.balance.value || value < 10) {
                    $(this).val(VMasker.toMoney('10.00', {
                        // Decimal precision -> "90"
                        precision: 2,
                        // Decimal separator -> ",90"
                        separator: '.',
                        // Number delimiter -> "12.345.678"
                        delimiter: ',',
                        unit: '$',
                    }));
                    vm.amount = VMasker.toMoney('10.00', {
                        // Decimal precision -> "90"
                        precision: 2,
                        // Decimal separator -> ",90"
                        separator: '.',
                        // Number delimiter -> "12.345.678"
                        delimiter: ',',
                        unit: '$',
                    });
                    vm.value = 10.00;
                }
            });
        },
        validateFormAgent() {
            let vm = this;
            let time = setInterval(() => {
                var form = $(this.$el).find('form');
                if(form.length > 0) {
                    this.amount = VMasker.toMoney('10.00', {
                        // Decimal precision -> "90"
                        precision: 2,
                        // Decimal separator -> ",90"
                        separator: '.',
                        // Number delimiter -> "12.345.678"
                        delimiter: ',',
                        unit: '$',
                    });
                    this.setMask();
                    clearInterval(time);
                    form.validate({
                        rules: {
                            name: {
                                required: true,
                            },
                            terms: {
                                required: true,
                            },
                            bank: {
                                required: true,
                            },
                            agency: {
                                required: true,
                            },
                            number: {
                                required: true,
                            },
                            identification: {
                                required: true,
                            }
                        },
                        messages: {
                            name: {
                                required: vm.trans('strings.field_required'),
                            },
                            terms: {
                                required: vm.trans('strings.field_required'),
                            },
                            bank: {
                                required: vm.trans('strings.field_required'),
                            },
                            agency: {
                                required: vm.trans('strings.field_required'),
                            },
                            number: {
                                required: vm.trans('strings.field_required'),
                            },
                            identification: {
                                required: vm.trans('strings.field_required'),
                            }
                        },
                        highlight: function (input) {
                            $(input).addClass('error');
                            $(input).parents('.form-control').addClass('error');
                        },
                        unhighlight: function (input) {
                            $(input).removeClass('error');
                            $(input).parents('.form-control').removeClass('error');
                        },
                        errorPlacement: function (error, element) {
                            $(element).parents('.input-group').append(error);
                            $(element).parents('.form-group').append(error);
                        }
                    });
                    form.on('submit', function(e) {
                        vm.submit = true;
                        var isvalid = form.valid();
                        if (isvalid) {
                            e.preventDefault();
                            vm.submitAgent();
                        }
                    });
                }
            });
        },
        getCountries() {
            let countryRequest = axios.create();
			countryRequest.interceptors.request.use(config => {
				this.loading.component = true
				return config;
			});
			countryRequest.get(routes.countries.index, {}).then(response => {
				if(response.status === 200) {
	            	this.countries = response.data;
                    this.country = ''+this.countries[0].id;
                    this.loading.component = false
                    this.validateFormAgent();
	            }
			}).catch((error) => {
				this.loading.component = false
			});
        }
    }
  }
</script>

<template>
    <load v-if="loading.component"></load>
    <div class="row" v-else>
		<div class="col-lg-12">
            <h6 class="choice-payment-method-msg"><strong>Você escolheu o Agente de pagamento como forma de retirada </strong></h6>
            <h5>
            </h5>
            <!-- <h1 class="page-header">{{trans('strings.withdraw')}} {{trans('strings.funds')}}</h1> -->
            <form v-if="auth.balance.value >= 10">
                <div class="row">
                    <div class="col-lg-3 col-12 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="name">{{ trans('strings.name') }}*</label>
                            <input type="text" name="name" v-model="name" required class="form-control" id="name" :placeholder="'Nome do titular da conta'">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="bank">{{ trans('strings.bank') }}*</label>
                            <input type="text" name="bank" v-model="bank" required class="form-control" id="bank" :placeholder="trans('strings.example')+': Banco do Brasil, Bradesco'">
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="agency">{{ trans('strings.agency') }}*</label>
                            <input type="text" name="agency" v-model="agency" required class="form-control" id="agency" :placeholder="'9999999-9'">
                        </div>
                    </div>
                    <div class="col-lg-2 col-12 col-md-2 col-sm-2">
                        <div class="form-group">
                            <label for="number">{{ trans('strings.number') }}*</label>
                            <input type="text" name="number" v-model="number" required class="form-control" id="number" :placeholder="'9999999-9'">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="account_type">{{ trans('strings.account_type') }}</label>
                            <select v-model="account_type" class="form-control" id="account_type">
                                <option value="1">
                                    {{ trans('strings.current_account') }}
                                </option>
                                <option value="2">
                                    {{ trans('strings.savings') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="operation">{{ trans('strings.operation') }}</label>
                            <input type="text" name="operation" v-model="operation" class="form-control" id="operation" :placeholder="'999'">
                            <small>{{ trans('strings.if_there_is') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="identification">Doc. de {{ trans('strings.identification') }}*</label>
                            <input type="text" name="identification" v-model="identification" required class="form-control" id="identification" :placeholder="'99999999999'">
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="country">{{ trans('strings.country') }}</label>
                            <select v-model="country" class="form-control" id="country">
                                <option :value="value.id" :key="index" v-for="(value, index) in countries">
                                    {{ value.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12 col-sm-4 col-md-4">
                        <strong>
                            <label for="amount">* Quantia a ser retirada &nbsp;
                                <i class="fa fa-info" title="Mínimo de $1.00"></i>
                                &nbsp;&nbsp;{{ trans('strings.left_balance') }}: ${{ parseFloat(auth.balance.value - value).format(2, true) }}
                            </label>
                        </strong>
                        <input type="text" v-model="amount" required class="form-control" id="amount" :placeholder="'Por favor, indique o valor em USD'">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="checkbox" v-model="terms" required name="terms" id="terms">
                            &nbsp;Eu li e aceito os <router-link :to="{ name: 'terms' }" target="_blank">termos e condições</router-link> de uso deste site.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 buttons">
                        <button v-if="loading.submit" @click.prevent="" type="load" class="btn btn-md btn-primary">
                            <i class="fa fa-refresh fa-spin"></i>
                        </button>
                        <button v-else type="submit" class="btn btn-primary btn-md">{{ this.trans('strings.effect_withdraw') }} </button>
                    </div>
                </div>
            </form>
		</div>
    </div>
</template>
