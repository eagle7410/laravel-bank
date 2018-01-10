<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="tools">
                <button class="btn btn-success" @click="clickNew">Create</button>
            </div>
            <grid :data="deposits" :columns="gridColumns" ></grid>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    import Actions from './actions';
    import {routesEmployee as routes} from '../../const'
    let that;

    export default {

        computed : {
            apiDeposits     : () => window.apis.deposit,
            totalSum        : () => that.deposits.sumProp('sum'),
            totalLastIncome : () => that.deposits.sumProp('lastIncome'),
        },

        data: function () {
            return {
                title: 'Deposits',
                deposits : [],
                gridColumns : [
                    {label : 'Action', comp: Actions},
                    {label : 'Status', comp: 'my_deposits_status_label'},
                    'number',
                    'email',
                    {
                        label : 'Sum, $',
                        alias : 'sum'
                    },
                    {
                        label : 'Percent, %',
                        alias : 'percent'
                    },
                    {
                        label : 'Date start',
                        alias : 'start'
                    },
                    {
                        label : 'Date next income',
                        alias : 'income'
                    },
                    {
                        label : 'Date updated',
                        alias : 'updated'
                    },
                    {
                        label : 'Date created',
                        alias : 'created'
                    },
                ]
            };
        },

        methods : {
            clickNew : () => {
                if (that.$router) {
                    that.$router.push(routes.depCreate);
                }
            }
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.apiDeposits.getAll()
                .then(deposits => that.deposits = deposits || [])
                .catch(err => console.error(`Error get deposits`))

        }
    }
</script>

