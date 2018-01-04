export default {
    get : () => new Promise((ok, bad) => {
        $.get('/actions')
            .done(ok)
            .fail(bad);
    })
};
