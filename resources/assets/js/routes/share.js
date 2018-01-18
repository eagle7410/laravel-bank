import {routes} from '../const'
import DashBoard from '../components/dashboard/dashBoard.vue'
import Profile from '../components/profile/profile.vue'

import {
    breadcrumbDash,
} from '../const/breadcrumbs'

export default [
    {
        ...routes.def,
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
        ...routes.profile,
        component: Profile,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'You profile',
                    route : routes.profile,
                }
            ]
        }
    },
];
