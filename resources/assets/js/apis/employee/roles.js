export default {
    get : () => new Promise((ok, bad) => {
        $.get('/roles')
            .done(ok)
            .fail(bad);
    })
};
