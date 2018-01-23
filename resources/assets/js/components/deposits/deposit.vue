<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <form>
                    <server_error_view :serverErrors="serverErrors"></server_error_view>

                    <form-select
                            name="userId"
                            label="Client"
                            placeholder="Select client"
                            help="Client is required"
                            :err="errors.userId"
                            :items ="clients"
                            v-model="userId"
                    ></form-select>

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
                            help="Sum is required and more 1"
                            type="number"
                            :err="errors.sum"
                            v-model="sum"
                    ></form_input>

                    <form_input
                            name="percent"
                            label="Percent, %"
                            placeholder="Enter percent"
                            help="Percent is required and more 0.01"
                            type="number"
                            :err="errors.percent"
                            v-model="percent"
                    ></form_input>

                    <form-date name="start_at"
                               label="Start date"
                               help="Deposit start today or later"
                               :err="errors.startAt"
                               v-model="startAt"
                    ></form-date>


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
    import FormDate from '../common/form-date';
    import FormSelect from '../common/form-select';
    import {routesEmployee as routes} from '../../const'
    let that;

    export default {

        created: function () {
            that = this;

            that.action += 'create';

            that.$root.title = that.title + ' ' + that.action;

            that.apiClients.get()
                .then(clients => {
                    that.clients = (clients || [])
                        .map(client => ({
                            value : client.id,
                            label : `${client.name} (${client.email})`
                        }))
                        .sort((prev, next) => (prev.label).localeCompare(next.label));
                })
                .catch(err => console.error('Error get actions', err))
        },

        data: function () {
            return {
                title  : 'Deposit',
                action : '',
                id     : null,

                number  : null,
                sum     : null,
                percent : null,
                startAt : new Date(),
                userId  : null,
                clients : [],

                errors : {
                    sum     : null,
                    number  : null,
                    percent : null,
                    startAt : null,
                    userId  : null,
                },

                serverErrors : {}
            };
        },

        computed : {
            apiClients: () => window.apis.clients,
            apiDeposit: () => window.apis.deposit,
            result : () => {
                return {
                    number   : that.number,
                    percent  : that.percent,
                    start_at : that.startAt.toStringByFormat('y/m/d'),
                    user_id  : that.userId,
                    sum      : that.sum,
                };
            }
        },

        methods : {
            _minValidate: (prop, min) => {
                let res = true;

                if (that[prop] < min) {
                    that.errors[prop] = true;
                    res = false;
                } else {
                    that.errors[prop] = null;
                }

                return res;
            },
            _isFutureOrNowDay : () => {
                let isFutureOrNowDay = that.startAt.isFutureOrNowDay();

                if (isFutureOrNowDay) {
                    that.errors.startAt = null;
                } else {
                    that.errors.startAt = true;
                }

                return isFutureOrNowDay;
            },
            _validate : () => {
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

                if (!isHasError) {
                    if (
                        !that._minValidate('sum', 1) ||
                        !that._minValidate('percent', 0.01) ||
                        !that._isFutureOrNowDay()
                    ) {
                        isHasError = true;
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
                that.serverErrors = {};

                if (!that._validate()) {
                    return false;
                }

                let data = that.result;

                if (that.id) {
                    // TODO: IGOR Back maybe need
//                    data.id = that.id;
//                    that.api.update(data)
//                        .then(that.clickBack)
//                        .catch(that._handelError);
                } else {
                    that.apiDeposit.save(data)
                        .then(that.clickBack)
                        .catch(that._handelError);
                }
            },
            clickBack : () => {
                if (that.$router) {
                    that.$router.push(routes.deposits);
                }
            },
        },
        
        components: {
            FormDate,
            FormSelect
        }
    }
</script>


