export default {
    update : data => new Promise((ok, bad) => {
        $.put('/profile', data)
            .done(ok)
            .fail(bad);
    })
};
