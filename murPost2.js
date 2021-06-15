user = document.querySelector("#idUser")
user = user.value

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

        /* Boucles des posts */
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

            /* Texte du post */
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
                    <div class="likeCount-showPost" id="likeCount${post.id_post}">
                        <img src="assets/images/like.png" alt="like"></img><span>${post.countLike}</span>
                    </div>
                    <div class="dislikeCount-showPost" id="dislikeCount${post.id_post}">
                        <img src="assets/images/dislike.png" alt="dislike"></img><span>${post.countDislike}</span>
                    </div>
                </section>`;

            if (post.countComment == 0) {
                output += `
                        <section class="comment-stat-showPost" id="commentCount${post.id_post}">
                            
                        </section>
                    </section>
                    <section class="container-action-showPost">
                        <section class="action-showPost">`;
            }
            if (post.countComment == 1) {
                output += `
                    <section class="comment-stat-showPost" id="commentCount${post.id_post}">
                        1 commentaire
                    </section>
                </section>
                <section class="container-action-showPost">
                    <section class="action-showPost">`
            }

            if (post.countComment > 1) {
                output += `
                    <section class="comment-stat-showPost" id="commentCount${post.id_post}">
                        <span>${post.countComment}</span> commentaires
                    </section>
                </section>
                <section class="container-action-showPost">
                    <section class="action-showPost">`
            }

            /* Liker/commenter */
            if (post.possibleLike == 0) {
                output += `        
                    <section class="like-action-showPost" id="like${post.id_post}" onclick="likeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                        <img src="assets/images/likeNoColor.png" alt="like"></img> J'aime
                    </section>`
            } else {
                output += `
                    <section class="like-action-showPost validate" id="like${post.id_post}" onclick="likeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                        <img src="assets/images/likeNoColor.png" alt="like"></img> J'aime
                    </section>`
            }
            output += `
                    <section class="comment-action-showPost" id="comment-action${post.id_post}">
                    <img src="assets/images/comment.png" alt="comment">commenter
                    </section>`

            if (post.possibleDislike == 0) {
                output += `
                        <section class="dislike-action-showPost" id="dislike${post.id_post}" onclick="dislikeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                            <img src="assets/images/dislikeNoColor.png" alt="dislike"></img> J'aime pô
                        </section>
                    </section>
                    </section>`
            } else {
                output += `
                        <section class="dislike-action-showPost validate" id="dislike${post.id_post}" onclick="dislikeShowPost(${post.possibleLike}, ${post.possibleDislike}, ${post.id_post})">
                            <img src="assets/images/dislikeNoColor.png" alt="dislike"></img> J'aime pô
                        </section>
                    </section>
                    </section>`
            }


            /*  Ajouter un commentaire */
            output += `         
                <section class="add-comment-showPost" id="add-comment${post.id_post}">
                    <section class="avatar-add-comment-showPost">
                        <img src="assets/images/upload/users/${post.avatarUserSession}" alt="avatar">
                    </section>
                    <section class="textarea-add-comment-showPost" >
                        <textarea name="" id="add-comment${post.id_post}" oninput="check(${post.id_post});" placeholder="Ecrivez un commentaire ..."></textarea>
                    </section>
                </section>`

            /* Visualisation des commentaires */
            output += `
                <section class="container-comment-showPost" id="container-comment${post.id_post}">`
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
                    `
                });
                output +=`
                </section>`
            }

            /* Intégration de la section post*/
            let postShowNode = document.createElement('section')
            postShowNode.classList.add('showOnePost')
            postShowNode.innerHTML = output
            showPostsMur.append(postShowNode)

            /* Ecrire un commentaire et le poster */
            textareaComment = document.querySelector("#add-comment" + post.id_post)
            textareaComment.addEventListener("keydown", function (e) {
                if (e.keyCode == 13 && !e.shiftKey) {
                    e.preventDefault()
                    textValue = textareaComment.value

                    if (textValue.length > 0) {
                        let data = {
                            id_post: post.id_post,
                            text_comment: textValue
                        }
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "api/controllers/addPostComment.php");
                        xhr.setRequestHeader("Content-Type", "text/plain");
                        xhr.responseType = "json";
                        xhr.send(JSON.stringify(data));
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 || xhr.status == 201) {
                                user = xhr.response
                                /* Affichage du commentaire */
                                newComment = document.createElement('section')
                                newComment.classList.add('view-comment-showPost')
                                newComment.innerHTML = `
                                
                                    <section class="user-photo-comment-showPost">
                                        <img src="assets/images/upload/users/${user.avatar}" alt="avatar">
                                    </section>
                                    <section class="name-date-text-comment-showPost">
                                        <section class="user-name-showPost">
                                            ${user.lastname} ${user.name}
                                        </section>
                                        <section class="date-comment-showPost">
                                            ${user.date_comment}
                                        </section>                    
                                        <section class="text-comment-showPost">
                                            ${user.text}
                                        </section>
                                    </section>
                                
                                `  
                                elementParent = document.querySelector("#container-comment" + post.id_post)
                                elementParent.prepend(newComment)

                            }
                        }

                        /* Vidage du textarea */
                        this.value = ''

                       /*  Modification du nombre de commentaires */
                       let countComment = document.querySelector("#commentCount" + post.id_post)
                       if (post.countComment == 0) {
                           
                            countComment.innerHTML = "1 commentaire"
                       }
                       else {
                            post.countComment++
                            countComment.innerHTML = "<span>" + post.countComment + "</span> commentaires"
                       }                      
                    }
                }
            })

            /* Bouton commenter */
            boutonCommenter = document.querySelector("#comment-action" + post.id_post)
            boutonCommenter.addEventListener("click", function(e) {
                ShowHiddenTextarea = document.querySelector("#add-comment" + post.id_post)
    
                if (ShowHiddenTextarea.classList.contains("show")) {
                    ShowHiddenTextarea.classList.remove("show")
                }
                else {
                    ShowHiddenTextarea.classList.add("show")
                    ShowHiddenTextareaFocus = document.querySelector(`#add-comment${post.id_post} textarea`)
                    ShowHiddenTextareaFocus.focus()
                }
            })

            /* Bouton du nombre de commentaires */
            BoutonNbCommentaires = document.querySelector(`#commentCount${post.id_post}`)
            BoutonNbCommentaires.addEventListener("click", function(e) {
            showHiddenComment = document.querySelector("#container-comment" + post.id_post)
            ShowHiddenTextarea = document.querySelector("#add-comment" + post.id_post)

                if (showHiddenComment.classList.contains("show")) {
                    showHiddenComment.classList.remove("show")
                    ShowHiddenTextarea.classList.remove("show")
                }
                else {
                    showHiddenComment.classList.add("show")
                    ShowHiddenTextarea.classList.add("show")
                    
                }
            })
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

