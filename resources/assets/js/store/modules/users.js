export default {
    state: {
        users: []
    },
    mutations: {
        setUsers(state, users) {
            if (Array.isArray(users) && users.length) {
                state.users = users;
            }
        }
    }
}
