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
                <span class="pull-right-container"
                      v-if="item.subs"
                >
                    <i class="fa fa-angle-left pull-right"></i>
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

        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements
                        <span class="pull-right-container">
                            <small class="label bg-green">Hot</small>
                            <small class="label bg-red">3</small>
                            <small class="label bg-blue">17</small>
                        </span>
                    </a>
                </li>
                <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
            </ul>
        </li>
        <li>
            <a href="../calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-red">3</small>
                  <small class="label pull-right bg-blue">17</small>
                </span>
            </a>
        </li>
        <li>
            <a href="../mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <span class="pull-right-container">
          <small class="label pull-right bg-yellow">12</small>
          <small class="label pull-right bg-green">16</small>
          <small class="label pull-right bg-red">5</small>
        </span>
            </a>
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
