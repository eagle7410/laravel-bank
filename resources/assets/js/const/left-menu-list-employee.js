import iconClasses from './icon-classes'
import routes from './routes-employee'

export default [
    {
        label : 'Dashboard',
        iconClass : iconClasses.dash,
        route : routes.dash
    },
    {
        label : 'Users',
        iconClass : iconClasses.user,
        route : routes.usrs,
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
                label : 'Open',
                route : routes.ticketsOpen,
            },
            {
                label : 'Close',
                route : routes.ticketsClose,
            },
        ]
    },
    {
        label : 'Deposits',
        iconClass : iconClasses.credit,
        subs : [
            {
                label : 'Deposits',
                route : routes.deposits,
            },
            {
                label : 'Actions',
                route : routes.depActions,
            },
            {
                label : 'Statuses',
                route : routes.depStatuses,
            },
        ]

    }
];
