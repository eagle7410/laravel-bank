require('./bootstrap');
require('./extends');

import Vue from 'vue';
import VueRouter from 'vue-router'
import {initHtmlProps, depositsStatus} from './const'

Vue.use(VueRouter);

export default {
    el: '#app',
    computed : {
        _storeProfile () { return this.$store.state.profile },
        _storeApp     () { return this.$store.state.appInfo },
        csrfToken     () { return this._storeApp.csrfToken },
        logoutAction  () { return this._storeApp.logoutAction },
        appName       () { return this._storeApp.appName },
        userName      () { return this._storeProfile.name },
        userSurname   () { return this._storeProfile.surname },
        userEmail     () { return this._storeProfile.email },
        userPost      () { return this._storeProfile.post },
        userMember    () { return this._storeProfile.member },
        userId        () { return this._storeProfile.id},

    },
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
        const profile = {};
        const appInfo = {};

        // Properties get from root elements and set to app props.
        initHtmlProps.map(prop => {
            let val =  '';

            if (that.$el.attributes[prop] && that.$el.attributes[prop].value) {
                val = that.$el.attributes[prop].value;
            }

            if (prop.substr(0,4) === 'user') {
                profile[prop.replace(/user\-/g, '')] = val;
            } else {
                appInfo[prop.htmlAttrToVueProp()] = val;
            }
        });

        that.$store.commit('setProfile', profile);
        that.$store.commit('setAppInfo', appInfo);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': that.csrfToken
            }
        });

        that.$store.dispatch(
            'setNotices',
            that.$el.getAttribute('user-notices')
        );

        let notifyChanel =  `user.${that.userId}.notify`;

        window.Echo.addHandles('app', [
            {
                chanel : notifyChanel,
                event  : 'UserAddDepositIncomeEvent',
                handle : res => {
                    that.$store.commit(
                        'noticeNew',
                        window.notifyTools.getNoticeForStore(res.data)
                    );
                }
            },
        ]);
    },
    created : function () {
        let that = this;
    }
}
