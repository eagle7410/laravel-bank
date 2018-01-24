import Vue from 'vue';
import VueRouter from 'vue-router'
import AppCommon from './app_common'
import routes from './routes'
import api from './apis/client';
import {components, leftMenuList } from './const'
import store from './store/store-client'

// Registration components
for (let name in components)
    Vue.component(name, components[name]);

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
        leftMenu : leftMenuList,
    },
    router,
    store
});
