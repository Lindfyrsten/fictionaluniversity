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
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox);
        }
    }

    createLike(currentLikeBox){
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            method: 'POST',
            data: {'professorId': currentLikeBox.data('professor')},
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox){
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            method: 'DELETE',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
}

export default Like;