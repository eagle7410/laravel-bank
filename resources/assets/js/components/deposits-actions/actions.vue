<template>
    <div class="box">
        <simple_data_table
                :data="actions"
                :title="title"
                message-empty="You don't have deposits actions"
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
                title : 'Deposits actions',
                routeEdit : routes.depActionEdit,
                routeCreate : routes.depActionCreate,
            }
        },

        computed : {
            api           : () => window.apis.actions,
            _storeActions : () => that.$store.state.actions,
            isInit        : () => that._storeActions.isInit,
            actions       : () => that._storeActions.items,
        },

        created: function () {
            that = this;
            that.$root.title = that.title;

            if (!that.isInit) {
                that.api.get()
                    .then(actions => that.$store.commit('setActions', actions || []))
                    .catch(err => console.error('Error get actions', err))
            }

            window.Echo.addHandles('depositActionsComp', [
                {
                    chanel : 'deposit-actions',
                    event  : 'DepositActionCreateEvent',
                    handle : res => that.$store.commit('addAction', res.data)
                },
                {
                    chanel : 'deposit-actions',
                    event  : 'DepositActionUpdateEvent',
                    handle : res => that.$store.commit('updateAction', res.data)
                },
            ]);
        }
    }
</script>

