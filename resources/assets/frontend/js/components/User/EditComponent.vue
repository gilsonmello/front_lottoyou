<template>
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                <h3 class="page-header" style="margin: 0">
                    {{ trans('strings.account') }}
                    <button class="btn btn-success pull-right">{{ trans('strings.edit') }}</button>
                </h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3">
                <img src="//www.lottoland.com/skins/lottoland/images/profile/profileImageDummySquare-9e4d5d1b70298254.png" alt="" onclick="" style="" class="img-fluid">
            </div>
            <div class="col-lg-9">
                <form>
                    <div class="row">
                        <div class="col-lg-2 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.email">
                                    <div v-for="email in errors.email" >{{ email }}</div>
                                </div>
                                <label for="gender">{{ trans('strings.title') }}</label>
                                <input v-model="gender" required type="email" class="form-control" id="gender" aria-describedby="gender" :placeholder="trans('strings.gender')">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.email">
                                    <div v-for="email in errors.email" >{{ email }}</div>
                                </div>
                                <label for="name">{{ trans('strings.name') }}</label>
                                <input v-model="name" required type="text" class="form-control" id="name" aria-describedby="name" :placeholder="trans('strings.name')">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="alert alert-danger" v-if="errors.email">
                                    <div v-for="email in errors.email" >{{ email }}</div>
                                </div>
                                <label for="last_name">{{ trans('strings.last_name') }}</label>
                                <input v-model="last_name" required type="text" class="form-control" id="last_name" aria-describedby="last_name" :placeholder="trans('strings.last_name')">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                auth: JSON.parse(window.localStorage.getItem('authUser')),
                gender: '',
                name: '',
                last_name: '',
                errors: []
            }
        },
        mounted: function() {
            this.gender = this.auth.gender;
            this.name = this.auth.name;
            this.last_name = this.auth.last_name;
            console.log('edit')
        }
    }
</script>

<style scoped>

</style>