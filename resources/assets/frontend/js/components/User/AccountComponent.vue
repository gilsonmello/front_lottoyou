<template>    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link active show" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                        {{ trans('strings.games') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                        {{ trans('strings.transactions') }}
                    </router-link>
                    <router-link class="nav-link" :to="{ name: 'users.orders', params: {  } }">
                        {{ trans('strings.orders') }}
                    </router-link>
                </div>
            </div>
        </div>                       
        <edit-component></edit-component>
    </div>	
</template>

<script>
    import {routes} from '../../api_routes'
    import EditComponent from './components/EditComponent.vue'
	export default {
        data: function() {
            return {
                loading: {
                    component: true
                },
                auth: JSON.parse(window.localStorage.getItem('authUser')),
            }
        },
		mounted: function() {
            
        },
		methods: {
            
		},
        components: {
            EditComponent
        }
	}

</script>

<style scoped>
	
</style>