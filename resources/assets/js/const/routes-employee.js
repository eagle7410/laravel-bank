import routes from './routes'

export default {
    ...routes,
    usrs : {
        path : '/users'
    },
    new_usr : {
        path : '/user-create'
    }
};
