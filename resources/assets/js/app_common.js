require('./bootstrap');
require('./extends');

import Vue from 'vue';
import VueRouter from 'vue-router'
import {initHtmlProps, depositsStatus} from './const'

Vue.use(VueRouter);

export default {
    el: '#app',
    props : initHtmlProps.map(prop => prop.htmlAttrToVueProp()),
    data  : function () {
        return {
            title    : 'Title',
            statuses : {
                depositsStatus
            }
        }
    },
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
    },
    created : function () {
        let that = this;

        that.listen('NEW_PROFILE_DATA', data => {
            that.userName    = data.name_first;
            that.userSurname = data.name_last;
        });
    }
}
