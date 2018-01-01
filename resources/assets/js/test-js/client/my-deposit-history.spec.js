import Vue from 'vue';
require('./assets/registration');
import DepositHistory from '../../components/my-deposit-history/my-deposit-history.vue'

describe('DepositHistory', () => {
    const vm = new Vue(DepositHistory).$mount();

    vm.depositId = 25;
    vm.number = 25;

    it('Check computed title', () => {
        expect(vm.title).toBe('Deposit history #25');
    });

});
