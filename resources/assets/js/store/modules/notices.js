export default {
    state: {
        read   : [],
        unread : [],
        serverErrors : {}
    },
    mutations: {
        setNotices(state, data) {
            let {type, notices} = data;

            if (!Array.isArray(notices) || !notices.length) {
                return false;
            }

            state[type] = notices;
        },
        clearErrors (state) {
            state.serverErrors = {};
        },
        setErrors (state, errors) {
            state.serverErrors = errors;
        },
        noticeIsRead (state, data) {
            let readNotice;
            let {id, read_at} = data;

            state.unread = state.unread.filter(notice => {

                if (notice.id === id) {
                    readNotice = notice;
                    readNotice.read_at = read_at;

                    return false;
                }

                return true;

            });

            state.read = [readNotice].concat(state.read);
        },
        noticeNew (state, notice) {
            state.unread = [notice].concat(state.unread);
        }
    },
    actions: {
        setNotices ({commit}, notices) {
            setTimeout(()=> {
                try {
                    notices = JSON.parse(notices);
                } catch (e) {
                    return console.error('Error parse notices', e);
                }

                if (!Array.isArray(notices) || !notices.length) {
                    return false;
                }

                let read   = [];
                let unread = [];

                notices.map(
                    notice => (notice.read_at ? read : unread ).push(
                        window.notifyTools.getNoticeForStore(notice)
                    )
                );

                commit('setNotices', {notices :read,   type : 'read'});
                commit('setNotices', {notices :unread, type : 'unread'});
            })
        }
    }
}
