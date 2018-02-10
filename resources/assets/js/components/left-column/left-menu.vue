<style scoped>
    .treeview > li > a.active,
    li.menu-open > ul.treeview-menu
    {
        background: #1e282c !important;
    }
    a.active {
        color: #ffffff !important;
    }
</style>

<template>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview"
            v-for="item in items"
        >
            <router-link :to="getMainRoute(item)" exact>
                <i v-if="item.iconClass" :class="item.iconClass"></i>
                <span>{{item.label}}</span>
                <span
                    v-if="item.labels || item.subs"
                    class="pull-right-container"
                >
                        <i v-if="item.subs && item.subs.length"
                           class="fa fa-angle-left pull-right"></i>

                        <small
                                v-for="label in item.labels"
                                v-if="item.labels && item.labels.length && label.text"
                               :class="`label ${label.class}`"
                        >
                            {{label.text}}
                        </small>
                </span>
            </router-link>
            <ul class="treeview-menu"
                v-if="item.subs && item.subs.length"
            >
                <li v-for="sub in item.subs" >
                    <router-link :to="sub.route" exact>
                        <i v-if="sub.iconClass" :class="sub.iconClass"></i>
                        {{sub.label}}
                    </router-link>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    import {routes} from '../../const';
    let that;

    export default {
        computed : {
            _storeNotify : function() { return this.$store.state.notices },
        },

        data : function() {
            return {
                items : []
            }
        },

        methods : {
            getMainRoute : item => item.subs && item.subs.length ? {} : item.route,
        },

        watch : {
            '_storeNotify.unread.length' : {
                handler : (after) => {
                    let notice = that.items.find(item => item.label === 'Notices');
                    notice.labels[0].text = after;
                }
            }
        },

        created : function () {
            that = this;

            that.items = (that.$root.leftMenu || []).map(item => {

                if (!item.route) {
                    item.route = routes.def;
                }

                if (item.subs) {
                    item.subs = item.subs.map(sub => {
                        if (!sub.route) {
                            sub.route = routes.def;
                        }

                        return sub;
                    })
                }

                return item;
            });
        }
    }

</script>
