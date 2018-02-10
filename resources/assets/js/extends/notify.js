const buildMessage = (notice) => {
    let attach = notice.data;

    switch (notice.type) {
        case 'App\\Notifications\\AddIncome':
            return `Dear client to your deposit #${attach.number}, came income ${attach.income} $, by date ${attach.income_at}`;

        default:
            return '';
    }
};

const buildTitle = (notice) => {
    let attach = notice.data;

    switch (notice.type) {
        case 'App\\Notifications\\AddIncome':
            return `Income for deposit #${attach.number}.`;

        default:
            return 'Obscure notice';
    }
};

const getIconClass = (notice) => {

    switch (notice.type) {
        case 'App\\Notifications\\AddIncome':
            return 'fa fa-money text-green';

        default:
            return false;
    }
};

const getNoticeForStore = (notice) => (
    {
        id        : notice.id,
        read_at   : notice.read_at ? notice.read_at.toDateFormat('d-m-y h:i') : null,
        title     : buildTitle(notice),
        message   : buildMessage(notice),
        iconClass : getIconClass(notice)
    }
);

window.notifyTools = {
    buildMessage,
    buildTitle,
    getIconClass,
    getNoticeForStore
};
