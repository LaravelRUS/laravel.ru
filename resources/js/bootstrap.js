/**
 * Babel kernel polyfill for full ES6 support
 */
import 'babel-polyfill';

/**
 * Knockout library
 */
import ko from 'knockout';
window.ko = ko;

/**
 * Extended template engine
 */
import 'knockout.punches';
ko.punches.enableAll();

/**
 * Validation support
 */
import 'knockout.validation/dist/knockout.validation';

/**
 * Vendor libraries
 */
import './vendor/helpers';
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

(new Application())
    .ready(e => document.body.classList.add('loaded'));

