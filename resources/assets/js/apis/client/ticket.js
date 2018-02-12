const url = '/ticket';

export default {
    save : data => new Promise((ok, bad) => {
        $.post(url, data)
            .done(ok)
            .fail(bad);
    }),
    close : id => new Promise((ok, bad) => {
        $.put(url, {id})
            .done(ok)
            .fail(bad);
    })
};
