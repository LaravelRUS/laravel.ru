import Highlight from "../Support/Highlight";
import StickyPanel from "./ArticleListViewModel/StickyPanel";

export default class DocsShowViewModel {
    /**
     * @type {Highlight}
     * @private
     */
    _highlight = new Highlight;

    /**
     * @param {HTMLElement} root
     */
    constructor(root) {
        this._highlight.init(root, '_render');

        this.aside = new StickyPanel(root.querySelector('[data-id="nav"]'));
    }

    /**
     * @param {HTMLElement} node
     * @return {*}
     * @private
     */
    _render(node) {
        return this._highlight.render(node);
    }
}