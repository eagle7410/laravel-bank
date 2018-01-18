import Vue from 'vue';
import VueRouter from 'vue-router'
import routes from './routes'
import {
    components,
    initHtmlProps,
    depositsStatus,
    leftMenuList
} from './const'
import api from './apis/client';

require('./bootstrap');
require('./extends');

Vue.use(VueRouter);

// Registration components
for (let name in components)
    Vue.component(name, components[name]);

// Init routes
const router = new VueRouter({
    linkActiveClass: 'active', // active class for non-exact links.
    linkExactActiveClass: 'active', // active class for *exact* links.
    routes, // short for `routes: routes`
});

// TODO: IGOR Back maybe not use
// Create bus.
const bus = new Vue({});
window.apis = api;

// Init App
const app = new Vue({
    el: '#app',
    computed : {
        _bus : () => bus,
    },
    props : initHtmlProps.map(prop => prop.htmlAttrToVueProp()),
    data: {
        title: 'Title',
        leftMenu : leftMenuList,
        statuses : {
            depositsStatus
        }
    },
    router,
    beforeMount: function () {
        const that = this;

        // Properties get from root elements and set to app props.
        initHtmlProps.map(prop => {
            let val =  '';

            if (that.$el.attributes[prop] && that.$el.attributes[prop].value) {
                val = that.$el.attributes[prop].value;
            }

            that[prop.htmlAttrToVueProp()] = val;

        });
    },

});
