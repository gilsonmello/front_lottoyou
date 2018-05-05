<template>
	<div class="modal fade modal-general" data-backdrop="static" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom: none;">
                    	<button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="padding-top: 0;">
                        
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            {{ trans('strings.to_close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
	export default {
		methods: {
			openModalGeneral() {

            },
		},
		mounted() {
			this.$on('openModalGeneral', (header, content, footer) => {
                
            });
		}
	}
</script>

<style scoped>
	
</style>