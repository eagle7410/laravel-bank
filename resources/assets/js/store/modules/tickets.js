export default {
    state: {
        wait_answer         : [],
        wait_question       : [],
        closed              : [],
        isWaitAnswerClose   : false,
        isWaitQuestionClose : false,
        dialogStore         : '',
        isInitClosed        : false,
    },
    mutations: {
        setNewTicket       : (state, ticket) => {
            ticket.isInit = false;
            ticket.dialog = [];

            state.wait_answer.push(ticket);
        },
        setIsQuestionClose : (state, value) => {
            state.isWaitQuestionClose = value;
        },
        setIsAnswerClose : (state, value) => {
            state.isWaitAnswerClose = value;
        },
        clearDialogStore : (state) => {
            state.dialogStore = '';
        },
        setDialogStore : (state, data) => {
            state.dialogStore = data.store;
        },
        setTickets : (state, data) => {
            state[data.type] = data.tickets;
        },
        closeTicket : (state, data) => {
            let store  = state[state.dialogStore];

            for (let inx in store) {
                let ticket = store[inx];

                if (ticket.id == data.id) {
                    state.closed.push({
                        ...ticket,
                        closed_at : data.closed_at
                    });
                    state.dialogStore = 'closed';
                    store.splice(inx, 1);

                    return false;
                }
            }
        },
        closedTicket : (state, data) => {
            for (let currStore of ['wait_question', 'wait_answer', 'closed']) {
                let store  = state[currStore];

                for (let inx in store) {
                    let ticket = store[inx];

                    if (ticket.id == data.id) {
                        state.closed.push({
                            ...ticket,
                            closed_at : data.closed_at
                        });
                        state.dialogStore = 'closed';
                        store.splice(inx, 1);

                        return false;
                    }
                }
            }

        },
        setDialog : (state, data) => {
            let store = state[state.dialogStore];
            let ticket = store.find(ticket => ticket.id == data.ticketId);

            ticket.dialog = data.dialog;
            ticket.isInit = true;
        },
        newSend : (state, data)  => {
            let store = '';
            let storeTicket;
            let index;

            for (let currStore of ['wait_question', 'wait_answer', 'closed']) {
                storeTicket = state[currStore].find((ticket, inx) => {
                    index  = inx;
                    return data.ticket.id == ticket.id
                });

                if (storeTicket) {

                    if (storeTicket.closed_at) {
                        return false;
                    }

                    store = currStore;
                    break;
                }
            }

            let name;
            let user = data.author;

            if (user.name_last === 'Dear') {
                name = data.send.is_support ? 'Best Support' : 'Dear Client';
            } else {
                name = `${user.name_first} ${user.name_last}`;
            }

            storeTicket = {
                ...storeTicket,
                ...data.ticket,
                dialog : [{
                    id         : data.send.id,
                    created_at : data.send.created_at,
                    text       : data.send.text,
                    avatar     : data.author.avatar,
                    is_support : data.send.is_support,
                    name
                }].concat(storeTicket.dialog)
            };

            let setTo = data.send.is_support ? 'wait_question' : 'wait_answer';

            if (store !== setTo) {
                state[setTo] = [storeTicket].concat(state[setTo]);
                state[store] = [].concat();
            } else {
                state[store][index] = storeTicket;
                state[store] = [].concat(state[store]);
            }
        },
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
                ticketId : data.ticketId,
            });
        },
        setTickets ({commit}, tickets) {
            let wait_question = [];
            let wait_answer   = [];
            let closed        = [];

            tickets.map(ticket => {
                ticket.isInit = false;
                ticket.dialog = [];

                if (ticket.closed_at) {
                    closed.push(ticket);
                    return false;
                }

                (ticket.is_read_support ? wait_question : wait_answer ).push(ticket)
            });

            commit('setTickets', {tickets : closed,        type : 'closed'});
            commit('setTickets', {tickets : wait_answer,   type : 'wait_answer'});
            commit('setTickets', {tickets : wait_question, type : 'wait_question'});
        }
    }
}
