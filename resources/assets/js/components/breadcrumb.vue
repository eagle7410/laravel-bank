<template>
    <ol class="breadcrumb" >
        <li
                v-for="(breadcrumb, inx) in breadcrumbs"
                :class="inx === breadcrumbs.length ? 'active' : '' "
        >
            <router-link :to="breadcrumb.route">
                <i v-if="breadcrumb.iconClass" :class="breadcrumb.iconClass"></i>
                {{breadcrumb.label}}
            </router-link>
        </li>
    </ol>
</template>
<script>
    let that;

    export default {
        computed : {
            _routeMeta : () => that.$route.meta,
            breadcrumbs : () => {
                let breadcrumbs = [];

                if (
                    that._routeMeta &&
                    that._routeMeta.breadcrumbs &&
                    Array.isArray(that._routeMeta.breadcrumbs)
                ) {
                    breadcrumbs = that._routeMeta.breadcrumbs
                }

                return breadcrumbs;
            }
        },
        created : function () {
            that = this;
        }
    }
</script>
