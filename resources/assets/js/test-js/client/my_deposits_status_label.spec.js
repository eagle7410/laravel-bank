import Vue from 'vue'
import DepositLabel from '../../components/status-label'
import {depositsStatus} from '../../const'

// вспомогательная функция, выполняющая монтирование и
// возвращающая строку с результатами рендеринга
function getComponentWithProps (Component, propsData) {
    const Constructor = Vue.extend(Component);
    const vm = new Constructor({ propsData: propsData || {} }).$mount();
    return vm;
}


describe('Deposits Label', () => {

    it('Check default Deposits', () => {
        expect(typeof DepositLabel.data).toBe('function');

        const defaultData = DepositLabel.data();

        expect(defaultData.statuses).toBe(depositsStatus);
    });

    it('Check status active', () => {

        const $el = getComponentWithProps(DepositLabel);

        expect($el.label(depositsStatus.active)).toBe('Active');
        expect($el.cssClass(depositsStatus.active)).toBe('alert bg-green')
    });

    it('Check status Stopped', () => {

        const $el = getComponentWithProps(DepositLabel);

        expect($el.label(depositsStatus.stopped)).toBe('Stopped');
        expect($el.cssClass(depositsStatus.stopped)).toBe('alert bg-red')
    });

    it('Check status verification', () => {

        const $el = getComponentWithProps(DepositLabel, {status : depositsStatus.verification});
        const data = $el.data;

        expect($el.label(depositsStatus.verification)).toBe('On verification');
        expect($el.cssClass(depositsStatus.verification)).toBe('alert bg-yellow');
    });
});
