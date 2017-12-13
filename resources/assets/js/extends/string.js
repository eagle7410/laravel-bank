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
    }
};

for (let prop in extend)
    String.prototype[prop] = extend[prop];

/**
 * @export String
 * @property htmlAttrToVueProp
 * @property firstCharToLower
 * @property htmlAttrToVueProp
 */
export default String
