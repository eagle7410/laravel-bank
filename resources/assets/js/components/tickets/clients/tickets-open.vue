<template>
    <div class="row">
        <div class="col-lg-4">
            <box title="9 ticket need close or ask new question" :is-close="false">
                <tickets-list :tickets="tickets"></tickets-list>
            </box>
        </div>
        <div class="col-lg-4">
            <box title="This is ticket wait answer from support." :is-close="false" >
                <tickets-list :tickets="tickets"></tickets-list>
            </box>
        </div>



    </div>
</template>

<script>
    import Box from '../../common/box.vue'
    import TicketsList from '../tikets-list.vue'

    let that;

    export default {
        components : {
            Box,
            TicketsList
        },

        data: function () {
            return {
                tickets : [
                    {
                        title : 'Ticket1',
                        closed_at : null,
                        id : 1
                    },
                    {
                        title : 'Ticket2',
                        closed_at : null,
                        id : 2
                    },
                    {
                        title : 'Ticket3',
                        closed_at : null,
                        id : 3
                    }
                ]
            }
        },

        created: function () {
            that = this;

            that.$root.title = 'Tickets opened';
        }
    }
</script>
