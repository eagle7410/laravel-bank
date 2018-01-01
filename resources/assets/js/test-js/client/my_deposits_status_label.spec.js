import Vue from 'vue'
import DepositLabel from '../../components/status-label'
import {depositsStatus} from '../../const'

// вспомогательная функция, выполняющая монтирование и
// возвращающая строку с результатами рендеринга
function getComponentWithProps (Component, propsData) {
    const Constructor = Vue.extend(Component);
    const vm = new Constructor({ propsData: propsData }).$mount();
    return vm;
}


describe('Deposits Label', () => {

    it('Check default Deposits', () => {
        expect(typeof DepositLabel.data).toBe('function');

        const defaultData = DepositLabel.data();

        expect(defaultData.statuses).toBe(depositsStatus);
        expect(defaultData.cssClass).toBe('');
        expect(defaultData.label).toBe('');
    });

    it('Check status active', () => {

        const $el = getComponentWithProps(DepositLabel, {status : depositsStatus.active});
        const data = $el.data;

        expect($el.label).toBe('Active');
        expect($el.cssClass).toBe('green')
    });

    it('Check status Stopped', () => {

        const $el = getComponentWithProps(DepositLabel, {status : depositsStatus.stopped});
        const data = $el.data;

        expect($el.label).toBe('Stopped');
        expect($el.cssClass).toBe('red')
    });

    it('Check status verification', () => {

        const $el = getComponentWithProps(DepositLabel, {status : depositsStatus.verification});
        const data = $el.data;

        expect($el.label).toBe('On verification');
        expect($el.cssClass).toBe('yellow');
    });
});
