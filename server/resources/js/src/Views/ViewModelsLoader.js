export default class ViewModelsLoader {
    /**
     */
    _root = document.body;

    /**
     * @type {string}
     * @private
     */
    _resovler: Function = name => {};

    /**
     * @type {string}
     * @private
     */
    _query = 'data-vm';

    /**
     * @param resolver
     */
    constructor(resolver: Function) {
        this._resovler = resolver;
    }

    /**
     * @param query
     * @return {ViewModelsLoader}
     */
    named(query) {
        this._query = query;

        return this;
    }

    /**
     * @return {ViewModelsLoader}
     */
    load(root = document.body) {
        this._load(root);

        return this;
    }

    /**
     * @param root
     * @private
     */
    _load(root) {
        for (let node of root.querySelectorAll(`[${this._query}]`)) {
            let name     = node.getAttribute(this._query);
            let cls      = this._resovler(name);
            let instance = new cls(node);

            ko.applyBindings(instance, node);
        }
    }
}
