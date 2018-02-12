import iconClasses from './icon-classes'
import routes from './routes'

export default [
    {
        label : 'Dashboard',
        iconClass : iconClasses.dash,
        route : routes.dash
    },
    {
        label : 'My Deposits',
        iconClass : iconClasses.credit,
        route : routes.deposits,
    },
    {
        label : 'Notices',
        labels : [
            {
                text  : 0,
                class : 'pull-right bg-yellow'
            }
        ],
        iconClass : iconClasses.bell,
        subs : [
            {
                label : 'Unread',
                route : routes.notifyUnread,
            },
            {
                label : 'Read',
                route : routes.notifyRead,
            },
        ]
    },
    {
        label : 'Tickets',
        labels : [
            {
                text  : 0,
                class : 'pull-right bg-red'
            }
        ],
        iconClass : iconClasses.flag,
        subs : [
            {
                label : 'Create',
                route : routes.ticketCreate,
            },
            {
                label : 'Open',
                route : routes.ticketsOpen,
            },
            {
                label : 'Close',
                route : routes.ticketsClose,
            },
        ]
    }
];
