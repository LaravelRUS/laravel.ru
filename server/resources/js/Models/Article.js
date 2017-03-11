import AbstractModel from "./AbstractModel";

export default class Article extends AbstractModel {
    /**
     * @type {KnockoutObservable<T>}
     */
    visible = ko.observable(false);

    /**
     * @type {KnockoutObservable<T>}
     */
    loaded = ko.observable(false)
        .extend({ throttle: 200 });

    /**
     * @param {object} args
     */
    constructor(args = {}) {
        super(args);

        this.visible.subscribe(status => {
            if (status) {
                this.loaded(true);
            }
        });
    }
}