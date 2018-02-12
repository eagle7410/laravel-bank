import Vue from 'vue'
import Vuex from 'vuex'
//modules
import profile from './modules/profile'
import appInfo from './modules/app'
import dash from './modules/dash'
import deposits from './modules/deposits'
import modal from './modules/modal'
import notices from './modules/notices'
import tickets from './modules/tickets'

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        profile,
        appInfo,
        dash,
        deposits,
        modal,
        notices,
        tickets
    }
});

export default store
