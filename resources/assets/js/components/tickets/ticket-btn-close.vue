<template>
    <div class="box-header with-border"
    >
        <h3 class="box-title">
            <button :class="'btn '+ ( isClosed ? '': 'btn-success' )" :disabled="isClosed"
                    v-if="isClient || isClosed"
                    @click="clickClose"
            >
                <i class="fa fa-lock"></i>
                {{ isClosed  ? 'Close at ' +  ticket.closed_at.toDateFormat('d-m-y h:i')  : 'Close' }}
            </button>
            {{ ticket.title }}
        </h3>
    </div>
</template>
<script>
    import {routes} from '../../const';

    export default {
        props : ['ticket', 'isClosed'],
        computed : {
            isClient : function () { return this.$root.isClient; },
            api      : function () { return window.apis.ticket}
        },

        methods : {
            clickClose : function () {
                let id = this.$route.params.id;

                this.api.close(id)
                    .then(res => {
                        this.$store.commit('closeTicket', {id, closed_at : res.closed_at});
                        this.$router.push(routes.ticketsClose)
                    })
                    .catch(err => console.error('ERR: ', err))

            }
        }
    }
</script>
