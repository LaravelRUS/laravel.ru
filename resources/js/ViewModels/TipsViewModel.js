import TipsRepository from "../Models/Repository/TipsRepository";

const TIPS_OVERLOOK_KEY = 'tips_overlooks';

export default class TipsViewModel {
    /**
     * @type {KnockoutObservable<T>}
     */
    visible = ko.observable(false);

    /**
     * @type {TipsRepository}
     */
    repo = new TipsRepository();

    /**
     * @type {KnockoutObservable<Tip>}
     */
    tipOfDay = ko.observable();

    /**
     * @type {KnockoutObservableArray<T>}
     */
    tips = ko.observableArray([]);

    constructor() {
        if (!this._isOverlooked()) {
            this.nextTip();
        }
    }

    /**
     * @return {TipsViewModel}
     * @private
     */
    _overlook() {
        sessionStorage.setItem(TIPS_OVERLOOK_KEY, true);

        return this;
    }

    /**
     * @return {boolean}
     * @private
     */
    _isOverlooked() {
        return !!sessionStorage.getItem(TIPS_OVERLOOK_KEY);
    }

    /**
     * @return {boolean}
     */
    async like() {
        await this.nextTip();

        return false;
    }

    /**
     * @return {boolean}
     */
    async dislike() {
        await this.nextTip();

        return false;
    }

    /**
     * @private
     */
    _removeCurrentTip() {
        if (this.tipOfDay()) {
            this.visible(false);
            this.tips.remove(this.tipOfDay());
            this.tipOfDay(null);
        }
    }

    /**
     * @return {boolean}
     */
    close() {
        this._overlook();
        this.visible(false);

        return false;
    }

    async nextTip() {
        this._removeCurrentTip();

        if (this.tips().length === 0) {
            this.tips(await this.repo.get(10));
        }

        this._getRandomTip();
    }

    /**
     * @private
     */
    _getRandomTip() {
        let tip = this.tips()[Math.floor(Math.random() * this.tips().length)];

        this.tipOfDay(tip);
        this.visible(true);
    }
}
