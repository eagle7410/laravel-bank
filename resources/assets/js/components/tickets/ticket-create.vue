<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Enter form create ticket.</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6 form-ticket-create">

                <server_error_view :serverErrors="serverErrors"></server_error_view>

                <component v-for="(field, inx) in fields"
                           v-model="field.val"
                           v-bind="field.attrs"
                           :key="`form-ticket-create-${inx}`"
                           :is="field.comp"
                           :err="field.err"
                ></component>

                <button @click.prevent="clickSubmit" type="submit" class="btn btn-primary">
                    Create
                </button>
            </div>
        </div>
    </div>

</template>
<script>
    import FormArea from '../common/form-area.vue';
    import apis from '../../apis/client';
    import {routes} from '../../const';
    import {breadcrumbTicketOpen} from '../../const/breadcrumbs';

    let that;

    export default {
        computed : {
            api : () => apis.ticket,
        },

        methods : {
            _validate   : () => {
                let isOK = true;

                that.fields.map(field => {
                    if (field.require && !field.val) {
                        field.err = true;
                        isOK = false;

                        return false;
                    }

                    field.err = false;
                });

                return isOK;
            },
            _handelError : err => {
                console.error('Error save ticket', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
            result : () => {
                let data = {};

                that.fields.map(field => data[field.attrs.name] = field.val);

                return data;
            },
            clickSubmit : () => {
                that.serverErrors = {};

                if (!that._validate()) {
                    return false;
                }

                that.api.save(that.result())
                    .then((tiket) => {
                        that.$store.commit('setNewTicket', tiket);
                        that.$router.push(routes.ticketsOpen);
                    })
                    .catch(that._handelError);
            }
        },

        data: function () {
            return {
                serverErrors : {},
                fields : [
                    {
                        comp    : 'form_input',
                        err     : null,
                        require : true,
                        val     : '',
                        attrs   : {
                            name        : 'title',
                            label       : 'Title',
                            help        : 'Is field is required',
                            placeholder : 'Enter title',
                        }
                    },
                    {
                        comp    : FormArea,
                        err     : null,
                        require : true,
                        val     : '',
                        attrs   : {
                            name        : 'text',
                            label       : 'Question',
                            help        : 'Is field is required',
                            placeholder : 'Enter question',
                        }
                    }
                ],
            }
        },

        created: function () {
            that = this;

            that.$root.title = 'Create ticket';
        }
    }
</script>
