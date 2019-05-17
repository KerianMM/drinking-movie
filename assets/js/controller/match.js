module.exports = class Match {
    constructor(ajaxService){
        if(user_id === undefined || user_id === null) return;

        this.ajaxService = ajaxService;

        document.addEventListener('DOMContentLoaded', function(){
            this.match(jQuery('[data-action="match_add"]'), true);
            this.match(jQuery('[data-action="match_remove"]'), false);
        }.bind(this));
    }

    match(buttons, add){
        for (let i = 0; i < buttons.length; i++) {
            let element = buttons[i];

            jQuery(element).on('click', function(){
                let idMatch = element.getAttribute('data-id-rule');
                this.getMatchCount(idMatch, function(count){
                    (add) ?count++ : count--;
                    if(count >= 0){
                        this.updateMatchCount(idMatch, count, function(){
                            this.updateCountSpanElement(count, element);
                        }.bind(this))
                    }
                }.bind(this))
            }.bind(this));
        }
    }

    updateCountSpanElement(count, element){
        jQuery(element).parent().parent().find('span.match-count').html(count);
    }

    getMatchCount(idMatch, success){
        this.ajaxService.getMatch(idMatch, function(match){
            if(match.participant.id === user_id){
                success(match.count);
            }
        });
    }
    updateMatchCount(idMatch, count, callback){
        this.ajaxService.updateMatch(idMatch, {"count": count}, callback)
    }
};