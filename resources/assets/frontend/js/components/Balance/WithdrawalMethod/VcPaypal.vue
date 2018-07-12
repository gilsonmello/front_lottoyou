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
            this.validateFormPaypal();
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
            
        },
        requestPaypal() {
            let request = axios.create();
            request.interceptors.request.use(config => {
                this.loading.submit = true;
                return config;
            });
            
            let url = routes.balance.paypal_withdraw;
            
            request.post(url, {
                owner_id: this.auth.id,
                value: this.value
            }).then(response => {
                if(response.status === 200) {
                    this.loading.submit = false;
                    /*this.refreshAuth();
                    if(response.data.message) {
                        toastr.success(response.data.message);
                    }
                    this.$router.push({
                        name: 'users.transactions'
                    });*/
                }
            }).catch((error) => {
                if(error.response.data.message) {
                    toastr.error(error.response.data.message);
                }
                this.loading.submit = false;
            })
        },
        submitPaypal(el) {
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
                        this.requestPaypal();
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
        validateFormPaypal() {
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
                            terms: {
                                required: true,
                            },
                        },
                        messages: {
                            terms: {
                                required: vm.trans('strings.field_required'),
                            },
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
                            vm.submitPaypal();
                        }
                    });
                }
            });
        }
    }
  }
</script>

<template>
    <load v-if="loading.component"></load>
    <div class="row" v-else>
		<div class="col-lg-12">
            <h6 class="choice-payment-method-msg"><strong>Você escolheu o Paypal como forma de retirada </strong></h6>
            <h5>
            </h5>
            <!-- <h1 class="page-header">{{trans('strings.withdraw')}} {{trans('strings.funds')}}</h1> -->
            <form v-if="auth.balance.value >= 10" action="https://svcs.sandbox.paypal.com/AdaptivePayments/Pay">
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
