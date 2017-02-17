import {default as AbstractComponent, View} from './AbstractComponent';

@View(`
<input type="{{ visible() ? 'text' : 'password' }}" name="{{ name }}"
       data-bind="value: password" 
       placeholder="Пароль {{ visible() ? '(видимый)' : '' }}" />
           
{{#if visible}}
    <span class="form-item-hide-password" title="Скрыть пароль"
          data-bind="click: toggleVisibility"></span>
{{/if}}
{{#ifnot visible}}
    <span class="form-item-show-password" title="Показать пароль"
          data-bind="click: toggleVisibility"></span>
{{/ifnot}}
`)
export default class Password extends AbstractComponent {
    /**
     * @type {KnockoutObservable<T>}
     */
    name = ko.observable('');

    /**
     * @type {KnockoutObservable<T>}
     */
    password = ko.observable('');

    /**
     * @type {KnockoutObservable<T>}
     */
    visible = ko.observable(false);

    /**
     * @param params
     */
    constructor(params) {
        super();
        this.mergeParams(params);
    }

    /**
     * @return {boolean}
     */
    toggleVisibility() {
        this.visible(!this.visible());

        return false;
    }
}