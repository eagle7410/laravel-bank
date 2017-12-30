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
            <router-link :to="item.route" exact>
                <i v-if="item.iconClass" :class="item.iconClass"></i>
                <span>{{item.label}}</span>
                <span
                    v-if="item.labels && item.labels.length"
                    class="pull-right-container">
                        <small v-for="label in item.labels"
                               :class="'label ' + label.class">
                            {{label.text}}
                        </small>
                </span>
                <span class="pull-right-container"
                      v-if="item.subs"
                >
                    <i v-if="item.subs && item.subs.length"
                       class="fa fa-angle-left pull-right"></i>
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
    import {routes, leftMenuList} from '../../const';
    let that;

    export default {
        data : function() {
            return {
                items : []
            }
        },
        created : function () {
            that = this;

            that.items = leftMenuList.map(item => {
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
