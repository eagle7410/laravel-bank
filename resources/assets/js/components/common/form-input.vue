<template>
    <div :class="cssClass">
        <label
                v-if="label && label.length"
                :for="name">{{label}}</label>
        <input  class="form-control"
               :id="name" aria-describedby="emailHelp"
               :type="type"
               :placeholder="placeholder"
               @input="onInput"
        >
        <small class="form-text text-muted" v-if="help && help.length">{{help}}</small>
    </div>
</template>

<script>
    let that;

    export default {
        props : {
            name : {
                type: String,
                required : true,
            },
            err : {
                defailt : null
            },
            label : {
                type: String,
                default : ''
            },
            placeholder : {
                type: String,
                default : 'Enter'
            },
            help : {
                type: String
            },
            type : {
                type : String,
                default : 'text'
            }
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
            onInput : $ev => that.$emit('input', $ev.target.value)
        },

        created: function () {
            that = this;
        },
    }
</script>
<style scoped>
    .has-error > .text-muted {
        color: #dd4b39
    }
</style>
