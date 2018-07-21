<template>
    <load-component v-if="loading.component == true"></load-component>
    <div class="container no-padding" v-else>
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link active show" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.my_games') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                    <!-- <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link> -->
                </div>
            </div>
        </div>
        <form class="user-edit" @submit.prevent="handleEdit" enctype="multipart/form-data">
            <input type="hidden" name="id" v-model="id">
            <div class="row">
                 <div class="col-lg-12">
                    <h3 class="page-header" style="margin-bottom: 22px; margin-top: 10px">
                        {{ trans('strings.account') }}
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <img v-if="photo" :src="photo_domain+photo" alt="" onclick="" style="" class="img-fluid" id="user-edit-photo">
                    <img v-else src="//www.lottoland.com/skins/lottoland/images/profile/profileImageDummySquare-9e4d5d1b70298254.png" alt="" onclick="" style="" class="img-fluid" id="user-edit-photo">
                    <label for="photo">Imagem do perfil (jpg ou png)</label>
                    <span @click="openImages" class="btn btn-primary btn-md">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>{{ trans('strings.select_an_image') }}</span>
                        <input accept="image/*" @change.prevent="changePhoto" type="file" name="photo" id="photo">
                    </span>
                    <span class="file-name">{{ trans('strings.no_file_selected') }}</span>
                    <label>Tamanho de arquivo até 5mb*</label>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-2 col-3 col-sm-2 col-md-2" style="padding-right: 0;">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.gender">
                                    <div v-for="(gender, index) in errors.gender" :key="index" >{{ gender }}</div>
                                </div>
                                <label for="gender">&nbsp;</label>
                                <select v-model="gender" name="gender" required class="form-control" id="gender" aria-describedby="gender" :placeholder="trans('strings.gender')">
                                    <option value="M" selected>Sr.</option>
                                    <option value="F">Srª</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-9 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="name">{{ trans('strings.name') }}</label>
                                <input readonly disabled v-model="name" type="text" class="form-control" id="name" aria-describedby="name" name="name" :placeholder="trans('strings.name')">
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="last_name">{{ trans('strings.last_name') }}</label>
                                <input disabled readonly v-model="last_name" type="text" class="form-control" id="last_name" aria-describedby="last_name" name="last_name" :placeholder="trans('strings.last_name')">
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="nickname">{{ trans('strings.user') }}</label>
                                <input v-model="nickname" type="text" class="form-control" id="nickname" aria-describedby="nickname" name="nickname" :placeholder="trans('strings.nickname')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.street">
                                    <div v-for="street in errors.street" >{{ street }}</div>
                                </div>
                                <label for="street">{{ trans('strings.street') }}</label>
                                <input v-model="street" type="text" class="form-control" id="street" aria-describedby="street" name="street" :placeholder="trans('strings.street')">
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 col-sm-2 col-md-2">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.number">
                                    <div v-for="number in errors.number" >{{ number }}</div>
                                </div>
                                <label for="number">{{ trans('strings.number') }}</label>
                                <input v-model="number" type="number" class="form-control" id="number" aria-describedby="number" name="number" :placeholder="trans('strings.number')">
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 col-sm-2 col-md-2">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.cep">
                                    <div v-for="(zip, index) in errors.cep" :key="index">{{ cep }}</div>
                                </div>
                                <label for="cep">{{ trans('strings.postal_code') }}</label>
                                <input v-model="cep" name="cep" type="number" class="form-control" id="cep" aria-describedby="cep" :placeholder="trans('strings.zip')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.city">
                                    <div v-for="(city, index) in errors.city" :key="index">{{ city }}</div>
                                </div>
                                <label for="city">{{ trans('strings.city') }}</label>
                                <input v-model="city" name="city" type="text" class="form-control" id="city" aria-describedby="city" :placeholder="trans('strings.city')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.complement">
                                    <div v-for="(street, index) in errors.complement" :key="index">{{ complement }}</div>
                                </div>
                                <label for="complement">{{ trans('strings.complement') }}</label>
                                <input v-model="complement" name="complement" type="text" class="form-control" id="complement" aria-describedby="complement" :placeholder="trans('strings.complement')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.country">
                                    <div v-for="(street, index) in errors.country" :key="index">{{ country }}</div>
                                </div>
                                <label for="country">{{ trans('strings.country') }}</label>
                                <!-- <input readonly disabled name="country" v-model="country" type="text" class="form-control" id="country" aria-describedby="country" :placeholder="trans('strings.country')"> -->
                                <vc-countries name="country" required v-model="country" :country="country" id="country" class="form-control" :countries="countries"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.username">
                                    <div v-for="(username, index) in errors.username" :key="index">{{ username }}</div>
                                </div>
                                <label for="username">E-mail</label>
                                <input disabled readonly v-model="username" name="username" required type="text" class="form-control" id="username" aria-describedby="username" :placeholder="trans('strings.email')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.state">
                                    <div v-for="(state, index) in errors.state" :key="index" >{{ state }}</div>
                                </div>
                                <label for="state">{{ trans('strings.state') }}</label>
                                <input v-model="state" name="state" type="text" class="form-control" id="state" aria-describedby="state" :placeholder="trans('strings.state')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.phone_code">
                                    <div v-for="(phone_code, index) in errors.phone_code" :key="index" >{{ phone_code }}</div>
                                </div>
                                <label for="phone_code">{{ trans('strings.code_country') }}</label>
                                <input readonly disabled v-model="phone_code" name="phone_code" type="text" class="form-control" id="phone_code" aria-describedby="phone_code" :placeholder="trans('strings.code_country')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.tell_phone">
                                    <div v-for="(tell_phone, index) in errors.tell_phone" :key="index">{{ tell_phone }}</div>
                                </div>
                                <label for="tell_phone">{{ trans('strings.tell_phone') }}</label>
                                <input v-model="tell_phone" name="tell_phone" type="number" class="form-control" id="tell_phone" aria-describedby="tell_phone" :placeholder="trans('strings.tell_phone')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.birth_date">
                                    <div v-for="(birth_date, index) in errors.birth_date" :key="index">
                                        {{ birth_date }}
                                    </div>
                                </div>
                                <label for="birth_date">{{ trans('strings.birth_date') }}</label>
                                <datepicker :value="birth_date" name="birth_date" required v-model="birth_date" type="text" class="form-control" id="birth_date" />
                                <!-- <input disabled readonly v-model="birth_date" type="text" class="form-control" id="birth_date" aria-describedby="birth_date" :placeholder="trans('strings.birth_date')"> -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.id">
                                    <div v-for="id in errors.id" >{{ id }}</div>
                                </div>
                                <label for="id">{{ trans('strings.player_number') }}</label>
                                <input disabled readonly v-model="id" name="id" type="text" class="form-control" id="id" aria-describedby="id" :placeholder="trans('strings.player_number')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.old_password">
                                    <div v-for="old_password in errors.old_password" >{{ old_password }}</div>
                                </div>
                                <label for="old_password">{{ trans('strings.old_password') }}</label>
                                <input v-model="old_password" name="old_password" type="password" class="form-control" id="old_password" aria-describedby="old_password" :placeholder="trans('strings.old_password')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.password">
                                    <div v-for="password in errors.password" >{{ password }}</div>
                                </div>
                                <label for="password">{{ trans('strings.password') }}</label>
                                <input v-model="password" name="password" type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.confirm_password">
                                    <div v-for="confirm_password in errors.confirm_password" >{{ confirm_password }}</div>
                                </div>
                                <label for="confirm_password">{{ trans('strings.confirm_password') }}</label>
                                <input v-model="confirm_password" name="confirm_password" type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password" :placeholder="trans('strings.confirm_password')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <router-link :to="{ name: 'users.disable' }" class="pull-left">
                                {{ trans('strings.to_disable') }} {{ trans('strings.account') }}
                            </router-link>
                            <button @click.prevent="" v-if="loading.submit" class="pull-right btn btn-md btn-primary">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                            <button type="submit" v-else class="btn pull-right btn-md btn-primary">
                                {{ trans('strings.save_button') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {routes} from '../../api_routes'
    import LoadComponent from '../Load'
    export default {
        metaInfo () {
            return {
                title: this.trans('strings.account') + ' | '+this.trans('strings.lottoyou'),
                meta: [
                    {
                        name: 'description', 
                        content: this.trans('strings.account')
                    }
                ]
            }
        },
        watch: {
            birth_date (newValue, oldValue) {},
            countries (newValue, oldValue) {},
            country (newValue, oldValue) {
                this.countries.forEach(element => {
                    if(element.id == newValue) {
                        this.phone_code = '+'+element.phonecode;
                    }
                });
            }
        },
        methods: {
            changePhoto: function(event) {
                var file = null;
                var form = $('.user-edit');
                file = event.currentTarget.files[0];
                
                var acceptFileTypes = /^image\/(jpg|jpeg|png)$/i;
                if (!acceptFileTypes.test(file['type'])) {
                    toastr.error(this.trans('strings.invalid_file'));
                } else if(file.size > 5000000) {
                    toastr.error(this.trans('strings.size_larger_than_allowed'));
                } else {

                    if(window.FileReader){
                        if(file.type.indexOf('image') >= 0){
                            $('.file-name').text(file.name);
                            var reader = new FileReader();
                            reader.onprogress = function(evt) {
                                
                            };
                            reader.onloadend = function(e){
                                form.find('#user-edit-photo').attr('src', e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }    
                }        
            },
            handleEdit: function(event) {
                let vm = this;
                let form = $(event.currentTarget);
                let formData = new FormData(form[0]);
                formData.append('_method', 'put');

                let updateRequest = axios.create();

                updateRequest.interceptors.request.use(config => {
                    this.loading.submit = true;
                    return config;
                });
                updateRequest.post(
                    routes.users.update.replace('{id}', this.id), 
                    formData, 
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(response => {
                    if(response.status === 200) {
                        const access_token = JSON.parse(window.localStorage.getItem('access_token'));
                        const refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
                        //const authUser = this.user;
                        let authRequest = axios.create();
                        //Fazendo busca do usuário logado, para setar na estrutura de dados
                        authRequest.get(routes.auth.user, { headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + access_token
                        }}).then(response_2 => {
                            this.loading.submit = false;
                            response_2.data['access_token'] = access_token;
                            response_2.data['refresh_token'] = refresh_token;
                            //window.localStorage.setItem('authUser', JSON.stringify(response_2.data))
                            this.$store.dispatch('setUserObject', response_2.data);
                            
                            toastr.options = {
                                closeButton: true,
                                positionClass: "toast-top-center",
                            };
                            toastr.success(
                                this.trans('alerts.users.update.success')
                            );
                            
                            this.user = response_2.data                   
                            this.errors = [];
                            this.gender = this.user.gender ? this.user.gender : '';
                            this.nickname = this.user.nickname;
                            this.name = this.user.name;
                            this.last_name = this.user.last_name;
                            this.address = this.user.address;
                            this.street = this.user.street;
                            this.number = this.user.number;
                            this.photo_domain = this.user.photo_domain;
                            this.cep = this.user.cep;
                            this.photo = this.user.photo;
                            this.city = this.user.city;
                            this.username = this.user.username;
                            this.state = this.user.state;
                            this.birth_date = this.user.birth_day + '/' +this.user.birth_month + '/' + this.user.birth_year; 
                            this.id = this.user.id;
                            this.complement = this.user.complement
                            this.country = this.user.country.id
                            this.phone_code = '+'+this.user.country.phonecode;

                            //window.location.href = "/painel"
                            //this.$router.push({name: 'home'});
                        }).catch((error_2) => {
                            this.loading.submit = false;
                        });
                        this.errors = [];
                    }
                }).catch((error) => {
                    this.loading.submit = false;
                    swal({
                        title: this.trans('alerts.users.update.error'),
                        text: false,
                        showCloseButton: true,
                        imageUrl: '/imgs/logo.png',
                        imageHeight: 50,
                        imageAlt: 'Logo lottoyou',
                    });                
                    this.errors = error.response.data.errors != undefined ? error.response.data.errors : [];
                    //toastr.error(this.trans('alerts.users.update.error'));                    
                });
            },
            openImages () {
                document.getElementById('photo').click();
            },
            userRequest () {
                const access_token = JSON.parse(window.localStorage.getItem('access_token'));            

                var userRequest = axios.create();
                userRequest.interceptors.request.use(config => {
                    this.loading.component = true
                    return config;
                });

                //Fazendo busca do usuário logado, para setar na estrutura de dados
                userRequest.get(routes.auth.user, { headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + access_token
                }}).then(response => {
                    this.loading.component = false;
                    response.data['access_token'] = access_token;
                    //window.localStorage.setItem('authUser', JSON.stringify(response.data))
                    this.$store.dispatch('setUserObject', response.data)
                    this.user = response.data                            

                    this.errors = [];

                    this.gender = this.user.gender ? this.user.gender : '';
                    this.nickname = this.user.nickname;
                    this.name = this.user.name;
                    this.last_name = this.user.last_name;
                    this.address = this.user.address;
                    this.street = this.user.street;
                    this.number = this.user.number;
                    this.cep = this.user.cep;
                    this.photo = this.user.photo;
                    this.photo_domain = this.user.photo_domain;
                    this.city = this.user.city;
                    this.username = this.user.username;
                    this.state = this.user.state;
                    this.id = this.user.id;
                    this.complement = this.user.complement
                    this.country = this.user.country.id;
                    this.phone_code = '+'+this.user.country.phonecode;

                    if(this.user.validated == 0) {
                        swal({
                            title: 'Seu cadastro está incompleto.',
                            text: 'Atenção: Para retirada do dinheiro seu cadastro deverá estar completo.',
                            showCloseButton: true,
                            imageUrl: '/imgs/logo.png',
                            imageHeight: 50,
                            imageAlt: 'Logo lottoyou',
                        });  
                    } 

                    if(this.user.birth_day != null) {
                        this.birth_date = this.user.birth_day + '/' +this.user.birth_month + '/' + this.user.birth_year; 
                    }
                    //this.birth_date = this.user.birth_day + '/' +this.user.birth_month + '/' + this.user.birth_year; 
                    
                }).catch((error) => {
                    this.loading.component = false
                });
            },
        },
        data: function() {
            return {
                gender: '',
                name: '',
                photo_domain: '',
                last_name: '',
                address: '',
                street: '',
                photo: '',
                number: '',
                cep: '',
                city: '',
                username: '',
                state: '',
                birth_date: '',
                id: '',
                old_password: '',
                password: '',
                confirm_password: '',
                complement: '',
                country: '',
                tell_phone: '',
                phone_code: '',
                nickname: '',
                countries: [],
                errors: [],
                loading: {
                    component: true,
                    submit: false,
                }
            }
        },
        mounted: function() {
            /* let authUser = JSON.parse(window.localStorage.getItem('authUser'));
            authUser = authUser != null ? authUser : null; */
            /* if(authUser.provider != '') {
                this.loading.component = false;
                this.gender = authUser.gender ? authUser.gender : '';
                this.nickname = authUser.nickname;
                this.name = authUser.name;
                this.last_name = authUser.last_name;
                this.address = authUser.address;
                this.street = authUser.street;
                this.number = authUser.number;
                this.cep = authUser.cep;
                this.photo = authUser.photo;
                this.city = authUser.city;
                this.username = authUser.username;
                this.state = authUser.state;
                this.birth_date = 31 + '/' +12+ '/' + 1994; 
                this.id = authUser.id;
                this.complement = authUser.complement
                this.country = authUser.country.name
                this.phone_code = '+'+authUser.country.phonecode
            } else {
                this.userRequest();
            }          */ 
            this.userRequest();
            this.getCountries((countries) => {
                this.countries = countries;
            });
        },
        components: {
            LoadComponent
        }
    }
</script>

<style scoped>
    .file-name {
        display: block;
    }

    #photo {
        display: none;
    }
</style>