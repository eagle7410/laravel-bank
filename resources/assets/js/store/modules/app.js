export default {
    state: {
        appName      : '',
        csrfToken    : '',
        logoutAction : '',
    },
    mutations: {
        setAppInfo(state, info) {
            for (let p in state) {
                if (info[p]) {
                    state[p] = info[p];
                }
            }
        }
    }
}
