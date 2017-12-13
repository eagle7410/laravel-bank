import {routes, iconClasses} from './const'
import dashBoard from './components/dashboard/dashBoard.vue'

const breadcrumbDash = {
    label : 'DashBoard',
    route : routes.dash,
    iconClass : iconClasses.dash
};

export default [
    {
        path: '/',
        component: dashBoard,
        meta : {
            breadcrumbs : [
                breadcrumbDash
            ]
        }

    },
    {
        ...routes.dash,
        component: dashBoard,
        meta : {
            breadcrumbs : [
                breadcrumbDash
            ]
        }
    }
];
