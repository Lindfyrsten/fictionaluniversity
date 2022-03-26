import $ from 'jquery';

class Like {
    constructor(){
        this.events();
    }

    events(){
        $(".like-box").on('click', this.clickDispatcher.bind(this));
    }

    //methods

    clickDispatcher(e){
        var currentLikeBox = $(e.target).closest('.like-box');
        if (currentLikeBox.data('exists') == 'yes'){
            this.deleteLike();
        } else {
            this.createLike();
        }
    }

    createLike(){
        alert('create test msg');
        // $('.like-box').data('exists') = 'yes';
    }

    deleteLike(){
        alert('delete test msg');
        // $('.like-box').data('exists') = 'no';
    }
}

export default Like;