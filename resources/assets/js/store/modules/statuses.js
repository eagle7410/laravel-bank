export default {
    state: {
        items: [],
        isInit : false,
    },
    mutations: {
        setStatuses(state, statuses) {
            if (Array.isArray(statuses) && statuses.length) {
                state.items = statuses;
                state.isInit = true;
            }
        }
    }
}
