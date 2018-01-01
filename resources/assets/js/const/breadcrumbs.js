import routes from './routes-employee'
import iconClasses from './icon-classes'

const breadcrumbDash = {
    label : 'DashBoard',
    route : routes.dash,
    iconClass : iconClasses.dash
};
const breadcrumbDeposits = {
    label : 'Deposits',
    route : routes.deposits,
    iconClass : iconClasses.credit
};
const breadcrumbUsers = {
    label : 'Users',
    route : routes.usrs,
    iconClass : iconClasses.user
};

export {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbUsers,
}
