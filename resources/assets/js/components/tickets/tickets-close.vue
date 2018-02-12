<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">This is closed tickets.</h3>
        </div>
        <div class="box-body">
            <tickets-list :tickets="ticketsClosed"></tickets-list>
        </div>
    </div>

</template>
<script>
    import TicketsList from './tikets-list.vue'
    let that;

    export default {
        components : {
            TicketsList
        },

        computed : {
            _storeTickets : () => that.$store.state.tickets,
            ticketsClosed  : () => that._storeTickets.closed
        },

        created: function () {
            that = this;

            that.$root.title = 'Tickets closed';
        }
    }
</script>
<style scoped>

    .menu > li {
        padding: 5px 0;
    }
    .menu {
        list-style: none;
    }
</style>
