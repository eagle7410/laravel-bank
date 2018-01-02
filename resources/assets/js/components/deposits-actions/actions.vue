<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="!actions.length">
                    <td colspan="5">You don't have deposits actions</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-->
    </div>
</template>
<script>
    let that;

    export default {
        data : function () {
            return {
                title : 'Deposits actions',
                actions : []
            }
        },

        computed : {

        },

        created: function () {
            that = this;
            that.$root.title = that.title
        }
    }
</script>

