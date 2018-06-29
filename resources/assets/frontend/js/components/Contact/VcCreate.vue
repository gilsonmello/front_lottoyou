<template>
    <load-component v-if="loading.component"></load-component>
    <div class="container" v-else>
        <h2 class="page-header">Entre em contato conosco</h2>
        <form id="contacts-create">
            <div class="row">
                <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="contacts-name">{{ trans('strings.name') }}*</label>
                        <input name="name" v-model="name" type="text" class="form-control" id="contacts-name" aria-describedby="name" :placeholder="trans('strings.name')">
                    </div>
                </div>
                <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="contacts-email">{{ trans('strings.email') }}*</label>
                        <input name="email" v-model="email" type="email" class="form-control" id="contacts-email" aria-describedby="email" :placeholder="trans('strings.email')">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="contacts-category">{{ trans('strings.category') }}*</label>
                        <select name="category" id="contacts-category" v-model="category" class="form-control" :placeholder="trans('strings.category')">
                            <option :key="index" :value="value.id" v-for="(value, index) in categories">
                                {{ value.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="contacts-subject">{{ trans('strings.subject') }}*</label>
                        <input name="subject" v-model="subject" type="text" class="form-control" id="contacts-subject" aria-describedby="name" :placeholder="trans('strings.subject')">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="contacts-description">{{ trans('strings.description') }}*</label>
                        <textarea name="description" v-model="description" class="form-control" id="contacts-description" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <vc-recaptcha :sitekey="sitekey" :callback="recaptchaCallback"></vc-recaptcha>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <button type="submit" v-if="!loading.submit" class="btn btn-md btn-primary">
                        {{ trans('strings.save_button') }}
                    </button>
                    <button v-else @click.prevent="" type="submit" class="hide btn btn-md btn-primary">
                        <i class="fa fa-refresh fa-spin"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {routes} from '../../api_routes'
    import LoadComponent from '../Load'
    import VcRecaptcha from '../VcRecaptcha'
    export default {
        name: "VcCreate",
        data() {
            return {
                name: '',
                description: '',
                email: '',
                categories: [],
                subject: '',
                category: 1,
                loading: {
                    component: true,
                    submit: false,
                },
                sitekey: '6LeNc2EUAAAAABpFaOINnceFbni9gooWNYAMHkC6',
                token: '',
            }
        },
        methods: {
            recaptchaCallback(token) {
                this.token = token;
            },
            recaptchaCheckRequest() {
                let recaptchaCheckRequest = axios.create();
                return recaptchaCheckRequest.post(routes.recaptcha.check, {
                    token: this.token,
                    sitekey: this.sitekey
                });
            },
            getCategories() {
                let categoriesRequest = axios.create();
                categoriesRequest.get(routes.contacts.categories)
                .then((response) => {
                    if(response.status === 200) {
                        this.categories = response.data;
                    }
                }).catch((response) => {

                });
            },
            store() {
                this.recaptchaCheckRequest().then((response) => {
                    if(response.status === 200 && response.data == true) {
                        
                        let storeRequest = axios.create();
                        storeRequest.post(routes.contacts.create, {
                            name: this.name,
                            email: this.email,
                            category: this.category,
                            description: this.description,
                            subject: this.subject
                        }).then((response) => {
                            if(response.status === 200) {
                                toastr.options.timeOut = 5000;
                                toastr.options.newestOnTop = true;
                                toastr.success(
                                    this.trans('alerts.contacts.create.success'),
                                    this.trans('strings.success')
                                );
                            }
                        }).catch((response) => {
                            toastr.options.timeOut = 3000;
                            toastr.options.newestOnTop = true;
                            toastr.error(
                                this.trans('alerts.contacts.create.error'),
                                this.trans('strings.error')
                            );
                        });

                    } else {
                       toastr.error(
                            'Captcha inválido',
                            this.trans('strings.error')
                        ); 
                    }
                }).catch((response) => {
                    toastr.error(
                        'Captcha inválido',
                        this.trans('strings.error')
                    );
                });
                
            }
        },
        mounted() {
            this.getCategories();
            window.document.title = this.trans('crud.contacts.create');
            this.loading.component = false;
            var vm = this;

            let time = setInterval(() => {
                if($('#contacts-create').length > 0) {
                    clearInterval(time);
                    $('#contacts-create').validate({
                        rules: {
                            email: {
                                required: true,
                                email: true,
                            },
                            description: {
                                required: true,
                            },
                            name: {
                                required: true,
                            },
                            subject: {
                                required: true,
                            }
                        },
                        messages: {
                            name: {
                                required: 'Campo Obrigatório',
                            },
                            description: {
                                required: 'Campo Obrigatório',
                            },
                            subject: {
                                required: 'Campo Obrigatório',
                            },
                            email: {
                                required: 'Campo Obrigatório',
                                email: 'Informe um e-mail válido',
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
                    $('#contacts-create').on('submit', function(e) {
                        var isvalid = $('#contacts-create').valid();
                        if (isvalid) {
                            e.preventDefault();
                            vm.store();
                        }
                    });
                }
            })

        },
        components: {
            LoadComponent,
            VcRecaptcha
        }
    }
</script>

<style scoped>
</style>