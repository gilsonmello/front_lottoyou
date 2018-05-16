<template>
	<div class="container">
		<div class="row">
            <div class="col-lg-12">
                <div class="sub-navigation">
                    <router-link class="nav-link" :to="{ name: 'users.account', params: {  } }">
                        {{ trans('strings.profile') }}
                    </router-link>
                        <router-link class="nav-link active show" :to="{ name: 'users.games', params: {  } }">
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


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.soccer_experts', params: {  } }">
                    {{ trans('strings.soccer_expert') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link active show" :to="{ name: 'users.scratch_cards', params: {  } }">
                    {{ trans('strings.scratch_cards') }}
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'users.lotteries', params: {  } }">
                    {{ trans('strings.lotteries') }}
                </router-link>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show">                
                Raspadinhas
            </div>
        </div>
	</div>
</template>

<script>
	export default {

	}
</script>

<style scoped>
	
</style>