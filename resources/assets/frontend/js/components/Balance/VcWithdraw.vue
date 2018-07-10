<style scoped>

</style>

<script>
import {mapGetters} from 'vuex';
import {routes} from '../../api_routes'
export default {
    computed: {
        ...mapGetters([
            'auth'
        ])
    },
    metaInfo () {
        return {
            title: this.trans('strings.withdraw') + ' | '+this.trans('strings.lottoyou'),
            meta: [
                {
                    name: 'description', 
                    content: this.trans('strings.withdraw') + ' | '+this.trans('strings.lottoyou')
                }
            ]
        }
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
            this.amount = VMasker.toMoney('10.00', {
                // Decimal precision -> "90"
                precision: 2,
                // Decimal separator -> ",90"
                separator: '.',
                // Number delimiter -> "12.345.678"
                delimiter: ',',
                unit: '$',
            });
            let vm = this;
            this.setMask();
            $("#amount").on("blur", function(event) {
                let value = $(this).val();
                vm.amount = value;
                value = parseFloat(vm.getAmount());
                vm.value = parseFloat(value).format(2, true);
                if(value > vm.auth.balance.value) {
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
        requestWithdraw() {
            let request = axios.create();
            request.interceptors.request.use(config => {
                this.loading.submit = true;
                return config;
            });
            
            let url = routes.balance.withdraw;
            
            request.post(url, {
                owner_id: this.auth.id,
                value: this.value
            }).then(response => {
                if(response.status === 200) {
                    if(response.data.message) {
                        toastr.success(response.data.message);
                    }
                    this.loading.submit = false;
                    this.$router.push({
                        name: 'users.transactions'
                    });
                }
            }).catch((error) => {
                this.loading.submit = false;
            })
        },
        submitWithdraw(el) {
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
                        this.requestWithdraw();
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
            VMasker(document.querySelector("#amount")).maskMoney({
                // Decimal precision -> "90"
                precision: 2,
                // Decimal separator -> ",90"
                separator: '.',
                // Number delimiter -> "12.345.678"
                delimiter: ',',
                unit: '$',
            });
        },
    }
  }
</script>

<template>
    <load v-if="loading.component"></load>
    <div class="container" v-else>
        <h1 class="page-header">{{trans('strings.withdraw')}} {{trans('strings.funds')}}</h1>
        <form @submit.prevent="submitWithdraw($el)" v-if="auth.balance.value >= 10">
            <div class="row">
                <div class="col-lg-3 col-12 col-sm-3 col-md-3">
                    <strong>
                        <label for="amount">* Quantia a ser retirada &nbsp;
                            <i class="fa fa-info" title="Mínimo de $1.00"></i>
                        </label>
                    </strong>
                    <input type="text" v-model="amount" required class="form-control" id="amount" :placeholder="'Por favor, indique o valor em USD'">
                </div>
                <div class="col-lg-4 col-12 col-md-4 col-sm-4">
                    <strong>
                        <label for="value">
                            {{ trans('strings.left_balance') }}: ${{ parseFloat(auth.balance.value - value).format(2, true) }}
                        </label>
                    </strong>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <input type="checkbox" v-model="terms" required name="terms" id="terms">
                    &nbsp;Eu li e aceito os <router-link :to="{ name: 'terms' }" target="_blank">termos e condições</router-link> de uso deste site.
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
</template>


