<template>
    <div v-if="!isClosed" class="box block-send">
        <server_error_view :serverErrors="serverErrors"></server_error_view>

        <form-area
                name="text"
                placeholder="Message ..."
                help="This field is require"
                :err="err"
                v-model="text"
        ></form-area>

        <button type="button" class="btn btn-warning btn-flat" style="width:100%"
                @click="clickSubmit"
        >
            <i class="fa fa-comments"></i>
            Send
        </button>
    </div>
</template>

<script>
    import formArea from '../common/form-area.vue'

    let that;

    export default {
        computed : {
            api : () => window.apis.ticketDialog
        },

        data : function () {
            return {
                text : '',
                err  : null,
                serverErrors : {}
            }
        },

        methods : {
            _handelError : err => {
                console.error('Error send', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
            clickSubmit : () => {
                that.err = null;
                that.serverErrors = {};

                if (!that.text) {
                    that.err = true;

                    return false;
                }

                let id = that.$route.params.id;

                that.api.send({id, text : that.text })
                    .then(res => {
                        that.text = '';
//                        // TODO: IGOR Back
//                        console.log('Response ', res);
                    })
                    .catch(that._handelError);
            }
        },

        created : function () {
            that = this;
        },

        components : {
            formArea
        },

        props : {
            isClosed : {
                type : Boolean,
                required : true
            }
        },
    }
</script>
<style scoped>
    .block-send {
        width: 95%;
    }
</style>
