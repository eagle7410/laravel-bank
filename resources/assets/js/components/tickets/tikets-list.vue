<template>
    <ul class="todo-list ui-sortable"
    >
        <li v-if="!tickets.length">
            <p><h4>No tickets <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></h4></p>
        </li>
        <li v-else v-for="ticket in tickets">
            <router-link :to="{ path: `ticket/${ticket.id}/dialog`}">
                <h4>
                    <small v-if="ticket.closed_at"><i class="fa fa-clock-o"></i> Date closed {{ticket.closed_at.toDateFormat('d-m-y h:i')}}</small>
                    <small v-else><i class="fa fa-clock-o"></i> Date created {{ticket.created_at.toDateFormat('d-m-y h:i')}}</small>
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
