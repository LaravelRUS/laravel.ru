export default class Dropdown {
    /**
     * @type {KnockoutObservable<Boolean>}
     */
    visible = ko.observable(false);

    /**
     * @type {KnockoutObservable<String>}
     */
    active = ko.observable('');

    /**
     * @param {String} dataIdValue
     * @param {String} activeClass
     * @param {String} dataIdField
     */
    constructor(dataIdValue = 'no-handle', activeClass = 'active', dataIdField = 'data-id') {
        window.addEventListener('click', event => {
            let current = event.target;

            while (current) {
                if (current.getAttribute(dataIdField) === dataIdValue) {
                    return;
                }
                current = current.parentElement;
            }

            this.visible(false);
        });

        this.visible.subscribe(state => {
            this.active(state ? activeClass : '');
        })
    }

    /**
     * @return {Dropdown}
     */
    toggle() {
        this.visible(!this.visible());

        return true;
    }
}
