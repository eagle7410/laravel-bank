export default {
    state: {
        items: []
    },
    mutations: {
        setStatuses(state, statuses) {
            if (Array.isArray(statuses) && statuses.length) {
                state.items = statuses;
            }
        }
    }
}