/* Function Like */
function likeShowPost(like, dislike, post_id) {

    if (like === 0) {
        if (dislike === 0) {

            Like = 1
            Dislike = 0

            sectionLike = document.querySelector("#like" + post_id)
            sectionLike.removeAttribute("onclick")
            sectionLike.setAttribute("onclick", "likeShowPost(1, 0, " + post_id + ")")

            sectionDislike = document.querySelector("#dislike" + post_id)
            sectionDislike.removeAttribute("onclick")
            sectionDislike.setAttribute("onclick", "dislikeShowPost(1, 0, " + post_id + ")")

            sectionLike.classList.add("validate")
            countLike = document.querySelector("#likeCount" + post_id + " span")
            valueLike = countLike.textContent
            valueLike++
            countLike.textContent = valueLike
        }

        if (dislike === 1) {
            Like = 1
            Dislike = -1

            sectionLike = document.querySelector("#like" + post_id)
            sectionLike.removeAttribute("onclick")
            sectionLike.setAttribute("onclick", "likeShowPost(1, 0, " + post_id + ")")

            sectionDislike = document.querySelector("#dislike" + post_id)
            sectionDislike.removeAttribute("onclick")
            sectionDislike.setAttribute("onclick", "dislikeShowPost(1, 0, " + post_id + ")")

            sectionLike.classList.add("validate")
            sectionDislike.classList.remove("validate")

            countLike = document.querySelector("#likeCount" + post_id + " span")
            valueLike = countLike.textContent
            valueLike++
            countLike.textContent = valueLike

            countDislike = document.querySelector("#dislikeCount" + post_id + " span")
            valueDislike = countDislike.textContent
            valueDislike = valueDislike - 1
            countDislike.textContent = valueDislike
        }
    }
    if (like === 1) {
        Like = -1
        Dislike = 0

        sectionLike = document.querySelector("#like" + post_id)
        sectionLike.removeAttribute("onclick")
        sectionLike.setAttribute("onclick", "likeShowPost(0, 0, " + post_id + ")")

        sectionDislike = document.querySelector("#dislike" + post_id)
        sectionDislike.removeAttribute("onclick")
        sectionDislike.setAttribute("onclick", "dislikeShowPost(0, 0, " + post_id + ")")

        sectionLike.classList.remove("validate")
        countLike = document.querySelector("#likeCount" + post_id + " span")
        valueLike = countLike.textContent
        valueLike = valueLike - 1
        countLike.textContent = valueLike

    }
    let data = {
        bdLike: Like,
        bdDislike: Dislike,
        post: post_id
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/likePost.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.responseType = "json";
    xhr.send(JSON.stringify(data));
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 || xhr.status == 201) {
            console.log(xhr.response)
        }
    }


}

