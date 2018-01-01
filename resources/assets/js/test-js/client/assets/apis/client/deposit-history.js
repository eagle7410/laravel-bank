import depositHistory from '../../deposit-history';

export default {
    getAll : (depositId) => new Promise((ok, bad) => {
        ok(depositHistory[depositId]);
    })
};
