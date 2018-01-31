export default {
    state: {
        deposits : [],
        depositId   : null,
        depositNewStatus : null,
        isInit : false,
    },
    mutations: {
        setDepositsData(state, data) {
            for (let p in data) {
                if (state.hasOwnProperty(p)) {
                    state[p] = data[p];
                }
            }

            state.isInit = true;

        },
        addDeposit (state, deposit) {
            state.deposits =[deposit].concat(state.deposits);
        },
        applyNewStatus (state, data) {
            let deposit = state.deposits.find(deposit => deposit.id === state.depositId);

            deposit.status = state.depositNewStatus;

            state.depositId = null;
            state.depositNewStatus = null;
        },
        depositNewStatus (state, data) {
            let deposit = state.deposits.find(deposit => deposit.id === data.id);
            deposit.status = data.status;
            deposit.income = data.income;
        }
    }
}
