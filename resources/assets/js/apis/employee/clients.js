export default {
    get: () => new Promise((ok, bad) => {
        $.get('/clients')
            .done(ok)
            .fail(err => console.error('Error get clients active', err))

    })
};
