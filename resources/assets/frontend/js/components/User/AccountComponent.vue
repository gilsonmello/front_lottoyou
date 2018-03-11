<template>
    <load-component v-if="loading.component == true"></load-component>
	<div class="container-fluid" v-else>
        <h3 class="">&nbsp;</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="edit-component" data-toggle="tab" href="#edit" role="tab" aria-controls="home" aria-selected="true">
                    {{ trans('strings.profile') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="game-component" data-toggle="tab" href="#game" role="tab" aria-controls="profile" aria-selected="false">
                    {{ trans('strings.games') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="transaction-component" data-toggle="tab" href="#transaction" role="tab" aria-controls="profile" aria-selected="false">
                    {{ trans('strings.transactions') }}
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div v-if="active_tab == 'edit-component'" class="tab-pane fade active show" id="edit" role="tabpanel" aria-labelledby="edit-component">
                <br><edit-component></edit-component>
            </div>
            <div v-if="active_tab == 'game-component'" class="tab-pane fade active show" id="game" role="tabpanel" aria-labelledby="game-component">
                <br><game-component></game-component>
            </div>
            <div v-if="active_tab == 'transaction-component'" class="tab-pane fade active show" id="transaction" role="tabpanel" aria-labelledby="transaction-component">
                <br><transaction-component></transaction-component>
            </div>
        </div>
	</div>
</template>

<script>
    import {routes} from '../../api_routes'
    import LoadComponent from '../Load'
    import EditComponent from './EditComponent.vue'
    import GameComponent from './GameComponent.vue'
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
                if($('a[data-toggle="tab"]').length > 0) {
                    clearInterval(interval);
                }
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var tab = $( e.target);
                    vm.active_tab = tab.attr('id');
                });
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
            TransactionComponent
        }
	}

</script>

<style scoped>
	
</style>