<template>
    <router-link :to="item.route" exact>
        <i v-if="item.iconClass" :class="item.iconClass"></i>
        <span>{{item.label}}</span>
        <span
                v-if="item.labels || item.subs"
                class="pull-right-container"
        >
                    <i v-if="item.subs && item.subs.length" class="fa fa-angle-left pull-right"></i>

                    <small
                            v-for="label in item.labels"
                            v-if="item.labels && item.labels.length && label.text"
                            :class="`label ${label.class}`"
                    >
                        {{label.text}}
                    </small>
                </span>
    </router-link>
</template>
<script>
    export default {
        props : ['item']
    }
</script>
