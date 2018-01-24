export default {
    state: {
        items: []
    },
    mutations: {
        setActions(state, actions) {
            if (Array.isArray(actions) && actions.length) {
                state.items = actions;
            }
        }
    }
}
