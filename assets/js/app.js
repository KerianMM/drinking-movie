/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require('../css/app.scss');

jQuery = require('jquery');

const ajaxService = require('./service/ajax.js');

document.addEventListener('DOMContentLoaded', function(){
    // ajaxService.getParticipant(64, function (datas){
    //     datas.sessions.push("/api/sessions/19");
    //     ajaxService.updateParticipant(64, datas.sessions, function(){
    //         ajaxService.getParticipant(64, function (datas){
    //             console.log(datas.sessions);
    //         });
    //     });
    // });
});

console.log('build');
