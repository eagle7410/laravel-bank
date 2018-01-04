<template>
    <div v-if="!isEmpty" class="alert alert-error">
        <div v-for="prop in arProps">
            <b>Error for {{prop}}</b>
            <div v-for="err in serverErrors[prop]">{{err}}</div>
        </div>
    </div>
</template>
<script>
    export default {
        props :{
            serverErrors : Object
        },
        computed : {
            arProps : function () {
                return Object.keys(this.serverErrors);
            },
            isEmpty : function () {
                return !Boolean(this.arProps.length);
            }
        }
    }
</script>
