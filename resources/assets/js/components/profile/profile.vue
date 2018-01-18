<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <profile-form
                    :def-data="defData"
            ></profile-form>
            <div class="col-md-5">
                <gravatar :email="userEmail" alt="User Image" class="image"></gravatar>
                <div class="avatar-desc">
                    For change avatar use service <a href="https://ru.gravatar.com/">Gravatar</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Gravatar from 'vue-gravatar';
    import ProfileForm from './profile-form.vue';

    let that;

    export default {
        components : {
            Gravatar,
            ProfileForm
        },
        computed : {
            title : () =>`Profile: ${that.userName} ${that.userSurname} (${that.userEmail})`,
            defData : () => ({
                nameFirst : that.userName,
                nameLast  : that.userSurname,
            })
        },

        methods : {
            safeSetFromRoot : prop => {
                that[prop] = that.$root[prop] || '';
            }
        },

        created: function () {
            that = this;

            that.$root.title = 'Profile';

            [
                'userName',
                'userSurname',
                'userEmail',
            ].map(prop => that.safeSetFromRoot(prop));
        }
    }
</script>

<style scoped>
    .avatar-desc {
        font-size: 80%;
    }
    .image {
        width: 100%;
        max-width: 100px;
        height: auto;
        left: 25px
    }
</style>
