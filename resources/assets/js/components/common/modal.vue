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
        props : {
            show : {
                type: Boolean,
                default : false
            },
            title : {
                type : String,
                default : 'Default Modal'
            },
            btnClose : {
                type : String,
                default : 'Close'
            },
            btnSave : {
                type : String,
                default : 'Save'
            },
            btnSaveCss : {
                type : String,
                default : 'btn btn-primary'
            },
            bodyComp : {
                type : Object,
                default : null,
            },
            bodyHtml : {
                type : String,
                default : ''
            },
            eventOpen : {
                type : String,
                default : 'SHOW_MODAL'
            },
            eventSave : {
                type : String,
                default : 'MODAL_SAVE'
            },
        },

        computed : {
            cssModal : () => {
                let css = 'modal';

                if (that.isShow) {
                    css += ' open';
                }

                return css;
            }
        },

        data : function () {
            return {
                isShow : false
            }
        },

        methods : {
            clickClose : () => that.isShow = false,
            clickSave  : () => {
                that.emitter.$emit(that.eventSave);
                that.clickClose();
            }
        },

        created: function () {
            that = this;
            that.isShow = that.show;
            that.listen(that.eventOpen, () => that.isShow = true);
        }
    }
</script>
<style scoped>
    .open {
        display: block;
        padding-right: 15px;
    }
</style>
