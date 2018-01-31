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
            api          : () => window.apis.users,
            _storeUsers  : () => that.$store.state.users,
            users        : () => that._storeUsers.users.sort((prev, next) => next.id - prev.id),
            isEmptyUsers : () => !that._storeUsers.users.length
        },

        data: function () {
            return {
                title: 'Users',
                dateFormat : 'd-m-y h:i',
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

            if (that.isEmptyUsers) {
                that.api.get()
                    .then(users => that.$store.commit('setUsers', users || []))
                    .catch(err => console.error('Error get users', err));
            }

            window.Echo.addHandles('userComp', [
                {
                    chanel : 'users',
                    event  : 'UserCreateEvent',
                    handle : res => that.$store.commit('addUser', res.data)
                }
            ]);

        }
    }
</script>
