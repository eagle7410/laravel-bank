import Vue from 'vue';
import VueRouter from 'vue-router'
import AppCommon from './app_common'
import routes from './routes-employee'
import api from './apis/employee';
import {componentsEmployee, leftMenuListEmployee} from './const'
import store from './store'

// Registration components
for (let name in componentsEmployee)
    Vue.component(name, componentsEmployee[name]);

window.apis = api;

const router = new VueRouter({
    linkActiveClass: 'active', // active class for non-exact links.
    linkExactActiveClass: 'active', // active class for *exact* links.
    routes:  routes, // short for `routes: routes`
});

// Init App
const app = new Vue({
    mixins : [AppCommon],
    data: {
        leftMenu : leftMenuListEmployee,
    },
    router,
    store
});
