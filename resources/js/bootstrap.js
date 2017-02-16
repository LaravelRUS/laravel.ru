/**
 * Babel kernel polyfill for full ES6 support
 */
import 'babel-polyfill';

/**
 * Knockout library
 */
import ko from 'knockout';
(global || window).ko = ko;


/**
 * Extended template engine
 */
import 'knockout.punches';
ko.punches.enableAll();

/**
 * Validation support
 */
import 'knockout.validation/dist/knockout.validation';
import 'knockout.validation/localization/ru-RU';

ko.validation.configuration.errorMessageClass = "label error";
ko.validation.locale('ru-RU');


/**
 * Vendor libraries
 */
import './vendor/router';

/**
 * Application styles
 */
import './../css/app.scss';

/**
 * Application kernel
 */
import Application from './Application';

/**
 * BOOTSTRAP
 */
new Application();

