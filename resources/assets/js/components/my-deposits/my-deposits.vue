<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Status</th>
                        <th scope="col">Number</th>
                        <th scope="col">Sum, $</th>
                        <th scope="col">Percent, %</th>
                        <th scope="col">Last income, $</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="!deposits.length">
                        <td colspan="7">You don't have deposits</td>
                    </tr>
                    <tr v-for="(deposit, index) in deposits">
                        <th scope="row">{{index + 1}}</th>
                        <td>
                            <my_deposits_actions :deposit="deposit"></my_deposits_actions>
                        </td>
                        <th scope="col">
                            <my_deposits_status_label :status="deposit.status"></my_deposits_status_label>
                        </th>
                        <td>{{deposit.number}}</td>
                        <td>{{deposit.sum}}</td>
                        <td>{{deposit.percent}}</td>
                        <td>{{deposit.lastIncome}}</td>
                    </tr>
                </tbody>
                <tfoot v-if="deposits.length">
                    <tr>
                        <td colspan="4"><b>Total</b></td>
                        <td colspan="2">{{totalSum}}</td>
                        <td>{{totalLastIncome}}</td>
                    </tr>
                </tfoot>
            </table>
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
                title: 'My deposits',
                deposits : []
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

<style scoped>
    .alert {
        padding: 0.2em 5px;
    }
</style>
