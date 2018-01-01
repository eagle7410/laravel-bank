<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="tools">
                <button class="btn btn-success" @click="clickNewUser">New user</button>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Login</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(user, index) in users">
                    <th scope="row">{{index + 1}}</th>
                    <td>
                       Actions
                    </td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.created_at.toDateFormat(dateFormat)}}</td>
                    <td>{{user.updated_at.toDateFormat(dateFormat)}}</td>
                </tr>
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
</template>

<script>
    import {routesEmployee as routes} from '../../const'

    let that;

    export default {

        computed : {
            api     : () => window.apis.users,
        },

        data: function () {
            return {
                title: 'Users',
                dateFormat : 'd-m-y h:i',
                users : [],
            };
        },

        methods : {
            clickNewUser : () => {
                if (that.$router) {
                    that.$router.push(routes.new_usr);
                }
            }
        },

        created: function () {
            that = this;

            that.$root.title = that.title;

            that.api.get()
                .then(users => that.users = users || [])
                .catch(err => console.error('Error get users', err))

        }
    }
</script>
