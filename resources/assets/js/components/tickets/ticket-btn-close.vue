<template>
    <div class="box-header with-border"
    >
        <h3 class="box-title">
            <button :class="'btn '+ (isClose ? '': 'btn-success' )" :disabled="isClose"
                    v-if="isClient || isClose"
            >
                <i class="fa fa-lock"></i>
                {{ isClose ? 'Close at ' +  ticket.closed_at  : 'Close' }}
            </button>
            {{ ticket.title }}
        </h3>
    </div>
</template>
<script>
    export default {
        props : ['ticket'],
        computed : {
            isClient : function () { return this.$root.isClient; }
        },

        data : function () {
            return {
                isClose : Boolean(this.ticket.closed_at)
            }
        },
    }
</script>
