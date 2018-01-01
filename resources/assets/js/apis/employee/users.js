export default {
    get : () => new Promise((ok, bad) => {
        $.get('/users')
            .done(ok)
            .fail(err => console.error('Error get users', err))

    })
};
