import Component from "../../../src/Views/Component";
import Input from "../../../src/Views/Input";

export class Option {
    /**
     * @type {KnockoutObservable<T>}
     */
    current = ko.observable(false);

    constructor(value, title: ?string) {
        this.value = value;
        this.title = title || value;
    }
}

@Component({
    name:  'ui-dropdown',
    view:  require('./dropdown.html'),
    style: require('./dropdown.scss')
})
export default class Dropdown {
    /**
     * @type {KnockoutObservable<string>}
     */
    @Input() placeholder = ko.observable('Select value');

    /**
     * @type {KnockoutObservableArray<Option>}
     */
    @Input() options = ko.observableArray([]);

    /**
     * @type {KnockoutObservable<T>}
     */
    @Input() value = ko.observable(null);

    /**
     * @type {KnockoutObservable<T>}
     */
    visible = ko.observable(false);

    /**
     * @type {KnockoutObservable<T>}
     */
    hover = ko.observable(false);

    /**
     * @type {KnockoutObservable<T>}
     */
    @Input() autoSelect = ko.observable(true);

    /**
     * @constructor
     */
    constructor() {
        document.addEventListener('click', i => {
            if (!this.hover()) {
                this.visible(false);
            }
        })
    }

    /**
     * @return void
     */
    create() {
        this.options.subscribe(::this._selectDefaultValue);
        this.value.subscribe(::this._selectDefaultValue);
        this.autoSelect.subscribe(::this._selectDefaultValue);

        this._selectDefaultValue();
    }

    /**
     * @private
     */
    _selectDefaultValue() {
        if (this.autoSelect() && this.value() === null) {
            for (let option of this.options()) {
                this.select(option);
                return;
            }
        }
    }

    /**
     * @return {boolean}
     */
    toggle() {
        this.visible(!this.visible());

        return false;
    }

    /**
     * @param current
     */
    select(current) {
        for (let option of this.options()) {
            option.current(current === option);
        }

        this.visible(false);
        this.value(current);
    }
}
