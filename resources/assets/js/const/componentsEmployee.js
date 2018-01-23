import components from './components';

const includes = {
    my_deposits_status_label : 'status-label',
    simple_data_table        : 'common/simple-data-table',
    simple_record            : 'common/simple-record',
    grid                     : 'common/grid',
};

for (let name in includes)
    components[name] = require(`../components/${includes[name]}.vue`);

export default components;
