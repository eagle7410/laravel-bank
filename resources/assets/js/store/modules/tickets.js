export default {
    state: {
        wait_answer   : [],
        wait_question : [],
        closed        : []
    },
    mutations: {
        setTickets : (state, data) => {
            state[data.type] = data.tickets;
        },
        setDialog : (state, data) => {
            let store = state[data.store];
            let ticket = store.find(ticket => ticket.id == data.ticketId);

            ticket.dialog = data.dialog;
            ticket.isInit = true;
        }
    },
    actions: {
        setAndBuildDialog ({commit}, data) {
            let users = {};

            data.dialogWithUsers.users.map(user => {
                users[user.id] = user;
            });

            let dialog = data.dialogWithUsers.dialog.map(message => {

                let is_support = message.is_support;
                let user = users[message.created_by];
                let name;

                if (!user.name_first && !user.name_last) {
                    name = is_support ? 'Best Support' : 'Dear Client';
                } else {
                    name = `${user.name_first} ${user.name_last}`;
                }

                return {
                    id         : message.id,
                    created_at : message.created_at,
                    text       : message.text,
                    avatar     : user.avatar,
                    is_support,
                    name
                };
            });

            commit('setDialog', {
                dialog,
                store    : data.store,
                ticketId : data.ticketId,
            });
        },
        setTicketsOpened ({commit}, tickets) {
            let wait_question = [];
            let wait_answer = [];

            tickets.map(ticket => {
                ticket.isInit = false;
                ticket.dialog = [];

                (ticket.is_read_support ? wait_question : wait_answer ).push(ticket)
            });

            commit('setTickets', {tickets :wait_answer,   type : 'wait_answer'});
            commit('setTickets', {tickets :wait_question, type : 'wait_question'});
        }
    }
}
