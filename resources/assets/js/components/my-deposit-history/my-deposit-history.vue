<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <my_deposits_status_label
                        v-if="status"
                        :status="status"
                ></my_deposits_status_label> {{title}} ({{sum}}$).
            </h3>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action date</th>
                        <th scope="col">Sum before, $</th>
                        <th scope="col">Sum after, $</th>
                        <th scope="col">Comment</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="errMessage">
                        <td colspan="7">{{errMessage}}</td>
                    </tr>
                    <tr v-for="(history, index) in histories">
                        <th scope="row">{{index + 1}}</th>
                        <td>
                            {{actionLabel(history.action)}}
                        </td>
                        <td>
                            {{history.date_action.toDateFormat('d-m-y')}}
                        </td>
                        <td>{{history.sum_before}}</td>
                        <td>{{history.sum_after}}</td>
                        <td>{{history.comment}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    let that;

    export default {

        computed : {
            api : () => window.apis.depositHistory,
            title : () => that.depositId ? `Deposit history #${that.number}` : 'Deposit history'
        },

        methods : {
            actionLabel : (action) => that.actionLabels[action] || action,
        },
        data: function () {
            return {
                depositId : null,
                number : null,
                status : null,
                sum : 0,
                histories : [],
                errMessage : null,
                actionLabels : {
                    1 : 'Created',
                    2 : 'Stopped',
                    3 : 'Verificaion',
                    4 : 'Income'
                }

            };
        },

        created: function () {
            that = this;

            that.depositId = that.$route ? that.$route.params.depositId : null;

            that.$root.title = that.title;

            if (!that.depositId) {
                return false;
            }

            that.api.getAll(that.depositId)
                .then(depositHistory => {
                    that.status = depositHistory.status;
                    that.number = depositHistory.number;
                    that.sum    = depositHistory.sum;

                    if (!depositHistory.history.length) {
                        that.errMesssage = 'Deposit history empty!!!';
                        return false;
                    }

                    that.histories = depositHistory.history.sort((prev, next) => next.date_action.localeCompare(prev.date_action));

                })
                .catch(err => console.error(`Error get deposit history`, err))
        }
    }
</script>

<style scoped>
    .alert {
        padding: 0.2em 5px;
    }
</style>
