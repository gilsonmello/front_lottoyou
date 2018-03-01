<template>
    <div tabindex="-1" :id="id" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form :action="action" :method="method" v-on:submit.prevent="submit()">
                <div class="modal-content">
                    
                    <slot name="modal-header"></slot>
                    
                    <slot name="modal-body"></slot>
                    
                    <slot name="modal-footer"></slot>
                        
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['action', 'method', 'buttons', 'id'],
        methods: {
            submit: function(){
                this.$emit('interface', this) // handle data and give it back to parent by interface
            },
        }
    }
</script>

<style lang="css">
</style>
