<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}</h3>
        </div>
        <div class="box-body">
            Statistics
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    let that;

    export default {
        data : function () {
            return {
                title : 'Dashboard'
            };
        },
        created : function () {
            that = this;

            that.$root.title = that.title;
        }
    }
</script>
