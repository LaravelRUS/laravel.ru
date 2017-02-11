/**
 * Babel kernel polyfill for full ES6 support
 */
import 'babel-polyfill';

/**
 * JS Router
 */
import './vendor/router';

/**
 * Knockout library
 */
import ko from 'knockout';
window.ko = ko;

import 'knockout.punches';
ko.punches.enableAll();

import 'knockout.validation/dist/knockout.validation';

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

