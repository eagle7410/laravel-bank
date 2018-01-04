import {routesEmployee as routes} from '../const'
import DepositStatuses from '../components/deposits-statuses/statuses'
import DepositStatus from '../components/deposits-statuses/status'

import {
    breadcrumbDash,
    breadcrumbDeposits,
    breadcrumbDepositStatuses
} from '../const/breadcrumbs'

export default [
    {
        ...routes.depStatusCreate,
        component: DepositStatus,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositStatuses,
                {
                    label : 'Create',
                    route : routes.depStatusCreate
                }
            ]
        }
    },
    {
        ...routes.depStatusEdit,
        component: DepositStatus,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositStatuses,
                {
                    label : 'Edit',
                    route : routes.depStatusEdit
                }
            ]
        }
    },
    {
        ...routes.depStatuses,
        component: DepositStatuses,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbDeposits,
                breadcrumbDepositStatuses
            ]
        }
    },
];
