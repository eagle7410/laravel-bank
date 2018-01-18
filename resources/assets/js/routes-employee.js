import {routesEmployee as routes} from './const'
import Share from  './routes/share'
import Deposits from './components/deposits/deposits'
import Deposit from './components/deposits/deposit'
import Users from './components/users/users'
import NewUser from './components/user/new-user'
import MyDepositHistory from './components/my-deposit-history/my-deposit-history'
import routesDepositStatuses from './routes/deposit-statuses';
import routesDepositActions from './routes/deposit-actions';

import {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbUsers,
} from './const/breadcrumbs'

export default [
    ...Share,
    ...routesDepositStatuses,
    ...routesDepositActions,
    {
        ...routes.usrs,
        component: Users,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'Users',
                    route : routes.usrs,
                }
            ]
        }
    },
    {
        ...routes.new_usr,
        component: NewUser,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbUsers,
                {
                    label : 'New',
                    route : routes.usrs,
                }
            ]
        }
    },
    {
        ...routes.deposits,
        component: Deposits,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'Deposits',
                    route : routes.deposits,
                }
            ]
        }
    },
    {
        ...routes.depCreate,
        component: Deposit,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                {
                    label : 'Create',
                    route : routes.depCreate,
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
];
