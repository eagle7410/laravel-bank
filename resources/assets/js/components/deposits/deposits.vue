<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <grid :data="deposits" :columns="gridColumns" ></grid>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    let that;
    const apiEmulate = {
        deposit : {
            getAll : () => new Promise(ok => ok(null))
        }
    };

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
                    {label : 'Action', comp: 'my_deposits_actions'},
                    {label : 'Status', comp: 'my_deposits_status_label'},
                    'number',
                    {
                        label : 'Sum, $',
                        alias : 'sum'
                    },
                    {
                        label : 'Percent, %',
                        alias : 'percent'
                    },
                    {
                        label : 'Last Income, $',
                        alias : 'lastIncome'
                    }
                ]
            };
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

