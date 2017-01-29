/**
 * Babel kernel polyfill for full ES6 support
 */
import 'babel-polyfill';

/**
 * JS Router
 */
import './router';

/**
 * Technical Knockout library
 */
import ko from 'tko/dist/tko';

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
window.ko = ko;

(new Application())
    .ready(e => document.body.classList.add('loaded'));

