<template>
    <section class="content-header">
        <h1 v-html="title"></h1>
        <breadcrumb></breadcrumb>
    </section>
</template>
<script>
    let that;

    export default {
        computed : {
            title : () => that.$root.title
        },
        created : function () {
            that = this;
        }
    }
</script>
