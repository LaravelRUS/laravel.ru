export default class StickyPanel {
    /**
     * @type {number}
     * @private
     */
    _initialTop = 0;

    /**
     * @type {KnockoutObservable<T>}
     */
    top = ko.observable(true);

    /**
     * @type {KnockoutObservable<T>}
     */
    fixed = ko.observable(false);

    /**
     * @param root
     */
    constructor(root) {
        this._initialTop = root.getBoundingClientRect().top + document.body.scrollTop;

        document.addEventListener('scroll', e => this._touch(root));
        window.addEventListener('resize', e => this._touch(root));

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
        this.top(rect.height < window.innerHeight);

        let delta = this.top() ? 0 : rect.height - window.innerHeight;

        this.fixed(this._initialTop < scrollTop - delta);
    }
}