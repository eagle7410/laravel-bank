const extend = {
    toStringByFormat : function (format = 'd-m-y') {
        let that  = this;
        let year  = that.getFullYear();
        let month = that.numberHas2Symbols(that.getMonth() + 1);
        let day   = that.numberHas2Symbols(that.getDate());

        return format.replace('d', day)
            .replace('m', month)
            .replace('y', year);
    },
    numberHas2Symbols : function (val) {
        return String(val.toString().length < 2 ? '0' + val : val);
    },
    isFuture : function () {
        return Date.now() < this.getTime();
    },
    isFutureOrNowDay : function () {
        if (this.isFuture()) {
            return true;
        }

        return (new Date()).toStringByFormat() === this.toStringByFormat();
    }
};

for (let prop in extend)
    Date.prototype[prop] = extend[prop];

/**
 * @export Date
 * @property numberHas2Symbols
 * @property toStringByFormat
 * @property isFuture
 * @property isFutureOrNowDay
 */
export default Date
