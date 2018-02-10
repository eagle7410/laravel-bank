<template>
    <b :class="cssClass(entry && entry.status ? entry.status : status)">{{label(entry && entry.status ? entry.status : status)}}</b>
</template>
<script>
    import {depositsStatus} from '../const'
    let that;

    export default {
        props : {
            action: Number,
            entry: Object
        },

        computed : {
            statusesValues : () => Object.values(that.depositsStatus),
        },
        methods : {
            cssClass : (action) => {
                let statuses = that.statuses;
                let cssClass = `alert bg-`;

                switch (action) {
                    case statuses.active :
                        cssClass += 'green';
                        break;
                    case statuses.stopped :
                        cssClass += 'red';
                        break;
                    case statuses.verification :
                        cssClass += 'yellow';
                        break;
                }

                return cssClass;
            },
            label : (action) => {
                let label = '';
                let statuses = that.statuses;

                switch (action) {
                    case statuses.active :
                        label = 'Active';
                        break;
                    case statuses.stopped :
                        label = 'Stopped';
                        break;
                    case statuses.verification :
                        label = 'On verification';
                        break;
                }

                return label;
            },

        },

        data : function() {
            return {
                statuses : depositsStatus,
            };

        },
        created :function () {
            that = this;
        },
    }
</script>

<style scoped>
    .alert {
        padding: 0.2em 5px;
    }
</style>
