import { Reader } from "dioma";
import Component from "./Component";
import Inject from "dioma/src/Di/Annotations/Inject";
import Application from "../../app/Application";
import Input from "./Input";

@Inject(['app'])
export default class ComponentLoader {
    /**
     * @param {string} path
     * @private
     */
    _resolver: Function = path => {};

    /**
     * @type {Application}
     * @private
     */
    _app: Application;

    /**
     * @param app
     * @param resolver
     */
    constructor(app: Application, resolver: Function) {
        this._app = app;
        this._resolver = resolver;
    }

    /**
     * @param components
     */
    register(...components) {
        for (let component of components) {
            let cls = this._resolver(component);
            let reader = new Reader(cls);

            this._loadComponent(cls, reader);
        }
    }

    /**
     * @param ctx
     * @param reader
     * @private
     */
    _loadComponent(ctx, reader: Reader) {
        let annotation = reader.getClassAnnotation('Component');

        ko.components.register(annotation.name, {
            viewModel: args => {
                let instance = this._app.make(ctx);

                this._applyArguments(reader, args, instance);

                instance.create(args);

                return instance;
            },
            template: annotation.view
        });
    }

    /**
     * @param reader
     * @param args
     * @param instance
     * @private
     */
    _applyArguments(reader: Reader, args = {}, instance: Object) {
        for (let property of Object.keys(args)) {
            let input = reader.getPropertyAnnotation('Input', property);

            if (input) {
                instance[property] = args[property];
            }
        }
    }
}
