<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}. Total sum {{totalSum}}$</h3>
        </div>
        <div class="box-body">
            <grid :data="deposits" :columns="gridColumns"></grid>
        </div>
        <modal></modal>
        <!-- /.box-body -->
    </div>
</template>

<script>
    import Modal from '../common/modal'
    import {routes as routes, depositGrid} from '../../const'
    import {depositsStatus} from '../../const'

    let that;

    export default {
        components : {
            Modal,
        },

        computed : {
            apiDeposits       : () => window.apis.deposit,
            totalSum          : () => that.deposits.sumProp('sum'),
            _storeDeposits    : () => that.$store.state.deposits,
            deposits          : () => that._storeDeposits.deposits,
            depositId         : () => that._storeDeposits.depositId,
            depositNewStatus  : () => that._storeDeposits.depositNewStatus,
            dataChangeStatus  : () => ({
                id : that.depositId,
                status : that.depositNewStatus
            })
        },

        data: function () {
            return {
                title: 'My deposits',
                gridColumns : depositGrid,
            };
        },

        methods : {
            cancelChangeStatus : () => {
                that.$store.commit('setDepositsData', {
                    depositId : null,
                    depositNewStatus : null,
                });
            },
            applyNewDepositStatus : () => {
                that.apiDeposits.changeStatus(that.dataChangeStatus)
                    .then(() => that.$store.commit('applyNewStatus'))
                    .catch(err => console.error('Error change deposit', err))
            }
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.$store.commit('setModalData', {
                callCancel : that.cancelChangeStatus,
                callSave   : that.applyNewDepositStatus,
                bodyHtml   : "<p>Are you sure of the status change?</p>",
                btnSave    : "Yes",
                btnSaveCss : "btn btn-danger",
                btnClose   : "Cancel"
            });

            that.apiDeposits.getAll()
                .then(deposits => that.$store.commit('setDepositsData', {
                    deposits : deposits || []
                }))
                .catch(err => console.error(`Error get deposits`));
        }
    }
</script>

<style scoped>
    .alert {
        padding: 0.2em 5px;
    }
</style>
