<template>
    <div class="row">
        <div :class="'direct-chat-msg col-lg-6 ' + (message.is_support ? 'col-lg-offset-6 right' : '' )">
            <div class="direct-chat-info clearfix">
                <span :class="'direct-chat-name ' + (message.is_support ? 'pull-right' : 'pull-left' ) ">
                    {{ message.name }}
                </span>
                <span :class="'direct-chat-timestamp '  + (message.is_support ? 'pull-left' : 'pull-right' )">
                    {{message.created_at.toDateFormat('d-m-y h:i')}}
                </span>
            </div>
            <img class="direct-chat-img" :src="message.avatar" alt="User Image">
            <div class="direct-chat-text" v-html="message.text.replace(/\n/g, '<br/>')"></div>
        </div>
    </div>
</template>
<script>
    export default {
        props : {
            message : {
                type : Object,
                required : true
            }
        }
    }
</script>
