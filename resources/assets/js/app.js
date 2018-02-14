import Vue from 'vue';
import VueRouter from 'vue-router'
import AppCommon from './app_common'
import routes from './routes'
import routesParams from './router-params'
import api from './apis/client';
import {components, leftMenuList } from './const'
import store from './store/store-client'

// Registration components
for (let name in components)
    Vue.component(name, components[name]);

window.apis = api;

const router = new VueRouter({
    ...routesParams,
    routes, // short for `routes: routes`
});

// tickets listeners
window.listenTickets = [];

// Init App
const app = new Vue({
    mixins : [AppCommon],
    data: {
        leftMenu : leftMenuList,
        isClient : true,
    },
    router,
    store
});

let userId = $('#app').attr('user-id');
let ticketChanel = `user.${userId}.tickets`;

// tickets listeners
window.listenTickets = [
    {
        chanel : ticketChanel,
        event  : 'UserTicketNewSendEvent',
        handle : res => app.$store.commit('newSend', res.data)
    }
];
