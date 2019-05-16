/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require('../css/app.scss');

jQuery = require('jquery');

const ajaxService = require('./service/ajax.js');
const registerController = require('./controller/register.js');

new registerController(ajaxService);

console.log('build');
