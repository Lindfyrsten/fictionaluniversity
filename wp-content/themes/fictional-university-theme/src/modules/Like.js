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
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            method: 'POST',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(){
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