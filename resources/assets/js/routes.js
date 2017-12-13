import {routes} from './const'
import dashBoard from './components/dashboard/dashBoard.vue'

const breadcrumbDash = {
    label : 'DashBoard',
    route : routes.dash,
    iconClass : 'fa fa-dashboard'
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
