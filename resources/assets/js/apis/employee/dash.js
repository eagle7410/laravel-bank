export default {
    get : () => new Promise((ok, bad) => {
        $.get('/deposits-stats')
            .done(ok)
            .fail(bad);
    })
};
