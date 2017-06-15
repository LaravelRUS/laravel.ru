import { Annotation } from "dioma";

class Component {
    /**
     * @type {string}
     */
    name: string = 'component';

    /**
     * @type {string}
     */
    view: string = '';
}

export default function (args) {
    return new Annotation(args, 'name').delegate(Component);
}
