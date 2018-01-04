<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="tools">
                <button class="btn btn-success" @click="clickNew">Create</button>
            </div>
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
                <tr v-if="!data.length">
                    <td colspan="5">{{messageEmpty}}</td>
                </tr>
                <tr v-else
                    v-for="(item, index) in data"
                >
                    <td>{{index + 1}}</td>
                    <td>
                        <a class="action" @click.prevent="clickEdit(item.id)" >
                            <i class="fa fa-pencil" aria-hidden="true" title="edit"></i>
                        </a>
                    </td>
                    <td>{{item.alias}}</td>
                    <td>{{item.name}}</td>
                    <td>
                        <textarea readonly v-if="item.desc" v-text="item.desc"></textarea>
                    </td>
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
        props : {
            title : {
                type : String,
                default : ''
            },
            data : {
                type : Array,
                default : []
            },
            messageEmpty : {
                type : String,
                default : ''
            },
            routeEdit : {
                type : Object,
                default : {path : '/'}
            },
            routeCreate : {
                type : Object,
                default : {path : '/'}
            },
        },

        methods : {
            clickEdit : (id) => {
                if (that.$router) {
                    that.$router.push({path : that.routeEdit.path.replace(':id', id) });
                }
            },
            clickNew : () => {
                if (that.$router) {
                    that.$router.push(that.routeCreate);
                }
            }
        },

        created: function () {
            that = this;
        }
    }
</script>

<style scoped>
    .action {
        padding: 0 5px;
    }
    .action:hover {
        color: red;
    }
    textarea {
        border: none;
    }
</style>
