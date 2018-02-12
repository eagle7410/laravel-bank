<template>
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left " >
                    <a href="https://ru.gravatar.com/">
                        <div class="image">
                            <gravatar :email="userEmail" alt="User Image"></gravatar>
                        </div>
                    </a>
                </div>
                <div class="pull-left info">
                    <p>{{userName}} {{userSurname}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <left-menu></left-menu>
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
    import Gravatar from 'vue-gravatar';
    import LeftMenu from './menu.vue';
    let that;

    export default {
        components : {
            Gravatar,
            LeftMenu
        },

        computed : {
            userSurname : () => that.$root.userSurname,
            userName    : () => that.$root.userName,
            userEmail   : () => that.$root.userEmail,
        },
        created : function () {
            that = this;
        }
    }
</script>
<style scope>
    .image > img {
        width: 100%;
        max-width: 45px;
        height: auto;
        border-radius: 50%;
    }
</style>
