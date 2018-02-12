<template>
    <div class="box box-toggle">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button
                        @click="clickToggleShow"
                        type="button" class="btn btn-primary btn-sm pull-right" >
                    <i :class="'fa ' + (isClosed ? 'fa-plus' : 'fa-minus' )"></i>
                </button>
            </div>
            <h3 class="box-title">{{title}}</h3>
        </div>

        <div class="box-body">
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default {
        props : {
            title : {
                type : String,
                default : ''
            },
            value  : {
                type : Boolean,
                default : true
            }
        },

        data : function () {
            return {
                isClosed : true
            }
        },
        
        methods : {
            clickToggleShow : function ($ev) {
                this.isClosed = !this.isClosed;
                
                $($ev.target)
                    .closest('.box-toggle')
                    .find('.box-body')
                    .slideToggle();

                this.$emit('input', this.isClosed);
            }
        },

        created : function () {
            this.isClosed = this.value;
        },
        
        mounted : function () {
            let $el = $(this.$el);

            if (!$el.find('.fa-plus').length) {
                return false;
            }

            $el.find('.box-body').hide();
        } 
    }
</script>
