<template>
    <div class="box">

        <ticket-btn-close :ticket="ticket"></ticket-btn-close>

        <div class="box box-warning direct-chat direct-chat-warning ">
            <div class="row">
                <div class="col-lg-7">
                    <div class="box-body">
                        <div class="direct-chat-messages">
                            <ticket-message v-for="(message, inx) in ticket.dialog" :message="message" :key="`mess-${inx}`"></ticket-message>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ">
                    <ticket-send-form
                            :isClosed="Boolean(ticket.closed_at)"
                    ></ticket-send-form>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import TicketMessage from './ticket-message.vue'
    import TicketBtnClose from './ticket-btn-close.vue'
    import TicketSendForm from './ticket-send-form.vue'
    let that;

    export default {
        components : {
            TicketMessage,
            TicketBtnClose,
            TicketSendForm
        },

        computed : {
            apiTicketsOpen : () => window.apis.ticketsOpen,
            _storeTickets : () => that.$store.state.tickets,
            ticket        : () => {
                let searchIn = store => {
                    return that._storeTickets[store].find(ticket => ticket.id == that.$route.params.id)
                };

                if (that.store) {
                    return searchIn(that.store);
                }

                for(let store of ['wait_question', 'wait_answer', 'closed']) {
                    let ticket = searchIn(store);

                    if (ticket) {
                        that.store = store;
                        return ticket;
                    }
                }

                return {};
            }
        },
        
        data : function () {
            return {
                store : '',
            };
        },

        created: function () {
            that = this;
            that.$root.title = 'Ticket dialog';

            if (!that.ticket.isInit) {

                let ticketId = that.$route.params.id;

                that.apiTicketsOpen.getById(ticketId)
                    .then(dialogWithUsers => {
                        that.$store.dispatch(
                            'setAndBuildDialog',
                            {
                                dialogWithUsers,
                                ticketId,
                                store : that.store,
                            }
                        );
                    })
                    .catch(err => console.error('Error get dialog ', err));
            }
        }
    }
</script>
<style scoped>
    .block-send {
        padding-top: 5px;
    }
    .direct-chat-messages {
        overflow-x: hidden;
    }
</style>
