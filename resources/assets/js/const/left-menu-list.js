import iconClasses from './icon-classes'
import routes from './routes'

export default [
    {
        label : 'Dashboard',
        iconClass : iconClasses.dash,
        route : routes.dash
    },
    {
        label : 'DashboardV2',
        iconClass : iconClasses.dash,
        route : routes.dash,
        // TODO: IGOR Back
        counters : [
            {

            }
        ],
        subs : [
            {
                label: 'd1',
                iconClass : iconClasses.circle
            },
            {
                label: 'd2',
                iconClass : iconClasses.circle,
                route : routes.dashD2,
            }
        ]

    }
];
