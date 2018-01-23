<template>
    <div class="col-md-4 profile-form">
        <form>
            <alert-success :is-show="isShowMessOk" message="Profile updated."
                           @ALERT_SUCCESS_CLOSE="isShowMessOk = false"
            ></alert-success>

            <server_error_view :serverErrors="serverErrors"></server_error_view>

            <component v-for="(field, inx) in fields"
                       v-model="field.val"
                       v-bind="field.attrs"
                       :key="`field-${inx}`"
                       :is="field.comp"
                       :err="field.err"
            ></component>

            <button @click.prevent="clickSubmit" type="submit" class="btn btn-primary">
                {{action}}
            </button>
        </form>
    </div>
</template>
<script>
    import apis from '../../apis/employee'
    import AlertSuccess from '../common/alert-success.vue'
    let that;

    export default {
        components : {
            AlertSuccess,
        },

        computed : {
            _storeProfile : () => that.$store.state.profile,
            name          : () => that._storeProfile.name,
            surname       : () => that._storeProfile.surname,
            apiProfile    : () => apis.profile,
        },

        methods : {
            result : () => {
                let data = {};

                that.fields.map(field => data[field.attrs.name.vuePropToModelAttr()] = field.val);

                return data;
            },
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
                console.error('Error save deposit', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
            clickSubmit : () => {
                if (!that._validate()) {
                    return false;
                }

                const data = that.result();

                that.apiProfile.update(data)
                    .then(() => {
                        that.$store.commit('setProfile', {
                            name    : that.fields[0].val,
                            surname : that.fields[1].val,
                        });
                        that.isShowMessOk = true;
                    })
                    .catch(that._handelError);
            }
        },

        data: function () {
            return {
                action    : 'Save',
                isShowMessOk : false,
                fields : [
                    {
                        comp    : 'form_input',
                        err     : null,
                        require : true,
                        store   : 'name',
                        attrs   : {
                            name        : 'nameFirst',
                            label       : 'Name',
                            help        : 'Is field is required',
                            placeholder : 'Enter name',
                        }
                    },
                    {
                        comp    : 'form_input',
                        err     : null,
                        require : true,
                        store   : 'surname',
                        attrs   : {
                            name        : 'nameLast',
                            label       : 'Surname',
                            help        : 'Is field is required',
                            placeholder : 'Enter surname',
                        }
                    }
                ],
                serverErrors : {}
            }
        },

        created: function () {
            that = this;
            that.fields.map(field => field.val = that[field.store] || null );
        }
    }
</script>
