import Vue from 'vue';
import VueRouter from 'vue-router'
import routes from './routes'
import {components, initHtmlProps} from './const'

require('./bootstrap');
require('./extends');

Vue.use(VueRouter);

// Registration components
for (let name in components)
    Vue.component(name, components[name]);

// Init routes
const router = new VueRouter({
    routes // short for `routes: routes`
});

// TODO: IGOR Back maybe not use
// Create bus.
const bus = new Vue({});

// Init App
const app = new Vue({
    el: '#app',
    computed : {
        _bus : () => bus
    },
    props : initHtmlProps.map(prop => prop.htmlAttrToVueProp()),
    data: {
        title: 'Title'
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
    }
});
