class MyAjax {
    constructor() {
        this.siteUrl = "http://127.0.0.1:8000/api";
        console.log(jQuery);
    }

    ajax(route, success, fail, await, datas = {}){
        datas.accepts = {
            mycustomtype: 'application/ld+json'
        };
        datas.success = success;
        datas.await = await;
        datas.fail = fail;

        jQuery.ajax(this.siteUrl + route, datas);
    }

    put(route, body, success, fail, await, datas = {}){
        datas.contentType = 'application/ld+json';
        datas.method = 'PUT';
        datas.data = JSON.stringify(body);

        this.ajax(route, success, fail, await, datas);
    }

    getMovies(success, fail, await){
        this.ajax('/movies', success, fail, await);
    }

    getParticipant(id, success, fail, await){
        this.ajax(`/participants/${id}`, success, fail, await);
    }

    updateParticipant(id, sessions, success, fail, await){
        let body = {
            "sessions": sessions
        };
        this.put(`/participants/${id}`, body, success, fail, await)
    }
}

module.exports = new MyAjax();