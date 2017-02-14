export default class StickyPanelViewModel {
    /**
     * @type {number}
     * @private
     */
    _initialTop = 0;

    /**
     * @type {KnockoutObservable<T>}
     */
    top = ko.observable(0);

    /**
     * @type {KnockoutObservable<T>}
     */
    fixed = ko.observable(false);

    constructor(root) {
        this._initialTop = root.getBoundingClientRect().top + document.body.scrollTop;

        document.addEventListener('scroll', e => {
            this._touch(root);
        });

        this._touch(root);
    }

    /**
     * @private
     */
    _touch(root) {
        requestAnimationFrame(() => {
            this._onScroll(root.getBoundingClientRect(), document.body.scrollTop);
        });
    }

    /**
     * @param {ClientRect} rect
     * @param {number} scrollTop
     * @private
     */
    _onScroll(rect, scrollTop) {
        this.top(this._initialTop > scrollTop ? 0 : scrollTop - this._initialTop);
        this.fixed(this.top() !== 0);
    }
}