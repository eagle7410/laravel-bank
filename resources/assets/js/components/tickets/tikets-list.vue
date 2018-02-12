<template>
    <ul class="todo-list ui-sortable"
        v-if="tickets.length"
    >
        <li v-for="ticket in tickets">
            <router-link :to="{ path: `ticket/${ticket.id}/dialog`}">
                <h4>
                    <small v-if="ticket.closed_at"><i class="fa fa-clock-o"></i> Date closed {{ticket.closed_at}}</small>
                    {{ticket.title}}
                </h4>
            </router-link>
        </li>
    </ul>
</template>
<script>
    export default {
        props : {
            tickets : {
                type : Array,
                default : []
            }
        }
    }

</script>
