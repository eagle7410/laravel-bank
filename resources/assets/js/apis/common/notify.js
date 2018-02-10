export default {
    isRead : id => new Promise((ok, bad) => {
        $.patch('/notify', {id : id})
            .done(ok)
            .fail(bad);
    })
};
