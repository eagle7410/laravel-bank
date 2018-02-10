<template>
    <div>
        <a @click.prevend="isRead(entry.id)" title="Is read">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
        </a>
    </div>
</template>
<script>
    let that;

    export default {
        props : {
            entry: {
                type : Object,
                required : true
            }
        },

        computed : {
            api : () => window.apis.notify,
        },

        methods : {
            _handelError : err => {
                console.error('Error set is read to notice', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.$store.commit('setErrors', responseJSON.errors);
                }
            },
            isRead : (id) => {
                that.$store.commit('clearErrors');

                that.api.isRead(id)
                    .then((notice) => {
                        that.$store.commit('noticeIsRead', {
                            id,
                            read_at : notice.read_at.toDateFormat('d-m-y h:i')
                        });
                    })
                    .catch(that._handelError)
            }
        },

        created: function () {
            that = this;
            that.$store.commit('clearErrors');
        }
    }
</script>
