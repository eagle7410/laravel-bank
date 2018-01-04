import deposits from '../../test-js/client/assets/deposits.json';

export default {
    getAll : () => new Promise((ok, bad) => {
        ok(deposits);
    }),
    save : (data) => new Promise((ok, bad) => {
        $.post('/deposit', data)
            .done(ok)
            .fail(bad);
    }),
};
