import routes from './routes'

export default {
    ...routes,
    usrs : {
        path : '/users'
    },
    new_usr : {
        path : '/user-create'
    },
    depActions : {
        path : '/deposit-actions'
    },
    depStatuses : {
        path : '/deposit-statuses'
    },
    depStatusEdit : {
        path : '/deposit-status-edit/:id'
    },
    depStatusCreate : {
        path : '/deposit-status-create'
    }
};
