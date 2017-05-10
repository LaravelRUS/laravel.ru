import Component from "src/Views/Component";
import Input from "../../../src/Views/Input";

@Component({
    name: 'ui-text',
    view: require('./text.html'),
    style: require('./text.scss')
})
export default class Text {
    /**
     * @type {KnockoutObservable<string>}
     */
    @Input()
    value = ko.observable('');

    /**
     * @type {KnockoutObservable<string>}
     */
    @Input()
    placeholder = ko.observable('');

    /**
     * @param parameters
     * @private
     */
    create(parameters: Object) {
    }
}
