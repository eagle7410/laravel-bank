export default {
    send : data => new Promise((ok, bad) => {
        $.patch('/ticket', data)
            .then(ok)
            .catch(bad);
    }),
}
