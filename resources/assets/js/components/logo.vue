<template>
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ name }}</span>
    </a>
</template>
<script>
    export default {
        props : {
            name: String
        }
    }
</script>
