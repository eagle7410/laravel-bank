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
        },
        addStatus (state, status) {
            if (status) {
                state.items.push(status);
            }
        },
        updateStatus (state, status) {
            if (!status) {
                return false;
            }

            let oldStatus = state.items.find(el => el.id == status.id);

            for (let p in oldStatus) {
                if (status[p] && p !== 'id') {
                    oldStatus[p] = status[p];
                }
            }
        }
    }
}
