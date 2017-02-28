import Highlight from "../Support/Highlight";

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