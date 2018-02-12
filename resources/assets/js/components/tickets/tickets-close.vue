<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">This is closed tickets.</h3>
        </div>
        <div class="box-body">
            <tickets-list :tickets="tickets"></tickets-list>
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

        data: function () {
            return {
                tickets : [
                    {
                        title : 'Ticket1',
                        closed_at : '02-02-2018',
                        id : 1
                    },
                    {
                        title : 'Ticket2',
                        closed_at : '02-02-2018',
                        id : 2
                    },
                    {
                        title : 'Ticket3',
                        closed_at : '03-02-2018',
                        id : 3
                    }
                ]
            }
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
