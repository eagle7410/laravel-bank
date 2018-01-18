const extend = {
    capitalize : function() {
        return this.length ? this.charAt(0).toUpperCase() + this.slice(1) : '';
    },
    firstCharToLower : function () {
        return this.length ? this.charAt(0).toLowerCase() + this.slice(1) : '';
    },
    htmlAttrToVueProp : function () {
        return this.toString()
            .split('-')
            .map(word => word.capitalize())
            .join('')
            .firstCharToLower();
    },
    vuePropToModelAttr : function () {
        return this.toString().replace(/([A-Z])/g, '_$1').toLowerCase()
    },
    toDateFormat : function (format) {
        let string = this.toString().trim();

        if (typeof string !== 'string') {
            console.warn(`toDateFormat \ ${this} No string`);
            return '';
        }

        if (!string.length) {
            console.warn(`toDateFormat \ ${this} No length`);
            return '';
        }

        let inRegExp;

        if (string.length === 19) {
            inRegExp = /(\d{4})-(\d{2})-(\d{1,2})\s(\d{2}):(\d{2}):(\d{2})/
        } else {
            inRegExp = /(\d{4})\/(\d{2})\/(\d{1,2})/
        }

        let math = string.trim().match(inRegExp);

        if (!math) {
            console.warn(`toDateFormat \ ${this} Bad start format`);
            return '';
        }

        let d = math[3];

        if (d.length === 1) {
            d = '0' + d;
        }

        return format.replace('y', math[1])
            .replace('m', math[2])
            .replace('d', d)
            .replace('h', math[4])
            .replace('i', math[5])
            .replace('s', math[6])
    }
};

for (let prop in extend)
    String.prototype[prop] = extend[prop];

/**
 * @export String
 * @property htmlAttrToVueProp
 * @property firstCharToLower
 * @property htmlAttrToVueProp
 * @property toDateFormat
 */
export default String
