<template>
    <b :class="cssFullClass">{{label}}</b>
</template>
<script>
    import {depositsStatus} from '../const'
    let that;

    export default {
        props : {
            status: {
                required : true
            }
        },

        computed : {
            statusesValues : () => Object.values(that.depositsStatus),
            cssFullClass: () => `alert bg-${that.cssClass}`
        },

        data : function() {
            return {
                statuses : depositsStatus,
                cssClass : '',
                label : ''
            };

        },

        created: function () {
            that = this;
            let statuses = that.statuses;

            if (Object.values(statuses).indexOf(that.status) === -1) {
                console.error('Bad deposit satus', that.status);
            }

            switch (that.status) {
                case statuses.active :
                    that.cssClass = 'green';
                    that.label = 'Active';
                    break;
                case statuses.stopped :
                    that.cssClass = 'red';
                    that.label = 'Stopped';
                    break;
                case statuses.verification :
                    that.cssClass = 'yellow';
                    that.label = 'On verification';
                    break;
            }
        }
    }
</script>
