import {depositHistoryActions} from '../../../const'

export default {
    "25": {
        "number": 25,
        "status": 1,
        "sum": 125,
        "history": [
            {
                "action": depositHistoryActions.create,
                "sum_before": 0,
                "sum_after": 100,
                "date_action": "2017/11/1",
                "comment" : "",
            },
            {
                "action": "income",
                "sum_before": 100,
                "sum_after": 125,
                "date_action": "2017/12/1",
                "comment" : "",
            }
        ]
    },
    "26": {
        "number": 26,
        "status": 2,
        "sum": 125,
        "history": [
            {
                "action": depositHistoryActions.create,
                "sum_before": 0,
                "sum_after": 100,
                "date_action": "2017/09/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.income,
                "sum_before": 100,
                "sum_after": 125,
                "date_action": "2017/10/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.income,
                "sum_before": 125,
                "sum_after": 150,
                "date_action": "2017/11/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.income,
                "sum_before": 150,
                "sum_after": 175,
                "date_action": "2017/11/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.income,
                "sum_before": 175,
                "sum_after": 200,
                "date_action": "2017/12/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.verification,
                "sum_before": 200,
                "sum_after": 200,
                "date_action": "2017/12/2",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.stopped,
                "sum_before": 200,
                "sum_after": 200,
                "date_action": "2017/12/3",
                "comment" : "",
            }
        ]
    },
    "27": {
        "number": 27,
        "status": 3,
        "sum": 125,
        "history": [
            {
                "action": depositHistoryActions.create,
                "sum_before": 0,
                "sum_after": 200,
                "date_action": "2017/12/1",
                "comment" : "",
            },
            {
                "action": depositHistoryActions.verification,
                "sum_before": 0,
                "sum_after": 200,
                "date_action": "2017/12/2",
                "comment" : "",
            },
        ]
    }
};

