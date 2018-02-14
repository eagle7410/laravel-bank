<template>
    <div class="box">

        <ticket-btn-close :ticket="ticket" :is-closed="Boolean(ticket.closed_at)"></ticket-btn-close>

        <div class="box box-warning direct-chat direct-chat-warning ">
            <div class="row">
                <div class="col-lg-7">
                    <div class="box-body">
                        <div class="direct-chat-messages" :id="`tick-${ticket.id}-${dialog.length}`">
                            <ticket-message v-for="message in dialog" :message="message" :key="`mess-${ticket.id}-${message.id}`"></ticket-message>
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
            apiTickets     : () => window.apis.tickets,
            _storeTickets  : () => that.$store.state.tickets,
            ticket         : () => {
                for(let store of ['wait_question', 'wait_answer', 'closed']) {
                    let ticket = that._storeTickets[store].find(ticket => ticket.id == that.$route.params.id);

                    if (ticket && that) {
                        that.$store.commit('setDialogStore', {store});
                        return ticket;
                    }
                }

                return {};
            },
            dialog         : () => that.ticket && that.ticket.isInit ? that.ticket.dialog: [],
        },

        created: function () {
            that = this;
            that.$root.title = 'Ticket dialog';

            that.$store.commit('clearDialogStore');

            if (!that.ticket.isInit ) {

                let ticketId = that.$route.params.id;

                that.apiTickets.getById(ticketId)
                    .then(dialogWithUsers => {
                        that.$store.dispatch(
                            'setAndBuildDialog',
                            {dialogWithUsers, ticketId}
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
