<template>
    <div class="actions">
        <a class="action" :href="historyHref" >
            <i class="fa fa-history" aria-hidden="true" title="history"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.stopped || entry.status === statuses.verification"
           @click.prevent="emitEvent({status : statuses.stopped, id : entry.id})"
        >
            <i class="fa fa-play" aria-hidden="true" title="Run"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.active "
           @click.prevent="emitEvent({status : statuses.active, id : entry.id})"
        >
            <i class="fa fa-stop" aria-hidden="true" title="Stop"></i>
        </a>
        <a class="action" v-if="entry.status === statuses.verification"
           @click.prevent="emitEvent({status : statuses.verification, id : entry.id})"
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
            emitEvent : data => that.$fire('DEPOSIT_ACTION', data),
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

        computed : {
            historyHref : () => `#/deposit-history/${that.entry.number}`,
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
