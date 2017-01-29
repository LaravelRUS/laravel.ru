export default class Application {
    /**
     * @constructor
     */
    constructor() {
        this.ready(status => {
            this.bindViewModels('ViewModels/');
        });
    }

    /**
     * @param {String} prefix
     * @return {Application}
     */
    bindViewModels(prefix) {
        for (let node of document.querySelectorAll('[data-vm]')) {
            let cls  = require(`./${prefix}${node.getAttribute('data-vm')}`).default;

            ko.applyBindings(new cls(node), node);
        }

        return this;
    }

    /**
     * @param {Function} callback
     * @return {Application}
     */
    ready(callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function (event) {
                callback(document.readyState);
            });
        } else {
            callback(document.readyState);
        }

        return this;
    }
}