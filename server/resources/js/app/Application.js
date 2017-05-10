import { Container } from "dioma";
import ComponentLoader from "../src/Views/ComponentLoader";
import ViewModelsLoader from "../src/Views/ViewModelsLoader";

export default class Application extends Container {
    constructor() {
        super(true);

        this._bindDependencies();

        this.instance('app', this);
        this.make(ComponentLoader).register('text', 'dropdown');

        this.ready(() => {
            this.make(ViewModelsLoader)
                .named('data-vm')
                .load();
        })
    }

    /**
     * @private
     */
    _bindDependencies() {
        this
            .instance(
                (new ComponentLoader(this, name => require(`./components/${name}/${name}`).default))
            )
                .alias(ComponentLoader, 'components')

            .instance(
                new ViewModelsLoader(name => require(`./viewModels/${name}`).default)
            )
                .alias(ViewModelsLoader, 'views')
        ;
    }

    /**
     * @param callback
     */
    ready(callback: Function): void {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function (event) {
                callback(document.readyState);
            });
        } else {
            callback(document.readyState);
        }
    }
}
