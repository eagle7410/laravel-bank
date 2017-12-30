import {routes, iconClasses} from './const'
import DashBoard from './components/dashboard/dashBoard.vue'
import MyDeposits from './components/my-deposits/my-deposits.vue'
import MyDepositHistory from './components/my-deposit-history/my-deposit-history'

const breadcrumbDash = {
    label : 'DashBoard',
    route : routes.dash,
    iconClass : iconClasses.dash
};
const breadcrumbDeposits = {
    label : 'My deposits',
    route : routes.deposits,
    iconClass : iconClasses.credit
};

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
];
