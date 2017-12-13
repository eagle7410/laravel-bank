<template>
    <header class="main-header">
        <!-- Logo -->
        <logo :name="appName"></logo>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <hamburger_button></hamburger_button>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <messages></messages>
                    <notifications></notifications>
                    <task></task>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img :src="userAvatarSrc" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img :src="userAvatarSrc" class="img-circle" alt="User Image">

                                <p>
                                    {{userName}} {{userSurname}} - Web Developer
                                    <small>Member since Dec. 2017</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a :href="logoutAction"
                                       class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>

                                    <form id="logout-form" :action="logoutAction" method="POST" style="display: none;"
                                    >
                                        <input name="_token" :value="csrfToken">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                    <settings_slidebar></settings_slidebar>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
    let that;
    
    export default {
        computed : {
            appName       : () => that.$root.appName,
            userName      : () => that.$root.userName,
            userSurname   : () => that.$root.userSurname,
            userAvatarSrc : () => that.$root.userAvatarSrc,
            csrfToken     : () => that.$root.csrfToken,
            logoutAction  : () => that.$root.logoutAction,
        },
        created : function () {
            that = this;
            // TODO: IGOR clear
            console.log('avatar ', that.$root);
        }
    }
</script>
