<template>
    <load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
        <h3 class="">&nbsp;</h3>
        <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="edit-component" data-toggle="pill" href="#edit">
                    {{ trans('strings.profile') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="game-component" data-toggle="pill" href="#game">
                    {{ trans('strings.games') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="transaction-component" data-toggle="pill" href="#transaction" >
                    {{ trans('strings.transactions') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="order-component" data-toggle="pill" href="#order" >
                    {{ trans('strings.orders') }}
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div v-if="active_tab == 'edit-component'" class="tab-pane fade active show" id="edit">
                <br>
                <transition name="fade" mode="out-in">
                    <keep-alive>
                        <edit-component></edit-component>
                    </keep-alive>
                </transition>
            </div>
            <div v-if="active_tab == 'game-component'" class="tab-pane fade active show" id="game">
                <br>
                <transition name="fade" mode="out-in">
                    <keep-alive>
                        <game-component></game-component>
                    </keep-alive>
                </transition>
            </div>
            <div v-if="active_tab == 'transaction-component'" class="tab-pane fade active show" id="transaction">
                <br>
                <transition name="fade" mode="out-in">
                    <keep-alive>
                        <transaction-component></transaction-component>
                    </keep-alive>
                </transition>
            </div>
            <div v-if="active_tab == 'order-component'" class="tab-pane fade active show" id="order">
                <br>
                <transition name="fade" mode="out-in">
                    <keep-alive>
                        <order-component></order-component>
                    </keep-alive>
                </transition>
            </div>
        </div>
	</div>
</template>

<script>
    import {routes} from '../../api_routes'
    import LoadComponent from '../Load'
    import EditComponent from './EditComponent.vue'
    import GameComponent from './GameComponent.vue'
    import OrderComponent from '../Order/IndexComponent.vue'
    import TransactionComponent from './TransactionComponent.vue'
	export default {
        data: function() {
            return {
                loading: {
                    component: true
                },
                auth: JSON.parse(window.localStorage.getItem('authUser')),
                active_tab: 'edit-component'
            }
        },
		mounted: function() {
            this.loading.component = false;
            var interval = setInterval(() => {
                var vm = this;
                if($('a[data-toggle="pill"]').length > 0) {
                    clearInterval(interval);
                    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                        var tab = $( e.target);
                        vm.active_tab = tab.attr('id');
                    });
                }
            });
		},
		methods: {
			handleUpdateProfile: function(event) {

			}
		},
        components: {
            LoadComponent,
            EditComponent,
            GameComponent,
            TransactionComponent,
            OrderComponent
        }
	}

</script>

<style scoped>
	
</style>