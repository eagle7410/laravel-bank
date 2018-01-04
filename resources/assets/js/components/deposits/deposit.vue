<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <form>
                    <server_error_view :serverErrors="serverErrors"></server_error_view>

                    <form_input
                            name="number"
                            label="Number"
                            placeholder="Enter number"
                            help="Number is required and unique"
                            :err="errors.number"
                            v-model="number"
                    ></form_input>

                    <form_input
                            name="sum"
                            label="Sum, $"
                            placeholder="Enter sum"
                            help="Sum is required and more 0.01"
                            type="number"
                            :err="errors.sum"
                            v-model="sum"
                    ></form_input>

                    <form_input
                            name="percent"
                            label="Percent, %"
                            placeholder="Enter percent"
                            help="Number is required and more 0.01"
                            type="number"
                            :err="errors.percent"
                            v-model="percent"
                    ></form_input>

                    <button @click.prevent="clickSubmit" type="submit" class="btn btn-primary">
                        {{action}}
                    </button>
                    <button @click.prevent="clickBack" class="btn btn-warning">Back</button>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</template>
<script>
    let that;
    // TODO: IGOR Back back doit.
    import {routesEmployee as routes} from '../../const'

    export default {


        created: function () {
            that = this;

            that.action += 'create';

            that.$root.title = that.title + ' ' + that.action;
        },

        data: function () {
            return {
                title  : 'Deposit',
                action : '',
                id     : null,

                number   : '',
                sum : 0,
                percent : 0,


                alias  : '',
                desc   : '',

                errors : {
                    number  : null,
                    sum  : null,
                    percent : null,
                },

                serverErrors : {}
            };
        },

        computed : {
            result : () => {
                return {
                    alias : that.alias,
                    name  : that.name,
                    desc  : that.desc,
                };
            }
        },

        methods : {

            _validate : data => {
                let errors = that.errors;
                let isHasError = false;

                for (let prop in errors) {

                    if (!that[prop]) {
                        isHasError = true;
                        errors[prop] = isHasError;
                    } else {
                        errors[prop] = null;
                    }
                }

                return !isHasError;
            },
            cssProp : prop => {
                let css = 'form-group';

                if (that.errors[prop]) {
                    css += ' has-error';
                }

                return css;
            },
            _handelError : err => {
                console.error('Error save deposit', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
            clickSubmit : () => {
                let data = that.result;
                that.serverErrors = {};

                if (!that._validate(data)) {
                    return false;
                }


                if (that.id) {
                    // TODO: IGOR Back maybe need
//                    data.id = that.id;
//                    that.api.update(data)
//                        .then(that.clickBack)
//                        .catch(that._handelError);
                } else {
                    that.api.save(data)
                        .then(that.clickBack)
                        .catch(that._handelError);
                }
            },
            clickBack : () => {
                if (that.$router) {
                    that.$router.push(routes.deposits);
                }
            },
        }
    }
</script>


