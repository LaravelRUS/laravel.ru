import Password from './Components/Password';

export default class Application {
    /**
     * @constructor
     */
    constructor() {
        this.ready(status => {
            this.registerComponent('password', Password);

            this.bindViewModels('ViewModels/');
        });
    }

    /**
     * @param name
     * @param cls
     */
    registerComponent(name, cls) {
        ko.components.register(name, {
            viewModel: function(params = {}) {
                return new cls(params);
            },
            template: cls.template
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