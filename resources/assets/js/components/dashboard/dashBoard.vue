<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-2">
                <h4>Deposits</h4>
                <div>
                    <div>Count : {{depositsCount}}</div>
                    <div>Active: {{depositsCountActive}}</div>
                    <div>Stopped: {{depositsCountStopped}}</div>
                    <div>Verification: {{depositsCountVerification}}</div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Total</h4>
                <div>
                    <div>Sum: {{totalSum}}</div>
                    <div>Income: {{totalIncome}}</div>
                    <div>Amount of investments: {{totalDeposits}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let that;

    export default {

        computed: {
            api :          () => window.apis.dash,
            depositsCount: () => that.depositsCountStopped +
                                    that.depositsCountActive +
                                    that.depositsCountVerification,
            totalIncome:   () => that.totalSum - that.totalDeposits,
        },

        data: function () {
            return {
                title: 'Dashboard',
                totalSum: 0,
                totalDeposits: 0,
                depositsCountActive: 0,
                depositsCountStopped: 0,
                depositsCountVerification: 0,
            };
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.api.get()
                .then(data => Object.keys(that._data).map(key => that[key] = data[key] || that[key]))
                .catch(err => console.error('Error get dash stats', err))
        }
    }
</script>
