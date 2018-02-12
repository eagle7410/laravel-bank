import {routes, iconClasses} from '../const'
import DashBoard from '../components/dashboard/dashBoard.vue'
import Profile from '../components/profile/profile.vue'
import NotifyRead from '../components/notify/notify-reads.vue'
import NotifyUnread from '../components/notify/notify-unreads.vue'
import TicketsClose from '../components/tickets/tickets-close.vue'
import TicketDialog from '../components/tickets/ticket-dialog.vue'
import TicketOpen from '../components/tickets/tickets-open.vue'
import {
    breadcrumbDash,
    breadcrumbTicketOpen
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
    {
        ...routes.ticketsClose,
        component: TicketsClose,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                {
                    label : 'Tickets closed',
                    route : routes.ticketsClose,
                    iconClass : iconClasses.flag
                }
            ]
        }
    },
    {
        ...routes.ticketMess,
        component: TicketDialog,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbTicketOpen,
                {
                    label : 'Ticket dialog',
                    route : routes.ticketMess,
                }
            ]
        }
    },
    {
        ...routes.ticketsOpen,
        component: TicketOpen,
        meta : {
            breadcrumbs : [
                breadcrumbDash,
                breadcrumbTicketOpen
            ]
        }
    },
];
