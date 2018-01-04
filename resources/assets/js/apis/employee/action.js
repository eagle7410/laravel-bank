const baseUrl = '/action';

export default {
    get : (id) => new Promise((ok, bad) => {
        $.get(baseUrl,{id: id})
            .done(ok)
            .fail(bad);
    }),
    save : (data) => new Promise((ok, bad) => {
        $.post(baseUrl, data)
            .done(ok)
            .fail(bad);
    }),
    update : (data) => new Promise((ok, bad) => {
        $.put(baseUrl, data)
            .done(ok)
            .fail(bad);
    }),
};
