import Vue from 'vue';
import VueRouter from 'vue-router'
import AppCommon from './app_common'
import routes from './routes-employee'
import routesParams from './router-params'
import api from './apis/employee';
import {componentsEmployee, leftMenuListEmployee} from './const'
import store from './store/store-employee'

// Registration components
for (let name in componentsEmployee)
    Vue.component(name, componentsEmployee[name]);

window.apis = api;

const router = new VueRouter({
    ...routesParams,
    routes, // short for `routes: routes`
});

// Init App
const app = new Vue({
    mixins : [AppCommon],
    data: {
        leftMenu : leftMenuListEmployee,
        isClient : false,
    },
    router,
    store
});
