import { Option } from "../../components/dropdown/dropdown";

export default class Search {
    /**
     * @type {[*]}
     */
    _placeholders = {
        docs: 'Поиск по документации',
        articles: 'Поиск по статьям',
        packages: 'Поиск по пакетам'
    };

    /**
     * @type {KnockoutObservable<string>}
     */
    placeholder = ko.observable(this._placeholders.docs);

    /**
     * @type {KnockoutObservable<T>}
     */
    value = ko.observable('');

    /**
     * @type {KnockoutObservableArray<T>}
     */
    options = ko.observableArray([
        new Option('docs', 'Документация'),
        new Option('articles', 'Статьи'),
        new Option('packages', 'Пакеты'),
    ]);

    /**
     * @type {KnockoutObservable<T>}
     */
    category = ko.observable(null);

    /**
     * @constructor
     */
    constructor() {
        this.category.subscribe((option: Option) => {
            this.placeholder(this._placeholders[option.value]);
        });
    }
}
