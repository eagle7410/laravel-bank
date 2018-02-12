import {routes, iconClasses} from './const'
import Share from  './routes/share'
import MyDeposits from './components/my-deposits/my-deposits.vue'
import MyDepositHistory from './components/my-deposit-history/my-deposit-history'
import TicketCreate from './components/tickets/ticket-create.vue'

import {
    breadcrumbDash,
    breadcrumbTicketOpen,
} from './const/breadcrumbs'

const breadcrumbDeposits = {
    label : 'My deposits',
    route : routes.deposits,
    iconClass : iconClasses.credit
};

export default [
    ...Share,
    {
        ...routes.deposits,
        component: MyDeposits,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'My deposits',
                    route : routes.deposits,
                }
            ]
        }
    },
    {
        ...routes.depositHistory,
        component: MyDepositHistory,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                {
                    label : 'Deposit history',
                    route : routes.depositHistory,
                }
            ]
        }
    },
    {
        ...routes.ticketCreate,
        component: TicketCreate,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbTicketOpen,
                {
                    label : 'Create ticket',
                    route : routes.ticketCreate,
                }
            ]
        }
    },

];
