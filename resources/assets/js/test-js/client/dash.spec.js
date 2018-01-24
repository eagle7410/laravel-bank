import Vue from 'vue';
import dash from './assets/dash.json';
import DashBoard from '../../components/dashboard/dashBoard.vue'

require('../../extends');

describe('DashBoard', () => {
    const vm = new Vue(DashBoard).$mount();
    vm.$store = {state : {
        dash : dash,
        commit : (name, data) => {}
    }};

    it('Check default title', () => {
        expect(vm.title).toBe('Dashboard');
    });

    it('Check computed params', () => {
        expect(vm.depositsCount).toBe(3);
        expect(vm.totalIncome).toBe(125);
    });
});
