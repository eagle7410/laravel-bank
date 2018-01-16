import Actions from '../components/deposits/actions';

export default [
    {label : 'Action', comp: Actions},
    {label : 'Status', comp: 'my_deposits_status_label'},
    'number',
    'email',
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
    {
        label : 'Date updated',
        alias : 'updated'
    },
    {
        label : 'Date created',
        alias : 'created'
    },
];
