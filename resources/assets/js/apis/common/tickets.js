export default {
    getAll : () => new Promise((ok, bad) => {
        $.get('/tickets')
            .done(ok)
            .fail(bad);
    }),
    getById : id => new Promise((ok, bad) => {
        $.get('/ticket-dialog', {id : id})
            .done(ok)
            .fail(bad);
    })
};
