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

// tickets listeners
window.listenTickets = [
    {
        chanel : 'employee.tickets',
        event  : 'TicketCreateEvent',
        handle : res => app.$store.commit('setNewTicket', res.data)
    },
    {
        chanel : 'employee.tickets',
        event  : 'TicketNewSendEvent',
        handle : res => app.$store.commit('newSend', res.data)
    },
    {
        chanel : 'employee.tickets',
        event  : 'TicketCloseEvent',
        handle : res => {
            app.$store.commit('closedTicket', res.data)
        }
    },
];
