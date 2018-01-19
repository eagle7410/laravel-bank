<template>
    <div class="alert alert-success"
         v-if="isShowMessage"
    >
        <i href="#" class="close"  aria-label="close" title="close"
           @click.prevent="clickCloseOkMess"
        >×</i>
        <b>Success!</b> {{message}}
    </div>
</template>
<script>
    let that;

    export default {
        props : {
            isShow : {
                type : Boolean,
                default : false
            },
            message : {
                type : String,
                default : ''
            },

        },
        data : function () {
            return {
                isShowMessage : false
            };
        },

        watch : {
            isShow : isShow => that.isShowMessage = isShow,
        },

        methods : {
            clickCloseOkMess : () => {
                that.isShowMessage = false;
                that.$emit('ALERT_SUCCESS_CLOSE');
            },
        },

        created : function () {
            that = this;
        }
    }
</script>
