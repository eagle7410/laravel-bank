import {routesEmployee as routes} from '../const'
import DepositActions from '../components/deposits-actions/actions'
import DepositAction from '../components/deposits-actions/action'

import {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbDepositActions
} from '../const/breadcrumbs'

export default [
    {
        ...routes.depActionCreate,
        component: DepositAction,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositActions,
                {
                    label : 'Create',
                    route : routes.depStatusCreate
                }
            ]
        }
    },
    {
        ...routes.depActionEdit,
        component: DepositAction,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositActions,
                {
                    label : 'Edit',
                    route : routes.depStatusEdit
                }
            ]
        }
    },
    {
        ...routes.depActions,
        component: DepositActions,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositActions
            ]
        }
    },
];
