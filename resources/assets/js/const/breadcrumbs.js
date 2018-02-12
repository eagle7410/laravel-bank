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
const breadcrumbDepositStatuses = {
    label : 'Deposits statuses',
    route : routes.depStatuses,
};
const breadcrumbDepositActions = {
    label : 'Deposits actions',
    route : routes.depActions,
};

const breadcrumbTicketOpen = {
    label : 'Tickets open',
    route : routes.ticketsOpen,
    iconClass : iconClasses.flag
};

export {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbUsers,
    breadcrumbDepositStatuses,
    breadcrumbDepositActions,
    breadcrumbTicketOpen
}
