let user = document.querySelector('#idUser').value


data = {
    user: user
}

let xhr = new XMLHttpRequest();
xhr.open("POST", "api/controllers/postShow.php");
xhr.setRequestHeader("Content-Type", "text/plain");
xhr.responseType = "json";
xhr.send(JSON.stringify(data));
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 || xhr.status == 201) {
        let listPost = JSON.stringify(xhr.response)
        listPost = JSON.parse(listPost)

        listPost.forEach(post => {
            console.log(post)
            let murPost = document.querySelector(".murPost")
            output = '';
            output += `
            <section class="showPost">
                <section class="header-showPost">
                    <section class="user-showPost">
                        <div class="name-showPost">${post.userName} ${post.userLastname}</div>
                        <div class="datePost-showPost">${post.date_post}</div>
                    </section>`;

            if (post.myPost == 'oui') {
                output += `
                <section class="modify-showPost">
                    Ce post m'appartient
                </section>`;
            }

            output += `
            </section>
            <section class="text-showPost">
                ${post.text_post}
            </section>`;

            if (post.image_post == "oui") {
                images = post.images
                images.forEach(image => {
                    output += `
                    <section class="media-showPost">
                        <img src=${image.chemin}/${image.name_image_post} alt=""></img>
                    </section>`
                });
            }

            if (post.video_post == "oui") {
                output += `
                <section class="media-showPost">
                    <video src=${post.cheminVideo}/${post.nomVideo} type="video/mp4" class="img-thumbnail" controls/>
                </section>`
            }

            output+=`
            <section class="stat-showPost">
                <section class="like-stat-showPost">
                    like${post.countLike} 
                    dislike${post.countDislike}
                </section>
                <section class="comment-stat-showPost">
                    comment ${post.countComment}
                </section>
            </section>
            <section class="action-showPost">
                <section class="like-action-showPost">
                    possible like: ${post.possibleLike}
                    possible dislike: ${post.possibleDislike}
                </section>
                <section class="comment-action-showPost">
                    commenter
                </section>
            </section>`

            output+=`
            <section class="comment-showPost">
                <section class="add-comment-showPost">
                    Ecrivez un commentaire...
                </section>`

            if (post.countComment > 0) {
                comments = post.comments
                comments.forEach(comment => {
                    output+=`
                    <section class="view-comment-showPost">
                        <section class="user-photo-comment-showPost">
                        avatar
                        </section>
                        <section class="user-name-text-showPost">
                            <section class="user-name-showPost">`
                });
                
            }




            murPost.innerHTML = output




        });
    }
}





