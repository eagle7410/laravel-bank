<template>
    <div class="box">
        <simple_data_table
                :data="statuses"
                :title="title"
                message-empty="You don't have deposits statuses"
                :route-edit="routeEdit"
                :route-create="routeCreate"
        ></simple_data_table>
        <!-- /.box-->
    </div>
</template>
<script>
    import {routesEmployee as routes} from '../../const'
    let that;

    export default {
        data : function () {
            return {
                title : 'Deposits statuses',
                routeEdit : routes.depStatusEdit,
                routeCreate : routes.depStatusCreate,
            }
        },

        computed : {
            api            : () => window.apis.statuses,
            _storeStatuses : () => that.$store.state.statuses,
            statuses       : () => that._storeStatuses.items,
            isInit         : () => that._storeStatuses.isInit,
        },

        created: function () {
            that = this;
            that.$root.title = that.title;

            if (!that.isInit) {
                that.api.get()
                    .then(statuses => that.$store.commit('setStatuses', statuses || []))
                    .catch(err => console.error('Error get statuses', err))
            }

            window.Echo.addHandles('depositStatusesComp', [
                {
                    chanel : 'deposit-statuses',
                    event  : 'DepositStatusCreateEvent',
                    handle : res => that.$store.commit('addStatus', res.data)
                },
                {
                    chanel : 'deposit-statuses',
                    event  : 'DepositStatusUpdateEvent',
                    handle : res => that.$store.commit('updateStatus', res.data)
                },
            ]);
        }
    }
</script>

