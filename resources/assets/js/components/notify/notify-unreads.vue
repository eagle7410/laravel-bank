<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <server_error_view :serverErrors="errors"></server_error_view>
            <grid :data="unreadNotify" :columns="gridColumns"
            ></grid>
        </div>
    </div>

</template>
<script>
    import {notifyUnreadGrid} from '../../const';
    let that;

    export default {
        computed : {
            _storeNotify : () => that.$store.state.notices,
            unreadNotify : () => that._storeNotify.unread,
            errors : () => that._storeNotify.serverErrors,
            gridColumns  : () => notifyUnreadGrid
        },

        data: function () {
            return {
                title: 'Notices unread'
            }
        },

        created: function () {
            that = this;

            that.$root.title = that.title;
        }
    }
</script>
