<template v-transfer-dom.prepend>
	<div class="modal fade" data-backdrop="static" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <slot name="modal-header"></slot>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <slot name="modal-body"></slot>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <slot name="modal-footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
        data () {
            return {
                modal: null
            }
        },
		methods: {
			openModalGeneral () {

            },
		},
		mounted () {
			this.$on('openModalGeneral', (header, content, footer) => {
                
            });
            document.body.insertBefore(this.$el, document.body.firstChild)
        }
	}
</script>

<style scoped>
	
</style>