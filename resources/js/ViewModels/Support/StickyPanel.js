export default class StickyPanel {
    /**
     * Значение позиции top элемента при инциализации
     *
     * @type {number}
     * @private
     */
    _initialTop = 0;

    /**
     * Значение - прибивать ли панель наверх ("top: 0") или нет (или вниз: "bottom: 0")
     *
     * @type {KnockoutObservable<T>}
     */
    top = ko.observable(true);

    /**
     * Прибивать ли панель ("position: fixed") или она располагается по-умолчанию.
     *
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
     * Обновление позиции, с синхронизацией с frame rate (по-дефолту 60 раз в секунду макс)
     *
     * @private
     */
    _touch(root) {
        requestAnimationFrame(() => {
            this._onScroll(root.getBoundingClientRect(), document.body.scrollTop);
        });
    }

    /**
     * Вычисление новой позиции
     *
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