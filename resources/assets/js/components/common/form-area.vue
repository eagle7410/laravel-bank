<template>
    <div :class="cssClass">
        <label
                v-if="label && label.length"
                :for="name">{{label}}</label>
        <textarea  class="form-control"
               :id="name" aria-describedby="emailHelp"
               :type="type"
               :placeholder="placeholder"
               :value="value"
                @input="onInput"

        >
        </textarea>
        <small class="form-text text-muted" v-if="help && help.length">{{help}}</small>
    </div>
</template>

<script>
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
            },
            value : null,
        },

        computed : {
            cssClass : function() {
                let css = 'form-group';

                if (this.err) {
                    css += ' has-error';
                }

                return css;
            }
        },

        methods : {
            onInput : function($ev) {
                this.$emit('input', $ev.target.value);
            }
        },
    }
</script>
<style scoped>
    .has-error > .text-muted {
        color: #dd4b39
    }
</style>
