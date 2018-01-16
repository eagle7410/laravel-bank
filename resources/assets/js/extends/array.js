const extend = {
    sumProp : function(prop) {
        return this.reduce((sum, el) => sum + (isNaN(el[prop]) ? 0 : Number(el[prop])), 0);
    }
};

for (let prop in extend)
    Array.prototype[prop] = extend[prop];

/**
 * @export Array
 * @property sumProp
 */
export default Array
