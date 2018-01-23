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
            <div class="col-md-4">
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
            _storeDash                : () => that.$store.state.dash,
            totalSum                  : () => that._storeDash.totalSum,
            totalDeposits             : () => that._storeDash.totalDeposits,
            depositsCountActive       : () => that._storeDash.depositsCountActive,
            depositsCountStopped      : () => that._storeDash.depositsCountStopped,
            depositsCountVerification : () => that._storeDash.depositsCountVerification,
        },

        data: function () {
            return {
                title: 'Dashboard',
            };
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.api.get()
                .then(data => that.$store.commit('setDashData', data))
                .catch(err => console.error('Error get dash stats', err))
        }
    }
</script>
