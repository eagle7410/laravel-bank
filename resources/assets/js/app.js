
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('hamburger_button', require('./components/hamburgerButton.vue'));
Vue.component('logo', require('./components/logo.vue'));
Vue.component('messages', require('./components/notification-tools/messages.vue'));
Vue.component('notifications', require('./components/notification-tools/notifications.vue'));
Vue.component('task', require('./components/notification-tools/task.vue'));
Vue.component('settings_slidebar', require('./components/settingsSlidebar.vue'));

const app = new Vue({
    el: '#app',
    components : {
        header_main : require('./components/headerMain.vue'),
        left_column : require('./components/left-column/left-column.vue'),
        footer_main : require('./components/footerMain.vue'),
    }
});
