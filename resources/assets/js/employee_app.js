import Vue from 'vue';
import VueRouter from 'vue-router'
import routes from './routes-employee'
import {componentsEmployee, initHtmlProps, depositsStatus, leftMenuListEmployee} from './const'
import api from './apis/employee';

require('./bootstrap');
require('./extends');

Vue.use(VueRouter);

// Registration components
for (let name in componentsEmployee)
    Vue.component(name, componentsEmployee[name]);

// Init routes
const router = new VueRouter({
    linkActiveClass: 'active', // active class for non-exact links.
    linkExactActiveClass: 'active', // active class for *exact* links.
    routes, // short for `routes: routes`
});

// Create bus.
const bus = new Vue({});

Vue.mixin({
    computed : {
        emitter : () => bus,
    },
    methods : {
        listen : function(event, handler) {
            let emitter = this.emitter;
            emitter.$off(event);
            emitter.$on(event, handler);
        },
        listeners : function(objectHandlers) {
            Object.keys(objectHandlers).map(event => this.listen(event, objectHandlers[event]) );
        },
        $fire : function (event, data) {
            this.emitter.$emit(event, data);
        }
    },
});

window.apis = api;

// Init App
const app = new Vue({
    el: '#app',
    props : initHtmlProps.map(prop => prop.htmlAttrToVueProp()),
    data: {
        title: 'Title',
        leftMenu : leftMenuListEmployee,
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

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': that.csrfToken
            }
        });
    }
});
