<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <form>
                    <server_error_view :serverErrors="serverErrors"></server_error_view>

                    <div :class="cssProp('name')">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Enter login"
                               v-model="name"
                        >
                        <small class="form-text text-muted">Login is required</small>
                    </div>
                    <div :class="cssProp('email')">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"
                               v-model="email"
                        >
                        <small class="form-text text-muted">Email is required</small>
                    </div>
                    <div :class="cssProp('password')">
                        <label for="pass">Password</label>
                        <input type="text" class="form-control" id="pass" placeholder="Password"
                               v-model="password"
                        >
                        <small class="form-text text-muted">Password is required</small>
                    </div>
                    <div :class="cssProp('role')">
                        <label for="role">Role</label>
                        <select type="text" class="form-control" id="role" placeholder="Roles"
                                v-model="role"
                        >
                            <option :value="''">--Select role--</option>
                            <option v-for="role in roles" :value="role.name">{{role.name}}</option>
                        </select>
                        <small class="form-text text-muted">Role is required</small>
                    </div>

                    <button type="submit" class="btn btn-primary"
                            @click.prevent="clickCreate"
                    >Create</button>
                    <button type="submit" class="btn btn-warning"
                            @click.prevent="clickBack"
                    >Back</button>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</template>
<script>
    let that;
    import {routesEmployee as routes} from '../../const'

    export default {

        computed : {
            apis     : () => window.apis,
            apiRoles : () => that.apis.roles,
            apiUser  : () => that.apis.user,
            result   : () => {
                return {
                    name      : that.name,
                    email     : that.email,
                    role      : that.role,
                    password  : that.password,
                };
            },

        },

        data: function () {
            return {
                title    : 'Adding user',
                name     : '',
                email    : '',
                password : '',
                role     : '',
                roles    : [],
                errors   : {
                    name      : null,
                    email     : null,
                    role      : null,
                    password  : null,
                },
                serverErrors : {},
            };
        },

        methods : {
            _validate : data => {
                let errors = that.errors;
                let isHasError = false;

                for (let prop in errors) {

                    if (!data[prop]) {
                        isHasError = true;
                        errors[prop] = isHasError;
                    } else {
                        errors[prop] = null;
                    }
                }

                return !isHasError;
            },
            cssProp : prop => {
                let css = 'form-group';

                if (that.errors[prop]) {
                    css += ' has-error';
                }

                return css;
            },
            clickCreate : () => {
                let data = that.result;

                if (!that._validate(data)) {
                    return false;
                }

                that.apiUser.save(data)
                    .then(() => that.redirectToUsers())
                    .catch(that._handelError);
            },
            clickBack : () => that.redirectToUsers(),
            redirectToUsers : () => {
                if (that.$router) {
                    that.$router.push(routes.usrs);
                }
            },
            _handelError : err => {
                console.error('Error ', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
        },

        created: function () {
            that = this;

            that.$root.title = 'New user';

            that.apiRoles.get()
                .then(roles => that.roles = roles || [])
                .catch(that._handelError)

        }
    }
</script>
<style scoped>
    .has-error > .text-muted {
        color: #dd4b39
    }
</style>
