const includes = {
    header_main              : 'headerMain',
    left_column              : 'left-column/left-column',
    left_menu                : 'left-column/left-menu',
    footer_main              : 'footerMain',
    content_header           : 'contentHeader',
    hamburger_button         : 'hamburgerButton',
    logo                     : 'logo',
    notifications            : 'notification-tools/notifications',
    messages                 : 'notification-tools/messages',
    task                     : 'notification-tools/task',
    settings_slidebar        : 'settingsSlidebar',
    breadcrumb               : 'breadcrumb',
    my_deposits_status_label : 'status-label',
    my_deposits_actions      : 'deposits/actions',
};

let components = {};

for (let name in includes)
    components[name] = require(`../components/${includes[name]}.vue`);

export default components;
