import 'babel-polyfill';
import ko from 'knockout';
import router from './vendor/router';
import 'knockout.validation/dist/knockout.validation';
import 'knockout.validation/localization/ru-RU';

import './../css/app.scss';

import Application from './app/Application';

/**
 * Kernel
 */
window.ko = ko;
window.router = router;

/**
 * Inview plugin
 */
import inview from "knockout-inview";
ko.bindingHandlers.inview = inview(ko);

/**
 * Validation support
 */

ko.validation.configuration.insertMessages = false;
ko.validation.locale('ru-RU');

window.app = new Application();
