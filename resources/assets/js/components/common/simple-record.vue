<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <form>
                    <div class="alert alert-error"
                         v-if="Object.keys(serverErrors).length"
                         v-for="prop in Object.keys(serverErrors)"
                    >
                        <b>Error for {{prop}}</b>
                        <div v-for="err in serverErrors[prop]">{{err}}</div>
                    </div>
                    <div :class="cssProp('alias')">
                        <label for="alias">Alias</label>
                        <input type="text" class="form-control" id="alias" aria-describedby="emailHelp" placeholder="Enter alias"
                              v-model="alias"
                        >
                        <small class="form-text text-muted">Alias is required</small>
                    </div>
                    <div :class="cssProp('name')">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name"
                               v-model="name"
                        >
                        <small class="form-text text-muted">Name is required</small>
                    </div>

                    <div :class="cssProp('desc')">
                        <label for="desc">Description</label>
                        <textarea type="text" class="form-control" id="desc" placeholder="Description"
                                  v-model="desc"
                        ></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"
                            @click.prevent="clickSubmit"
                    >{{action}}</button>
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
        props : {
            api : {
                type : Object,
                required : true,
            },
            routeBack : {
                type : Object,
                required : true,
            },
            title : {
                type : String,
                required : true,
            }
        },

        created: function () {
            that = this;

            if (that.$route && that.$route.params.id) {
                that.id = that.$route.params.id;
                that.action += 'edit';

                that.api.get(that.id)
                    .then(data => {
                        that.alias = data.alias;
                        that.name = data.name;
                        that.desc = data.desc;
                    })
                    .catch(that._handelError);
            } else {
                that.action += 'create';
            }

            that.$root.title = that.title + ' ' + that.action;
        },

        data: function () {
            return {
                action : '',
                id     : null,
                alias  : '',
                name   : '',
                desc   : '',
                errors : {
                    alias : null,
                    name  : null,
                },
                serverErrors : {}
            };
        },

        computed : {
            result : () => {
                return {
                    alias : that.alias,
                    name  : that.name,
                    desc  : that.desc,
                };
            }
        },

        methods : {

            _validate : data => {
                let errors = that.errors;
                let isHasError = false;

                for (let prop in errors) {

                    if (!that[prop]) {
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
            _handelError : err => {
                console.error('Error save result simple record', err);

                const responseJSON = err.responseJSON;

                if (responseJSON.errors) {
                    that.serverErrors = responseJSON.errors
                }
            },
            clickSubmit : () => {
                let data = that.result;
                that.serverErrors = {};

                if (!that._validate(data)) {
                    return false;
                }


                if (that.id) {
                    data.id = that.id;
                    that.api.update(data)
                        .then(that.clickBack)
                        .catch(that._handelError);
                } else {
                    that.api.save(data)
                        .then(that.clickBack)
                        .catch(that._handelError);
                }
            },
            clickBack : () => {
                if (that.$router) {
                    that.$router.push(that.routeBack);
                }
            },
        }
    }
</script>
<style scoped>
    .has-error > .text-muted {
        color: #dd4b39
    }
</style>

