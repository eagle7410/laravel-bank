import Actions from '../components/common/deposits-actions';

export default [
    {label : 'Action', comp: Actions},
    {label : 'Status', comp: 'my_deposits_status_label'},
    'number',
    {
        label : 'Sum, $',
        alias : 'sum'
    },
    {
        label : 'Percent, %',
        alias : 'percent'
    },
    {
        label : 'Date start',
        alias : 'start'
    },
    {
        label : 'Date next income',
        alias : 'income'
    },
];
