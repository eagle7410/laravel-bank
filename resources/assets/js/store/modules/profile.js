export default {
    state: {
        id      : null,
        name    : 'Dear',
        surname : 'Client',
        email   : '',
        post    : 'Client',
        member  : '',
    },
    mutations: {
        setProfile(state, profile) {
           for (let p in state) {
               if (profile[p]) {
                   state[p] = profile[p];
               }
           }
        }
    }
}
