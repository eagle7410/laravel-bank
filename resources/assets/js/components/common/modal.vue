<template>
    <div :class="cssModal" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click.prevent="clickClose"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">{{title}}</h4>
                </div>
                <div class="modal-body">
                    <component v-if="bodyComp" :is="bodyComp"></component>
                    <div v-if="bodyHtml.length" v-html="bodyHtml"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
                            @click.prevent="clickClose"
                    >{{btnClose}}</button>
                    <button type="button"
                            @click.prevent="clickSave"
                            :class="btnSaveCss"
                    >{{btnSave}}</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    let that;

    export default {

        computed : {
            _storeModal : () => that.$store.state.modal,
            bodyHtml    : () => that._storeModal.bodyHtml,
            bodyComp    : () => that._storeModal.bodyComp,
            btnSaveCss  : () => that._storeModal.btnSaveCss,
            btnSave     : () => that._storeModal.btnSave,
            btnClose    : () => that._storeModal.btnClose,
            title       : () => that._storeModal.title,
            isShow      : () => that._storeModal.isShow,
            cssModal : () => {
                let css = 'modal';

                if (that.isShow) {
                    css += ' open';
                }

                return css;
            }
        },

        methods : {
            clickClose : () => that.$store.commit('modalCancel'),
            clickSave  : () => that.$store.commit('modalSave'),
        },

        created: function () {
            that = this;
        }
    }
</script>
<style scoped>
    .open {
        display: block;
        padding-right: 15px;
    }
</style>
