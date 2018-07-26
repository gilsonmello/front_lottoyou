@section('title', trans('strings.register') .' | '.trans('strings.lottoyou'))

@section('description', '')

@section('author', trans('strings.lottoyou'))

@extends('layouts.frontend.bot')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Crie uma conta para desfrutar de infinitas possibilidades</h1>
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                <a class="btn btn-social btn-facebook" @click.prevent="loginFacebook">
                    <span class="fa fa-facebook"></span> Cadastre-se com o facebook
                </a>
            </div>
        </div>
        <form @submit.prevent="register">
            <div class="row">
                <div class="col-lg-9 col-12 col-sm-12 col-md-12" style="padding-right: 30px;">
                    <div class="row">
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="email">{{ trans('strings.email') }}*</label>
                                <input v-model="email" required type="email" class="form-control" id="email" aria-describedby="email" :placeholder="trans('strings.email')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="password">{{ trans('strings.password') }}*</label>
                                <input v-model="password" required type="password" class="form-control" id="password" aria-describedby="password" :placeholder="trans('strings.password')">
                                <div class="alert alert-danger" v-if="errors.password">
                                    <div v-for="password in errors.password">
                                        {{ password }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="confirm_password">{{ trans('strings.confirm_password') }}*</label>
                                <input v-model="confirm_password" required type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password" :placeholder="trans('strings.confirm_password')">
                                <div class="alert alert-danger" v-if="errors.confirm_password">
                                    <div v-for="confirm_password in errors.confirm_password">
                                        {{ confirm_password }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-12 col-sm-4 col-md-4" style="padding-right: 0;">
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
                                <label for="name">{{ trans('strings.name') }}*</label>
                                <input v-model="name" required type="text" class="form-control" id="name" aria-describedby="name" :placeholder="trans('strings.name')">
                                <div class="alert alert-danger" v-if="errors.name">
                                    <div v-for="name in errors.name" >{{ name }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="last_name">{{ trans('strings.last_name') }}*</label>
                                <input v-model="last_name" required type="text" class="form-control" id="last_name" aria-describedby="last_name" :placeholder="trans('strings.last_name')">
                                <div class="alert alert-danger" v-if="errors.last_name">
                                    <div v-for="last_name in errors.last_name" >{{ last_name }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="nickname">{{ trans('strings.user') }}*</label>
                                <input v-model="nickname" required type="text" class="form-control" id="nickname" aria-describedby="nickname" :placeholder="trans('strings.nickname')">
                                <div class="alert alert-danger" v-if="errors.nickname">
                                    <div v-for="nickname in errors.nickname" >{{ nickname }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="birth_day">Data nasc.*</label>
                        </div>
                        <div class="col-12 col-lg-6 no-mobile">
                            <label for="birth_day">{{ trans('strings.country') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4 col-3">
                                    <div class="form-group">
                                        <!--<label for="birth_day">&nbsp;</label>-->
                                        <select v-model="birth_day" class="form-control" id="birth_day">
                                            <option :value="day" v-for="day in days">
                                                {{ day }}
                                            </option>
                                        </select>
                                        <div class="alert alert-danger" v-if="errors.birth_day">
                                            <div v-for="birth_day in errors.birth_day" >{{ birth_day }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 col-3">
                                    <div class="form-group">
                                        <!--<label for="birth_month">&nbsp;</label>-->
                                        <select v-model="birth_month" class="form-control" id="birth_month" @change="changeBirthMonth">
                                            <option :value="month.value" :data-key="key" v-for="(month, key) in months">
                                                {{ month.name }}
                                            </option>
                                        </select>
                                        <div class="alert alert-danger" v-if="errors.birth_month">
                                            <div v-for="birth_month in errors.birth_month" >{{ birth_month }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 col-6">
                                    <div class="form-group">
                                        <!--<label for="birth_year">&nbsp;</label>-->
                                        <select v-model="birth_year" class="form-control" id="birth_year">
                                            <option :value="val" v-for="(val, index) in rangeYear(1900, date.getFullYear() - 18)">
                                                {{ val }}
                                            </option>
                                        </select>
                                        <div class="alert alert-danger" v-if="errors.birth_year">
                                            <div v-for="birth_year in errors.birth_year" >{{ birth_year }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="mobile" for="country">{{ trans('strings.country') }}</label>
                                <select v-model="country" class="form-control" id="country">
                                    <option :value="value.id" v-for="value in countries">
                                        {{ value.name }}
                                    </option>
                                </select>
                                <div class="alert alert-danger" v-if="errors.country">
                                    <div v-for="country in errors.country" >{{ country }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label class="" for="terms">
                                    <input type="checkbox" v-model="terms" name="terms" id="terms">
                                    Li e aceito os <a class="btn-link" href="/termos_e_condicoes.pdf" target="_blank">
                                        Termos e Condições
                                    </a>
                                </label>
                                <div class="alert alert-danger" v-if="errors.terms">
                                    <div v-for="term in errors.terms" >{{ term }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                            <button type="submit" class="pull-right btn btn-md btn-primary">
                                {{ trans('strings.save_button') }}
                            </button>
                            <button @click.prevent="" type="load" class="hide btn btn-md btn-primary">
                                <i class="fa fa-refresh fa-spin"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-3 col-12 col-md-4 col-sm-12 text-center" style="padding-left: 0px; padding-right: 0; margin-left: -15px;">
                    <div class="banner" style="position: relative">
                        <img class="img-fluid propaganda" src="/img/572x700_marca_22.png">
                        <div class="content">
                            <h1 class="" style="">
                                Aqui<br> é mais<br> fácil
                            </h1>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection