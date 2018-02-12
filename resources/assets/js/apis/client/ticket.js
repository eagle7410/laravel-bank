export default {
    save : data => new Promise((ok, bad) => {
        $.post('/ticket', data)
            .done(ok)
            .fail(bad);
    }),
};
