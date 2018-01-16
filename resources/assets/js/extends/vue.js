import Vue from 'vue';

// Create bus.
const bus = new Vue({});

Vue.mixin({
    computed : {
        emitter : () => bus,
    },
    methods : {
        listen : function(event, handler) {
            let emitter = this.emitter;
            emitter.$off(event);
            emitter.$on(event, handler);
        },
        listeners : function(objectHandlers) {
            Object.keys(objectHandlers).map(event => this.listen(event, objectHandlers[event]) );
        },
        $fire : function (event, data) {
            this.emitter.$emit(event, data);
        }
    },
});
