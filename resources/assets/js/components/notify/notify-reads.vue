<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <grid :data="readNotify" :columns="gridColumns"
            ></grid>
        </div>
    </div>

</template>
<script>
    import {notifyReadGrid} from '../../const';
    let that;

    export default {
        computed : {
            _storeNotify : () => that.$store.state.notices,
            readNotify   : () => that._storeNotify.read,
            gridColumns  : () => notifyReadGrid
        },

        data: function () {
            return {
                title: 'Notices read'
            }
        },

        created: function () {
            that = this;

            that.$root.title = that.title;
        }
    }
</script>
