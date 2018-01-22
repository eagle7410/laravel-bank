
export default {
    getAll : (depositId) => new Promise((ok, bad) => {
        $.get(`/deposit-history/${depositId}`)
            .done(ok)
            .fail(bad);
    })
};
