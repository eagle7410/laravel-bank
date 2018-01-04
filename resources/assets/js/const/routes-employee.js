import routes from './routes'

export default {
    ...routes,
    usrs : {
        path : '/users'
    },
    new_usr : {
        path : '/user-create'
    },
    depCreate : {
        path : '/deposit-create'
    },
    depActions : {
        path : '/deposit-actions'
    },
    depActionEdit : {
        path : '/deposit-action-edit/:id'
    },
    depActionCreate : {
        path : '/deposit-action-create'
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
