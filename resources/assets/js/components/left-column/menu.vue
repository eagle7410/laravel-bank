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
            <link-with-subs v-if="item.subs && item.subs.length" :item="item"></link-with-subs>
            <link-without-subs v-else :item="item"></link-without-subs>

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
    import LinkWithSubs from './menu-link-with-subs.vue'
    import LinkWithoutSubs from './menu-link-without-subs.vue'

    let that;

    export default {
        components : {
            LinkWithSubs,
            LinkWithoutSubs
        },

        computed : {
            _storeNotify : function() { return this.$store.state.notices },
            _storeTickets : function() { return this.$store.state.tickets },
            _storeTicketsAnswer : function() { return this._storeTickets.wait_answer },
            _storeTicketsQuestion : function() { return this._storeTickets.wait_question },
        },

        data : function() {
            return {
                items : []
            }
        },

        watch : {
            '_storeNotify.unread.length' : {
                handler : (after) => {
                    let notice = that.items.find(item => item.label === 'Notices');
                    notice.labels[0].text = after;
                }
            },

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

            that.$store.watch(state => {
                return state.tickets[that.$root.isClient ?  'wait_question' : 'wait_answer'].length;
            }, after => {
                let notice = that.items.find(item => item.label === 'Tickets');
                notice.labels[0].text = after;
            });

        }
    }

</script>
<style scoped>
    a.exact {
        background: #3097D1 !important;
    }

</style>
