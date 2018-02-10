import Vue from 'vue'
import Vuex from 'vuex'
//modules
import profile from './modules/profile'
import appInfo from './modules/app'
import dash from './modules/dash'
import deposits from './modules/deposits'
import modal from './modules/modal'
import users from './modules/users'
import actions from './modules/actions'
import statuses from './modules/statuses'
import notices from './modules/notices'

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        profile,
        appInfo,
        dash,
        deposits,
        modal,
        users,
        actions,
        statuses,
        notices
    }
});

export default store
