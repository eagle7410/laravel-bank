<template>
    <div v-if="!isClosed" class="box block-send">
        <textarea name="message" placeholder="Message ..." class="form-control"></textarea>
        <button type="button" class="btn btn-warning btn-flat" style="width:100%">
            <i class="fa fa-comments"></i>
            Send
        </button>
    </div>
</template>
<script>
    export default {
        props : {
            isClosed : {
                type : Boolean,
                required : true
            }
        }

    }
</script>