/* Function dislike */
function dislikeShowPost(like, dislike, post_id) {
    if (dislike === 0) {
        if (like === 0) {

            Like = 0
            Dislike = 1

            sectionDislike = document.querySelector("#dislike" + post_id)
            sectionDislike.removeAttribute("onclick")
            sectionDislike.setAttribute("onclick", "dislikeShowPost(0, 1, " + post_id + ")")

            sectionLike = document.querySelector("#like" + post_id)
            sectionLike.removeAttribute("onclick")
            sectionLike.setAttribute("onclick", "likeShowPost(0, 1, " + post_id + ")")

            sectionDislike.classList.add("validate")
            countDislike = document.querySelector("#dislikeCount" + post_id + " span")
            valueDislike = countDislike.textContent
            valueDislike++
            countDislike.textContent = valueDislike
        }

        if (like === 1) {
            Like = -1
            Dislike = 1

            sectionLike = document.querySelector("#like" + post_id)
            sectionLike.removeAttribute("onclick")
            sectionLike.setAttribute("onclick", "likeShowPost(0, 1, " + post_id + ")")

            sectionDislike = document.querySelector("#dislike" + post_id)
            sectionDislike.removeAttribute("onclick")
            sectionDislike.setAttribute("onclick", "dislikeShowPost(0, 1, " + post_id + ")")

            sectionLike.classList.remove("validate")
            sectionDislike.classList.add("validate")

            countLike = document.querySelector("#likeCount" + post_id + " span")
            valueLike = countLike.textContent
            valueLike = valueLike - 1
            countLike.textContent = valueLike

            countDislike = document.querySelector("#dislikeCount" + post_id + " span")
            valueDislike = countDislike.textContent
            valueDislike++
            countDislike.textContent = valueDislike
        }
    }

    if (dislike === 1) {
        Like = 0
        Dislike = -1

        sectionDislike = document.querySelector("#dislike" + post_id)
        sectionDislike.removeAttribute("onclick")
        sectionDislike.setAttribute("onclick", "dislikeShowPost(0, 0, " + post_id + ")")

        sectionLike = document.querySelector("#like" + post_id)
        sectionLike.removeAttribute("onclick")
        sectionLike.setAttribute("onclick", "likeShowPost(0, 0, " + post_id + ")")

        sectionDislike.classList.remove("validate")
        countDislike = document.querySelector("#dislikeCount" + post_id + " span")
        valueDislike = countDislike.textContent
        valueDislike = valueDislike - 1
        countDislike.textContent = valueDislike
    }

    let data = {
        bdLike: Like,
        bdDislike: Dislike,
        post: post_id
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/likePost.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.responseType = "json";
    xhr.send(JSON.stringify(data));
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 || xhr.status == 201) {
            console.log(xhr.response)
        }
    }
}