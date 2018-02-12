<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{title}}.</h3>
        </div>
        <div class="box-body">
            <profile-form></profile-form>
            <div class="col-md-5">
                <gravatar :email="email" alt="User Image" class="image"></gravatar>
                <div class="avatar-desc">
                    For change avatar use service <a href="https://en.gravatar.com/">Gravatar</a>
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
            _storeProfile: () =>  that.$store.state.profile,
            name    : () => that._storeProfile.name,
            surname : () => that._storeProfile.surname,
            email   : () => that._storeProfile.email,
            title   : () =>`Profile: ${that.name} ${that.surname} (${that.email})`,
        },

        created: function () {
            that = this;
            that.$root.title = 'Profile';
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
