const noop = function () {};
export default {
    state: {
        isShow     : false,
        title      : false,
        btnClose   : 'Close',
        btnSave    : 'Save',
        btnSaveCss : 'btn btn-primary',
        bodyComp   : null,
        bodyHtml   : '',
        callSave   : noop,
        callCancel : noop,
    },
    mutations: {
        setModalData(state, data) {
            for (let p in data) {
                if (state.hasOwnProperty(p)) {
                    state[p] = data[p];
                }
            }

        },
        modalCancel(state) {
            state.isShow = false;
            state.callCancel();
        },
        modalSave(state) {
            state.isShow = false;
            state.callSave();
        },
        modalOpen(state, data) {
            for (let p in data) {
                if (state.hasOwnProperty(p)) {
                    state[p] = data[p];
                }
            }

            state.isShow = true;
        }
    }
}
