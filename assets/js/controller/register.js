module.exports = class Register {
    generateSessionRoute(id){
        return `/api/sessions/${id}`;
    }

    constructor(ajaxService){
        if(user_id == undefined || user_id == null) return;

        this.ajaxService = ajaxService;

        document.addEventListener('DOMContentLoaded', function(){
            this.register(jQuery('[data-action="session_register"]'), true);
            this.register(jQuery('[data-action="session_unregister"]'), false);
        }.bind(this));
    }

    register(buttons, register){
        let removeRow = function(element){
            let row = element.parentElement.parentElement;
            row.parentElement.removeChild(row);

            return row;
        };
        let addRegisterRow = function(row){
            jQuery('#session-register tbody').append(row);
        };
        let addUnregisterRow = function(row){
            jQuery('#session-unregister tbody').append(row);
        };

        let registerSession     = function(sessions, newSession){
            if(sessions.indexOf(newSession) != -1) return;
            sessions.push(newSession);
        };
        let unregisterSession   = function(sessions, newSession){
            let indexOf = sessions.indexOf(newSession);
            if(indexOf == -1) return;
            sessions.splice(indexOf, 1);
        };

        for (let i = 0; i < buttons.length; i++) {
            let element = buttons[i];
            let session = this.generateSessionRoute(element.getAttribute('data-id'));

            let registerEventListener   = function(){
                jQuery(element).fadeOut();
                this.getSessionsByUser(function(sessions){
                    registerSession(sessions, session);

                    this.updateSessionByUser(sessions, function(){
                        let row = removeRow(element);
                        addUnregisterRow(row);

                        makeUnregistererToggler(element);
                    }.bind(this));
                }.bind(this));
            }.bind(this);
            let unregisterEventListener = function(){
                jQuery(element).fadeOut();
                this.getSessionsByUser(function(sessions){
                    unregisterSession(sessions, session);

                    this.updateSessionByUser(sessions, function(){
                        let row = removeRow(element);
                        addRegisterRow(row);

                        makeRegistererToggler(element);
                    }.bind(this));
                }.bind(this));
            }.bind(this);

            let makeRegistererToggler   = function(element){
                jQuery(element).off('click', unregisterEventListener);
                jQuery(element).on('click', registerEventListener);

                element.classList.remove('btn-danger');
                element.classList.add('btn-success');

                let iconeElement = jQuery(element).children('i')[0];
                iconeElement.classList.remove('fa-plus');
                iconeElement.classList.add('fa-time');

                jQuery(element).fadeIn();
            };
            let makeUnregistererToggler = function(element){
                jQuery(element).off('click', registerEventListener);
                jQuery(element).on('click', unregisterEventListener);

                element.classList.remove('btn-success');
                element.classList.add('btn-danger');

                let iconeElement = jQuery(element).children('i')[0];
                iconeElement.classList.remove('fa-plus');
                iconeElement.classList.add('fa-time');

                jQuery(element).fadeIn();
            };

            if(register) {
                jQuery(element).on('click', registerEventListener);
            }else {
                jQuery(element).on('click', unregisterEventListener);
            }
        }
    }

    getSessionsByUser(callback){
        this.ajaxService.getParticipant(user_id, function(participant){
            callback(participant.sessions);
        });
    }
    updateSessionByUser(sessions, callback){
        this.ajaxService.updateParticipant(user_id, sessions, callback)
    }
};