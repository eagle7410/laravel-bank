<template>
    <li class="dropdown tasks-menu">
        <a href="#" @clicl.prevend="" v-if="isLoad">
            <i class="fa fa-spinner fa-pulse"></i>
        </a>

        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
           v-if="isShow"
        >
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">{{ticketsAll.length}}</span>
        </a>
        <ul class="dropdown-menu" v-if="!isEmpty" >
            <li class="header">You have {{ ticketsAll.length + ' ' + ( isClient ? 'answers' : 'question' ) }} in tasks</li>
            <li>
                <ul class="menu">
                    <li v-for="ticket in ticketsShow">
                        <router-link :to="{path : `/ticket/${ticket.id}/dialog`}">
                            <i class="fa fa-ticket red"></i>
                            {{ticket.title}}
                        </router-link>
                    </li>
                    <li v-if="ticketsAll.length > 3">
                        <router-link :to="routeOpened">...</router-link>
                    </li>
                </ul>
            </li>
            <li class="footer">
                <router-link :to="routeOpened">View all opened tasks</router-link>
            </li>
        </ul>
    </li>
</template>
<script>
    import {routesEmployee as routes} from '../../const'

    let that;

    export default {
        computed : {
            isShow         : () => !that.isLoad && !that.isEmpty,
            apiTickets     : () => window.apis.tickets,
            _storeTickets  : () => that.$store.state.tickets,
            isClient       : () => that.$root.isClient,
            ticketsAll     : () => that._storeTickets[that.isClient  ? 'wait_question' : 'wait_answer' ],
            ticketsShow    : () => that.ticketsAll.slice(0,3),
            isEmpty        : () => !that.ticketsAll.length
        },

        data : function () {
            return {
                isLoad      : true,
                routeOpened : routes.ticketsOpen
            }
        },

        created : function () {
            that = this;

            that.apiTickets.getAll()
                .then(tickets => {
                    that.isLoad = false;
                    that.$store.dispatch('setTickets', tickets);
                    window.Echo.addHandles('tickets', window.listenTickets);
                })
                .catch(err => {
                    that.isLoad = false;
                    console.error('Error get open tickets', err);
                })
        }
    }
</script>
