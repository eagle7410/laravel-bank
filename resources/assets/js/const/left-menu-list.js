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
    }
];
