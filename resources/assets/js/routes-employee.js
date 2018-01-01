import {routesEmployee as routes} from './const'
import DashBoard from './components/dashboard/dashBoard'
import Deposits from './components/deposits/deposits'
import Users from './components/users/users'
import NewUser from './components/user/new-user'
import MyDepositHistory from './components/my-deposit-history/my-deposit-history'
import {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbUsers
} from './const/breadcrumbs'

export default [
    {
        path: '/',
        component: DashBoard,
        meta : {
            breadcrumbs : [
                breadcrumbDash
            ]
        }
    },
    {
        ...routes.dash,
        component: DashBoard,
        meta : {
            breadcrumbs : [
                breadcrumbDash
            ]
        }
    },
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
