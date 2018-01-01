import iconClasses from './icon-classes'
import routes from './routes-employee'

export default [
    {
        label : 'Dashboard',
        iconClass : iconClasses.dash,
        route : routes.dash
    },
    {
        label : 'Users',
        iconClass : iconClasses.user,
        route : routes.usrs,
    },
    {
        label : 'Deposits',
        iconClass : iconClasses.credit,
        route : routes.deposits,
    }
];
