export default {
    getAll : () => new Promise((ok, bad) => {
        $.get('/deposits')
            .done(ok)
            .fail(bad);

    }),
    changeStatus: (data) => new Promise((ok, bad) => {
        $.patch('/deposit', data)
            .done(ok)
            .fail(bad);
    }),
};
