<template>
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img :src="imgSrc" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{userName}} {{userSurname}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <left_menu></left_menu>
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
    let that;

    export default {
        computed : {
            userSurname : () => that.$root.userSurname,
            userName    : () => that.$root.userName,
            imgSrc      : () => that.$root.userAvatarSrc,
        },
        created : function () {
            that = this;
        }
    }
</script>
