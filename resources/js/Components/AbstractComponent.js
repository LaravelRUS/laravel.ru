export function View(value) {
    return (ctx) => {
        ctx.template = value;
        return ctx;
    };
}

export default class AbstractComponent {
    /**
     * @type {string}
     */
    static template = '';

    /**
     * @param params
     */
    mergeParams(params) {
        for (let field of Object.keys(params)) {
            if (field === '$raw') {
                continue;
            }

            if (ko.isObservable(this[field])) {
                this.merge(field, params[field]);
            } else {
                throw new Error(`Invalid parameter ${field} of ${this.constructor.name} component`);
            }
        }
    }

    /**
     * @param name
     * @param value
     */
    merge(name, value) {
        let original = ko.unwrap(value);

        this[name](original);

        if (ko.isObservable(value)) {
            this[name].subscribe(value);
            value.subscribe(this[name]);
        }
    }
}