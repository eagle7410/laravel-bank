<template>
    <div :class="cssClass">
        <label
                v-if="label && label.length"
                :for="name">{{label}}</label>
        <datepicker
                calendar-button-icon="fa fa-calendar"
                :id="name"
                :format="format"
                :bootstrap-styling="true"
                :calendar-button="true"
                :monday-first="true"
                :value="value"
                @input="onInput"
        ></datepicker>

        <small class="form-text text-muted" v-if="help && help.length">{{help}}</small>
    </div>
</template>
<script>
    import Datepicker from 'vuejs-datepicker';
    let that;

    export default {
        props : {
            name : {
                type: String,
                required : true,
            },
            value : {
                type: String|Object,
            },
            err : {
                default : null
            },
            label : {
                type: String,
                default : ''
            },
            format : {
                type : String,
                default : 'dd-MM-yyyy'
            },
            help : {
                type: String
            },
        },

        computed : {
            cssClass : () => {
                let css = 'form-group';

                if (that.err) {
                    css += ' has-error';
                }

                return css;
            }
        },

        methods : {
            onInput : date => that.$emit('input', date)
        },

        components: {
            Datepicker
        },

        created : function () {
            that = this;
        }
    }
</script>
<style scoped>
    .has-error > .text-muted {
        color: #dd4b39
    }
</style>
