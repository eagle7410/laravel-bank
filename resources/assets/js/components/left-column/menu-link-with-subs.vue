<template>
    <a href="" @click.prevend="">
        <i v-if="item.iconClass" :class="item.iconClass"></i>
        <span>{{item.label}}</span>
        <span class="pull-right-container">

            <i class="fa fa-angle-left pull-right"></i>

            <small
                    v-for="label in item.labels"
                    v-if="item.labels && item.labels.length && label.text"
                    :class="`label ${label.class}`"
            >
                {{label.text}}
            </small>
        </span>
    </a>
</template>
<script>
    export default {
        props : ['item']
    }
</script>
