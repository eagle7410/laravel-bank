import stats from '../../test-js/client/assets/dash.json';

export default {
    get : () => new Promise((ok, bad) => {
        ok(stats);
    })
};
