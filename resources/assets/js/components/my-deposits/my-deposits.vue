<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title">{{title}}. Total sum {{totalSum}}$</h3>
            </div>
            <div class="box-body">
                <grid :data="deposits" :columns="gridColumns"
                ></grid>
            </div>
            <modal
                    :title="modalTitle"
                    body-html="<p>Are you sure of the status change?</p>"
                    btn-save="Yes"
                    btn-save-css="btn btn-danger"
                    btn-close="Cancel"

            ></modal>
        </div>
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
            apiDeposits     : () => window.apis.deposit,
            totalSum        : () => that.deposits.sumProp('sum'),
        },

        data: function () {
            return {
                title: 'My deposits',
                deposits : [],
                gridColumns : depositGrid,
                modalTitle  : '',
                depositId   : null,
                depositNewStatus : null,
            };
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.apiDeposits.getAll()
                .then(deposits => that.deposits = deposits || [])
                .catch(err => console.error(`Error get deposits`));

            that.listeners({
                DEPOSIT_ACTION : data => {
                    let modalTitle = 'Unknown status';

                    that.depositId = data.id;
                    that.depositNewStatus = data.status;

                    switch (data.status) {
                        case depositsStatus.active:
                            modalTitle = 'Deposit to verification stopped';
                            that.depositNewStatus = depositsStatus.verification;
                            break;
                        case depositsStatus.verification:
                            modalTitle = 'Deposit be stopped';
                            that.depositNewStatus = depositsStatus.stopped;
                            break;
                        case depositsStatus.stopped:
                            modalTitle = 'Deposit be running';
                            that.depositNewStatus = depositsStatus.active;
                            break;
                    }

                    that.modalTitle = modalTitle;

                    that.$fire('SHOW_MODAL');
                },
                MODAL_SAVE : () => {
                    that.apiDeposits.changeStatus({
                        id : that.depositId,
                        status : that.depositNewStatus
                    })
                        .then((data) => {
                            let deposit = that.deposits.find(deposit => deposit.id === that.depositId);

                            Object.keys(data).map(prop => {
                                if (deposit[prop]) {
                                    deposit[prop] = data[prop]
                                }
                            });

                            that.depositId = null;
                            that.depositNewStatus = null;
                        })
                        .catch(err => console.error('Error change deposit', err))
                }
            });

        }
    }
</script>

<style scoped>
    .alert {
        padding: 0.2em 5px;
    }
</style>
