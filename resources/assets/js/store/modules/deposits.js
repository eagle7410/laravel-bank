export default {
    state: {
        deposits : [],
        depositId   : null,
        depositNewStatus : null,
    },
    mutations: {
        setDepositsData(state, data) {
            for (let p in data) {
                if (state.hasOwnProperty(p)) {
                    state[p] = data[p];
                }
            }
        },
        applyNewStatus (state, data) {
            let deposit = state.deposits.find(deposit => deposit.id === state.depositId);

            deposit.status = state.depositNewStatus;

            state.depositId = null;
            state.depositNewStatus = null;
        }
    }
}
