import stats from '../../dash.json';

export default {
    get : () => new Promise((ok, bad) => {
        ok(stats);
    })
};
