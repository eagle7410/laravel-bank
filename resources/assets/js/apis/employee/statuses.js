export default {
    get : () => new Promise((ok, bad) => {
        $.get('/statuses')
            .done(ok)
            .fail(bad);
    })
};
