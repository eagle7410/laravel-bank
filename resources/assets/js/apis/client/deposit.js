export default {
    getAll : () => new Promise((ok, bad) => {
        $.get('/deposits')
            .done(ok)
            .fail(bad);

    }),
};
