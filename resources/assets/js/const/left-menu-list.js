import iconClasses from './icon-classes'
import routes from './routes'

export default [
    {
        label : 'Dashboard',
        iconClass : iconClasses.dash,
        route : routes.dash
    },
    {
        label : 'My Deposits',
        iconClass : iconClasses.credit,
        route : routes.deposits,
    }
];
