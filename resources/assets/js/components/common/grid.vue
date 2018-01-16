<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th v-if="number">#</th>
            <th v-for="key in columns"
                @click="sortBy(getKeyVal(key))"
                :class="{ active: sortKey == getKeyVal(key) }"
                scope="col"
            >
                {{ getKeyLabel(key)| capitalize }}
                <span class="arrow" :class="sortOrders[getKeyVal(key)] > 0 ? 'asc' : 'dsc'">
          </span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-if="data.length"
            v-for="(entry, index) in filteredData"
        >
            <td v-if="number">{{ index + 1 }}</td>
            <td v-for="key in columns" >
                <component v-if="typeof key === 'object' && key.comp" :is="key.comp" :entry="entry"></component>
                <span v-else>{{entry[getKeyVal(key)]}}</span>
            </td>
        </tr>
        <tr v-if="!data.length">
            <td :colspan="countColumn">Empty</td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    let that;

    export default {
        props: {
            data: Array,
            columns: Array,
            filterKey: String,
            number : {
                type : Boolean,
                default : true
            }
        },

        data: function() {
            let sortOrders = {};
            let that = this;

            (that.columns|| []).map(key => sortOrders[that.getKeyVal(key)] = 1);

            return {
                sortKey: '',
                sortOrders: sortOrders
            };
        },

        methods: {
            getKeyLabel : key => {
                if (typeof key !== 'object') {
                    return key;
                }

                if (key.label) {
                    return key.label;
                }

                return key.alias;
            },
            getKeyVal : key => {
                if (typeof key !== 'object') {
                    return key;
                }

                if (key.alias) {
                    return key.alias;
                }

                return key.label;
            },
            sortBy: (key) => {
                that.sortKey = key;
                that.sortOrders[key] = that.sortOrders[key] * -1
            }
        },

        computed: {
            countColumn : () => ((that.number ? 1 : 0) + that.columns.length),
            filteredData: () => {
                var sortKey = that.sortKey
                var filterKey = that.filterKey && that.filterKey.toLowerCase()
                var order = that.sortOrders[sortKey] || 1
                var data = that.data

                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        })
                    })
                }
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey]
                        b = b[sortKey]
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }

                return data
            }
        },

        filters: {
            capitalize:  (str) => str.charAt(0).toUpperCase() + str.slice(1)
        },

        created : function () {
            that = this;
        }
    }
    
</script>

<style scoped>
    th.active .arrow {
        opacity: 1;
    }
    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.66;
    }

    .arrow.asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #000;
    }

    .arrow.dsc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #000;
    }
</style>
