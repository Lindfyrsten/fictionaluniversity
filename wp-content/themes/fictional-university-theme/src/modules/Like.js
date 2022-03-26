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
        if (currentLikeBox.attr('data-exists') == 'yes'){
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox);
        }
    }

    createLike(currentLikeBox){
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            method: 'POST',
            data: {'professorId': currentLikeBox.data('professor')},
            success: (response) => {
                currentLikeBox.attr('data-exists', 'yes');
                var likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);
                likeCount++;
                currentLikeBox.find('.like-count').html(likeCount);
                currentLikeBox.attr('data-like', response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox){
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            data: {'like': currentLikeBox.attr('data-like')},
            method: 'DELETE',
            success: (response) => {
                currentLikeBox.attr('data-exists', 'no');
                var likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10);
                likeCount--;
                currentLikeBox.find('.like-count').html(likeCount);
                currentLikeBox.attr('data-like', '');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
}

export default Like;