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
        },
        addAction (state, action) {
            if (action) {
                state.items.push(action);
            }
        },
        updateAction (state, action) {
            if (!action) {
                return false;
            }

            let oldAction = state.items.find(el => el.id == action.id);

            for (let p in oldAction) {
                if (action[p] && p !== 'id') {
                    oldAction[p] = action[p];
                }
            }
        }
    }
}
