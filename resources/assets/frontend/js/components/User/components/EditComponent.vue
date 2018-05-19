<template>
    <load-component v-if="loading.component == true"></load-component>
    <div class="container no-padding" v-else>
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
                    <img v-if="photo" :src="photo" alt="" onclick="" style="" class="img-fluid" id="user-edit-photo">
                    <img v-else src="//www.lottoland.com/skins/lottoland/images/profile/profileImageDummySquare-9e4d5d1b70298254.png" alt="" onclick="" style="" class="img-fluid" id="user-edit-photo">
                    <label for="photo">Selecione a imagem do perfil</label>
                    <input accept="image/*" @change.prevent="changePhoto" type="file" name="photo" id="photo">
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-2 col-2 col-sm-2 col-md-2" style="padding-right: 0;">
                            <div class="form-group">
                                <label for="gender">&nbsp;</label>
                                <select v-model="gender" required class="form-control" id="gender" aria-describedby="gender" :placeholder="trans('strings.gender')">
                                    <option value="M" selected>Sr.</option>
                                    <option value="F">Srª</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
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
                                <label for="nickname">{{ trans('strings.nickname') }}</label>
                                <input disabled readonly v-model="nickname" type="text" class="form-control" id="nickname" aria-describedby="nickname" name="nickname" :placeholder="trans('strings.nickname')">
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
                        <div class="col-lg-2 col-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.number">
                                    <div v-for="number in errors.number" >{{ number }}</div>
                                </div>
                                <label for="number">{{ trans('strings.number') }}</label>
                                <input v-model="number" type="text" class="form-control" id="number" aria-describedby="number" name="number" :placeholder="trans('strings.number')">
                            </div>
                        </div>
                        <div class="col-lg-2 col-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.cep">
                                    <div v-for="zip in errors.cep" >{{ cep }}</div>
                                </div>
                                <label for="cep">{{ trans('strings.zip') }}</label>
                                <input v-model="cep" name="cep" type="text" class="form-control" id="cep" aria-describedby="cep" :placeholder="trans('strings.zip')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.city">
                                    <div v-for="city in errors.city" >{{ city }}</div>
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
                                    <div v-for="street in errors.complement" >{{ complement }}</div>
                                </div>
                                <label for="complement">{{ trans('strings.complement') }}</label>
                                <input v-model="complement" name="complement" type="text" class="form-control" id="complement" aria-describedby="complement" :placeholder="trans('strings.complement')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.country">
                                    <div v-for="street in errors.country" >{{ country }}</div>
                                </div>
                                <label for="country">{{ trans('strings.country') }}</label>
                                <input readonly disabled name="country" v-model="country" type="text" class="form-control" id="country" aria-describedby="country" :placeholder="trans('strings.country')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.username">
                                    <div v-for="username in errors.username" >{{ username }}</div>
                                </div>
                                <label for="username">E-mail</label>
                                <input v-model="username" name="username" required type="text" class="form-control" id="username" aria-describedby="username" :placeholder="trans('strings.username')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.state">
                                    <div v-for="state in errors.state" >{{ state }}</div>
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
                                    <div v-for="phone_code in errors.phone_code" >{{ phone_code }}</div>
                                </div>
                                <label for="phone_code">{{ trans('strings.code_country') }}</label>
                                <input readonly disabled v-model="phone_code" name="phone_code" type="text" class="form-control" id="phone_code" aria-describedby="phone_code" :placeholder="trans('strings.code_country')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.tell_phone">
                                    <div v-for="tell_phone in errors.tell_phone" >{{ tell_phone }}</div>
                                </div>
                                <label for="tell_phone">{{ trans('strings.tell_phone') }}</label>
                                <input v-model="tell_phone" name="tell_phone" type="text" class="form-control" id="tell_phone" aria-describedby="tell_phone" :placeholder="trans('strings.tell_phone')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.date_birth">
                                    <div v-for="date_birth in errors.date_birth" >{{ date_birth }}</div>
                                </div>
                                <label for="date_birth">{{ trans('strings.date_birth') }}</label>
                                <input disabled readonly v-model="date_birth" type="text" class="form-control" id="date_birth" aria-describedby="date_birth" :placeholder="trans('strings.date_birth')">
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
                            <button type="submit" class="btn pull-right btn-md btn-info">
                                {{ trans('strings.save_button') }}
                            </button>
                            <button @click.prevent="" type="load" class="hide pull-right btn btn-md btn-info">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {routes} from '../../../api_routes'
    import LoadComponent from '../../Load'
    export default {
        methods: {
            changePhoto: function(event) {
                var file = null;
                var form = $('.user-edit');
                file = event.currentTarget.files[0];
                if(window.FileReader){
                    if(file.type.indexOf('image') >= 0){
                        var reader = new FileReader();
                        reader.onprogress = function(evt) {
                            
                        };
                        reader.onloadend = function(e){
                            form.find('#user-edit-photo').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }            
            },
            handleEdit: function(event) {
                var vm = this;
                var form = $(event.currentTarget);
                var formData = new FormData(form[0]);
                formData.append('_method', 'put');

                var updateRequest = axios.create();

                updateRequest.interceptors.request.use(config => {
                    $(this.$el).find('[type="load"]').removeClass('hide');
                    $(this.$el).find('[type="submit"]').addClass('hide');
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
                        const authUser = this.user;
                        var authRequest = axios.create();
                        //Fazendo busca do usuário logado, para setar na estrutura de dados
                        authRequest.get(routes.auth.user, { headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + access_token
                        }}).then(response_2 => {

                            $(this.$el).find('[type="load"]').addClass('hide');
                            $(this.$el).find('[type="submit"]').removeClass('hide');
                            response_2.data['access_token'] = access_token;
                            response_2.data['refresh_token'] = refresh_token;
                            window.localStorage.setItem('authUser', JSON.stringify(response_2.data))
                            this.$store.dispatch('setUserObject', response_2.data);
                            toastr.success(this.trans('alerts.users.update.success'));
                            
                            this.user = response_2.data                   
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
                            this.city = this.user.city;
                            this.username = this.user.username;
                            this.state = this.user.state;
                            this.date_birth = this.user.birth_day + '/' +this.user.birth_month + '/' + this.user.birth_year; 
                            this.id = this.user.id;
                            this.complement = this.user.complement
                            this.country = this.user.country.name
                            this.phone_code = '+'+this.user.country.phonecode

                            //window.location.href = "/painel"
                            //this.$router.push({name: 'home'});
                        }).catch((error_2) => {
                            $(this.$el).find('[type="load"]').addClass('hide');
                            $(this.$el).find('[type="submit"]').removeClass('hide');
                            
                        });
                        this.errors = [];
                    }
                }).catch((error) => {
                    
                    this.errors = error.response.data.errors
                    toastr.success(this.trans('alerts.users.update.error'));
                    $(this.$el).find('[type="load"]').addClass('hide');
                    $(this.$el).find('[type="submit"]').removeClass('hide');                    
                });
            }
        },
        data: function() {
            return {
                gender: '',
                name: '',
                last_name: '',
                address: '',
                street: '',
                photo: '',
                number: '',
                cep: '',
                city: '',
                username: '',
                state: '',
                date_birth: '',
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
                    component: true
                }
            }
        },
        mounted: function() {

            const access_token = JSON.parse(window.localStorage.getItem('access_token'));            

            var authRequest = axios.create();
            authRequest.interceptors.request.use(config => {
                this.loading.component = true
                return config;
            });

            //Fazendo busca do usuário logado, para setar na estrutura de dados
            authRequest.get(routes.auth.user, { headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + access_token
            }}).then(response => {
                response.data['access_token'] = access_token;
                window.localStorage.setItem('authUser', JSON.stringify(response.data))
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
                this.city = this.user.city;
                this.username = this.user.username;
                this.state = this.user.state;
                this.date_birth = this.user.birth_day + '/' +this.user.birth_month + '/' + this.user.birth_year; 
                this.id = this.user.id;
                this.complement = this.user.complement
                this.country = this.user.country.name
                this.phone_code = '+'+this.user.country.phonecode

                this.loading.component = false
                
            }).catch((error) => {
                this.loading.component = false
            });

        },
        components: {
            LoadComponent
        }
    }
</script>

<style scoped>

</style>