<template>
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu"
        v-if="totalUnreadNotify"
    >
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">{{totalUnreadNotify}}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{totalUnreadNotify}} unread notifications</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li v-for="notice in unreadNotify">
                        <a :href=" '#/notices-unread' ">
                            <i v-if="notice.iconClass" :class="notice.iconClass"></i>
                            {{notice.title}}
                        </a>
                    </li>
                    <li v-if="totalUnreadNotify > 3">
                        <a href="#/notices-unread">...</a>
                    </li>
                </ul>
            </li>
            <li class="footer"><a href="#/notices-unread">View all unread</a></li>
        </ul>
    </li>
</template>

<script>
    let that;

    export default {

        computed : {
            _storeNotify      : () => that.$store.state.notices,
            totalUnreadNotify : () => that._storeNotify.unread.length,
            unreadNotify      : () => that._storeNotify.unread.slice(0,3),
        },

        created : function () {
            that = this;
        }
    }
</script>
