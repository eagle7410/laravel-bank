<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-2">
                <h4>Total</h4>
                <div>
                    <div>Sum: {{totalSum}}</div>
                    <div>Income: {{totalIncome}}</div>
                    <div>Amount of investments: {{totalDeposits}}</div>
                </div>
            </div>
            <div class="col-md-2">
                <h4>Deposits</h4>
                <div>
                    <div>Count : {{depositsCount}}</div>
                    <div>Active: {{depositsCountActive}}</div>
                    <div>Stopped: {{depositsCountStoped}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let that;

    export default {
        computed : {
            depositsCount : () => that.depositsCountStoped + that.depositsCountActive
        },

        data : function () {
            return {
                title : 'Dashboard',
                totalSum : 0,
                totalIncome : 0,
                totalDeposits : 0,
                depositsCountActive : 0,
                depositsCountStoped : 0,
            };
        },

        created : function () {
            that = this;

            that.$root.title = that.title;
        }
    }
</script>
