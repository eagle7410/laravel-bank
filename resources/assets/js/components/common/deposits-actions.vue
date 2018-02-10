<template>
    <div class="actions">
        <a class="action" :href="historyHref(entry.number)" >
            <i class="fa fa-history" aria-hidden="true" title="history"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.stopped || entry.status === statuses.verification"
           @click.prevent="emitEvent({action : statuses.stopped, id : entry.id})"
        >
            <i class="fa fa-play" aria-hidden="true" title="Run"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.active "
           @click.prevent="emitEvent({action : statuses.active, id : entry.id})"
        >
            <i class="fa fa-stop" aria-hidden="true" title="Stop"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.verification"
           @click.prevent="emitEvent({action : statuses.verification, id : entry.id})"
        >
            <i class="fa fa-check-circle-o" aria-hidden="true" title="Checked"></i>
        </a>
    </div>
</template>
<script>
    import {depositsStatus} from '../../const'

    let that;

    export default {

        methods : {
            emitEvent(data) {
                let title = 'Unknown action';
                let { id: depositId, action: depositNewStatus} = data;

                switch (depositNewStatus) {
                    case depositsStatus.active:
                        title = 'Deposit to verification stopped';
                        depositNewStatus = depositsStatus.verification;
                        break;
                    case depositsStatus.verification:
                        title = 'Deposit be stopped';
                        depositNewStatus = depositsStatus.stopped;
                        break;
                    case depositsStatus.stopped:
                        title = 'Deposit be running';
                        depositNewStatus = depositsStatus.active;
                        break;
                }


                that.$store.commit('setDepositsData', {
                    depositId,
                    depositNewStatus
                });

                that.$store.commit('modalOpen', {title});
            },
            historyHref : number => `#/deposit-history/${number}`,
        },

        props : {
            entry: {
                type : Object,
                required : true
            }
        },

        data : function () {
            return {
                statuses : depositsStatus
            }
        },

        created: function () {
            that = this;
        }
    }
</script>

<style scoped>
    .action {
        padding: 0 5px;
    }
    .action:hover {
        color: red;
    }
</style>
