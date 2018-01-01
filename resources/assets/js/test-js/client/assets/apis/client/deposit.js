import deposits from '../../deposits.json';

export default {
    getAll : () => new Promise((ok, bad) => {
        ok(deposits);
    })
};
