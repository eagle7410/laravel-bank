<template>
    <div>
        <simple_record
                :title="title"
                :api="api"
                :route-back="routeBack"
        ></simple_record>
    </div>
</template>
<script>
    import {routesEmployee as routes} from '../../const'

    export default {
        data : function () {
            return {
                title  : 'Deposits status',
            }
        },

        computed : {
            api : () => window.apis.status,
            routeBack : () => routes.depStatuses
        }
    }
</script>
