import Deposit from '../../components/my-deposits/my-deposits'

describe('Deposit', () => {

    it('Check default title', () => {
        expect(typeof Deposit.data).toBe('function');
        var defaultData = Deposit.data();
        expect(defaultData.title).toBe('My deposits');
    });
});
