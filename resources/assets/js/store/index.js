import Vue from 'vue'
import Vuex from 'vuex'
//modules
import actions from './modules/actions'
import statuses from './modules/statuses'
import profile from './modules/profile'
import appInfo from './modules/app'
import dash from './modules/dash'
import deposits from './modules/deposits'
import modal from './modules/modal'

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        actions,
        statuses,
        profile,
        appInfo,
        dash,
        deposits,
        modal
    }
});

export default store
