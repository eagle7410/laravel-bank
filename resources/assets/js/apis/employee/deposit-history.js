import depositHistory from '../../test-js/client/assets/deposit-history';

export default {
    getAll : (depositId) => new Promise((ok, bad) => {
        ok(depositHistory[depositId]);
    })
};
