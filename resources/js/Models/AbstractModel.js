export default class AbstractModel {
    /**
     * @type {{}}
     * @private
     */
    _original = {};

    /**
     * @param {object} args
     */
    constructor(args = {}) {
        this._original = args;

        for (let field of Object.keys(this._original)) {
            Object.defineProperty(this, field, {
                get: () => this._original[field],
                set: (newValue) => this._original[field] = newValue
            });
        }
    }
}