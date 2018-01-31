export default {
    state: {
        items: [],
        isInit : false,
    },
    mutations: {
        setActions(state, actions) {
            if (Array.isArray(actions) && actions.length) {
                state.items = actions;
                state.isInit = true;
            }
        }
    }
}
