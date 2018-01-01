import deposits from '../../test-js/client/assets/deposits.json';

export default {
    getAll : () => new Promise((ok, bad) => {
        ok(deposits);
    })
};
