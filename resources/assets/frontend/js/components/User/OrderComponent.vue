<template>
	<load-component v-if="loading.component == true"></load-component>
	
	<div class="container" v-else>
        <h3 class="">&nbsp;</h3>
        <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                    {{ trans('strings.profile') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.games', params: {  } }">
                    {{ trans('strings.games') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.transactions', params: {  } }">
                    {{ trans('strings.transactions') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link active show" :to="{ name: 'users.orders', params: {  } }">
                    {{ trans('strings.orders') }}
                </router-link>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show">                
                Order
            </div>
        </div>
	</div>
	
</template>

<script>
	import LoadComponent from '../Load'
	export default {
 		data: function() {
            return {
                loading: {
                    component: true
                }
            }
        },
		mounted: function() {
            this.loading.component = false;
        },
		methods: {
			
		},
        components: {
            LoadComponent
        }
	}
</script>

<style scoped>
	
</style>