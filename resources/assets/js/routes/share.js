import {routes, iconClasses} from '../const'
import DashBoard from '../components/dashboard/dashBoard.vue'
import Profile from '../components/profile/profile.vue'
import NotifyRead from '../components/notify/notify-reads.vue'
import NotifyUnread from '../components/notify/notify-unreads.vue'

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
    {
        ...routes.notifyRead,
        component: NotifyRead,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'Notices reading',
                    route : routes.notifyRead,
                    iconClass : iconClasses.bell
                }
            ]
        }
    },
    {
        ...routes.notifyUnread,
        component: NotifyUnread,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'Notices unread',
                    route : routes.notifyUnread,
                    iconClass : iconClasses.bell
                }
            ]
        }
    },
];
