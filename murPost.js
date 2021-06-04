user = 1;

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
        listPost = JSON.stringify(xhr.response)
        listPost = JSON.parse(listPost)

        listPost.forEach(post => {
            console.log(post)
            let showPostsMur = document.querySelector(".showPostsMur")
            output = '';
            /* Information du user */
            output += `      
                <section class="header-showPost">
                    <section class="user-showPost">
                        <section class="avatar-user-showPost">
                            <img src="assets/images/upload/users/${post.userAvatar}" alt="avatar">
                        </section>
                        <section class="nameDate-showPost">
                            <div class="name-showPost">${post.userLastname} ${post.userName}</div>
                            <div class="datePost-showPost">${post.date_post}</div>
                        </section>
                    </section>`;

            if (post.myPost == 'oui') {
                output += `
                <section class="modify-showPost">
                    <span>...</span>
                </section>`;
            }

            /* Texte du commentaire */
            output += `
            </section>
            <section class="text-showPost">
                ${post.text_post}
            </section>`;

            /* Affichage des medias */
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
                    <video src=${post.cheminVideo}/${post.nomVideo} type="video/mp4" controls/>
                </section>`
            }

            /* Chiffres du post */
            output += `
            <section class="stat-showPost">
                <section class="like-stat-showPost">
                    <div class="likeCount-showPost">
                        <img src="assets/images/like.png" alt=""></img>${post.countLike} 
                    </div>
                    <div class="dislikeCount-showPost">
                        <img src="assets/images/dislike.png" alt=""></img>${post.countDislike}
                    </div>
                </section>`;

            if (post.countComment == 0) {
                output += `
                        <section class="comment-stat-showPost">
                            
                        </section>
                    </section>
                    <section class="container-action-showPost">
                        <section class="action-showPost">`;
            }
            if (post.countComment == 1) {
                output += `
                    <section class="comment-stat-showPost">
                        1 commentaire
                    </section>
                </section>
                <section class="container-action-showPost">
                    <section class="action-showPost">`
            }

            if (post.countComment > 1) {
                output += `
                    <section class="comment-stat-showPost">
                        ${post.countComment} commentaires
                    </section>
                </section>
                <section class="container-action-showPost">
                    <section class="action-showPost">`
            }

            /* Liker commenter */
            if (post.possibleLike == 0) {
                output += `        
                    <section class="like-action-showPost" onclick="likeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                        <img src="assets/images/likeNoColor.png" alt="like"></img> J'aime
                    </section>`
            } else {
                output += `
                    <section class="like-action-showPost validate" onclick="likeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                        <img src="assets/images/likeNoColor.png" alt="like"></img> J'aime
                    </section>`
            }
            output += `
                    <section class="comment-action-showPost">
                    <img src="assets/images/comment.png" alt="comment">commenter
                    </section>`

            if (post.possibleDislike == 0) {
                output += `
                        <section class="dislike-action-showPost" onclick="dislikeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                            <img src="assets/images/dislikeNoColor.png" alt="dislike"></img> J'aime pô
                        </section>
                    </section>
                    </section>`
            } else {
                output += `
                        <section class="dislike-action-showPost validate" onclick="dislikeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                            <img src="assets/images/dislikeNoColor.png" alt="dislike"></img> J'aime pô
                        </section>
                    </section>
                    </section>`
            }


            /*  Ajouter un commentaire */
            output += `         
                <section class="add-comment-showPost">
                    <section class="avatar-add-comment-showPost">
                        <img src="assets/images/upload/users/${post.avatarUserSession}" alt="avatar">
                    </section>
                    <section class="textarea-add-comment-showPost">
                        <textarea name="" id="add-comment${post.id_post}" oninput="check(${post.id_post});" placeholder="Ecrivez un commentaire ..."></textarea>
                    </section>
                </section>`

            /* Visualisation des commentaires */
            if (post.countComment > 0) {
                comments = post.comments
                comments.forEach(comment => {
                    output += `
                    <section class="view-comment-showPost">
                        <section class="user-photo-comment-showPost">
                            <img src="assets/images/upload/users/${comment.userAvatar}" alt="avatar">
                        </section>
                        <section class="name-date-text-comment-showPost">
                            <section class="user-name-showPost">
                                ${comment.userlastName} ${comment.userName}
                            </section>
                            <section class="date-comment-showPost">
                                ${comment.date_comment_post}
                            </section>                    
                            <section class="text-comment-showPost">
                                ${comment.text_comment_post}
                            </section>
                        </section>
                    </section>
                    </section>`
                });




            }



            let postShowNode = document.createElement('section')
            postShowNode.classList.add('showOnePost')
            postShowNode.innerHTML = output

            showPostsMur.append(postShowNode)




        });
    }
}
function check(id_post) {
    let hauteur = document.querySelector("#add-comment" + id_post).scrollHeight
    let val = document.querySelector("#add-comment" + id_post).value

    if (val === "") {
        document.querySelector("#add-comment" + id_post).style.height = '38px';
    } else {
        document.querySelector("#add-comment" + id_post).style.height = hauteur + 'px';
    }
}

function likeShowPost(like, dislike, post_id) {
    if (like === 0) {
        if (dislike === 0) {
            console.log("ca marche")

            let data = {
                post: post_id
            }

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "api/controllers/postShow.php");
            xhr.setRequestHeader("Content-Type", "text/plain");
            xhr.responseType = "json";
            xhr.send(JSON.stringify(data));
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 || xhr.status == 201) {
                    console.log("reponse arrive")
                }
            }
        }
    }
}
        function dislikeShowPost(like, dislike, post_id) {

        }





