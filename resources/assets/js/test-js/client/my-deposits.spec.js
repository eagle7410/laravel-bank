import Vue from 'vue';
require('./assets/registration');
import deposits from './assets/deposits.json';
import Deposit from '../../components/my-deposits/my-deposits'

describe('Deposit', () => {

    it('Check default title', () => {
        expect(typeof Deposit.data).toBe('function');
        var defaultData = Deposit.data();
        expect(defaultData.title).toBe('My deposits');
    });

    it('Check total sum and total last income', () => {
        const vm = new Vue(Deposit).$mount();
        vm.deposits = deposits;
        expect(vm.totalSum).toBe(525);
        expect(vm.totalLastIncome).toBe(75);
    });
});
