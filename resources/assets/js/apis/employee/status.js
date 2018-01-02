export default {
    get : (id) => new Promise((ok, bad) => {
        $.get('/status',{id: id})
            .done(ok)
            .fail(bad);
    }),
    save : (data) => new Promise((ok, bad) => {
        $.post('/status', data)
            .done(ok)
            .fail(bad);
    }),
    update : (data) => new Promise((ok, bad) => {
        $.put('/status', data)
            .done(ok)
            .fail(bad);
    }),
};
