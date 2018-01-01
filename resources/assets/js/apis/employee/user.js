export default {
    save : date => new Promise((ok, bad) => {
        $.post('/user', date)
            .done(ok)
            .fail(bad)
    })
};
