import hljs from "highlight.js";

export default class Highlight {
    /**
     * @param {HTMLElement} root
     * @param {string} callback
     */
    init(root, callback) {
        for (let node of root.querySelectorAll('pre > code')) {
            node.setAttribute('data-bind', `inview: function(node) { ${callback}(node); }`);
        }
    }

    /**
     * @param {HTMLElement} node
     */
    render(node) {
        if (!node.hasAttribute('data-rendered')) {
            node.setAttribute('data-rendered', 'data-rendered');

            hljs.highlightBlock(node);

            let i = 0;
            if (node.innerHTML[node.innerHTML.length - 1] !== "\n") {
                node.innerHTML += "\n";
            }

            node.innerHTML = node.innerHTML.replace(/(.*?)\n/g, (data, line) => {
                return `<span class="code-line"><span class="code-line-index">${++i}</span></span>${line}\n`;
            });
        }
    }
}
