<template>
    <div class="row">
        <div class="col-lg-4">
            <box title="9 ticket need close or ask new question" v-model="isQuestionClose">
                <tickets-list :tickets="ticketQuestion"></tickets-list>
            </box>
        </div>
        <div class="col-lg-4">
            <box title="This is ticket wait answer from support." v-model="isAnswerClose" >
                <tickets-list :tickets="ticketAnswers"></tickets-list>
            </box>
        </div>



    </div>
</template>

<script>
    import Box from '../common/box.vue'
    import TicketsList from './tikets-list.vue'

    let that;

    export default {
        components : {
            Box,
            TicketsList
        },

        computed : {
            _storeTickets   : () => that.$store.state.tickets,
            isQuestionClose : {
                get () {
                    return that._storeTickets.isWaitQuestionClose;
                },
                set (value) {
                    that.$store.commit('setIsQuestionClose', value);
                }
            },
            isAnswerClose   : {
                get () {
                    return that._storeTickets.isWaitAnswerClose;
                },
                set (value) {
                    that.$store.commit('setIsAnswerClose', value);
                }
            },
            ticketAnswers   : () => that._storeTickets.wait_answer,
            ticketQuestion  : () => that._storeTickets.wait_question,
        },

        created: function () {
            that = this;
            that.$root.title = 'Tickets opened';
        }
    }
</script>
