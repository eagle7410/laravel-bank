export default {
    state: {
        totalSum: 0,
        totalDeposits: 0,
        depositsCountActive: 0,
        depositsCountStopped: 0,
        depositsCountVerification: 0,
    },
    mutations: {
        setDashData(state, data) {
            for (let p in state) {
                if (data[p]) {
                    state[p] = data[p];
                }
            }

        }
    }
}
