function showPost() {

    user = document.querySelector("#idUser")
    user = user.value

    fil = document.querySelector("#filActualite")
    fil = fil.value

    data = {
        user: user,
        fil: fil
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./api/controllers/postShow.php");
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
                    <section class="user-showPost" id="user_showPost${post.id_post}">               
                        <section class="avatar-user-showPost">
                            <img src="assets/images/upload/users/${post.userAvatar}" alt="avatar">
                        </section>
                        <section class="nameDate-showPost">
                            <div class="name-showPost">${post.userLastname} ${post.userName}</div>
                            <div class="datePost-showPost">${post.date_post}</div>
                        </section>        
                    </section>
                    <section class="modify-showPost" id="modify-showPost${post.id_post}">
                        <span>...</span>
                    </section>`;

                if (post.story_post == 'oui') {
                    output += `
                    <section class="story-showPost">
                        <span>Story</span>
                    </section>`
                }

                if (post.myPost == 'oui') {
                    output += `
                <section class="modify-showPost-option" id="modify-showPost-option${post.id_post}">
                    <span>Supprimer</span>
                </section>`;
                } else {
                    output += `
                <section class="modify-showPost-option" id="modify-showPost-option${post.id_post}">
                    <span>Signaler</span>
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
                        <textarea name="" id="add-comment-textarea${post.id_post}" oninput="check(${post.id_post});" placeholder="Ecrivez un commentaire ..."></textarea>
                    </section>
                </section>`

                /* Visualisation des commentaires */
                output += `
                <section class="container-comment-showPost" id="container-comment${post.id_post}">`
                if (post.countComment > 0) {
                    comments = post.comments
                    comments.forEach(comment => {
                        output += `
                    <section class="view-comment-showPost" id="view-comment-showPost${post.id_post}-${comment.id_comment_post}">
                        <section class="user-photo-comment-showPost" id="user-photo-comment-showPost${post.id_post}-${comment.id_comment_post}">
                            <img src="assets/images/upload/users/${comment.userAvatar}" alt="avatar">
                        </section>
                        <section class="name-date-text-comment-showPost" id="name-date-text-comment-showPost${post.id_post}-${comment.id_comment_post}">
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
                        <section class="option-comment-showPost" id="option-comment${post.id_post}-${comment.id_comment_post}">
                            <img src="assets/images/3pts.png" alt="3 points">
                        </section>`;

                        if (user == comment.id_user) {
                            output += `
                            <section class="option-comment-click" id="option-comment-click${post.id_post}-${comment.id_comment_post}">
                                Supprimer
                            </section>
                            </section>`;
                        } else {
                            output += `
                            <section class="option-comment-click" id="option-comment-click${post.id_post}-${comment.id_comment_post}">
                                Signaler
                            </section>
                            </section>`;
                        }

                    });
                    output += `
                </section>`
                }

                /* INTEGRATION DE LA SECTION VOIR UN POST*/
                let postShowNode = document.createElement('section')
                postShowNode.classList.add('showOnePost')
                postShowNode.id = "showOnePost" + post.id_post
                postShowNode.innerHTML = output
                showPostsMur.append(postShowNode)

                /* Creer un lien vers ajouter un ami en cliquant sur l'image du poster */
                userSection = document.querySelector("#user_showPost" + post.id_post)
                userSection.addEventListener("click", function (e) {
                    document.location.href = "viewFriend.php?id_friend=" + post.id_user;
                })

                /* Options du post 'supprimer ou signaler' */
                optionPost = document.querySelector("#modify-showPost" + post.id_post)
                optionPost.addEventListener("click", function (e) {
                    optionClick = document.querySelector("#modify-showPost-option" + post.id_post)
                    optionClick.classList.toggle("show");

                    function hiddenOptionClick() {
                        optionClick.classList.remove("show")
                    }
                    setTimeout(hiddenOptionClick, 4000);

                    optionClick.addEventListener("click", function (e) {

                        if (post.myPost == 'oui') {
                            textConfirm = "Voulez-vous supprimer votre post?"
                            data = {
                                supprimer: 'oui',
                                id_post: post.id_post
                            }
                        } else {
                            textConfirm = "Voulez-vous signaler ce post?"
                            data = {
                                signaler: 'oui',
                                id_post: post.id_post
                            }
                        }

                        if (confirm(textConfirm)) {
                            if (textConfirm == "Voulez-vous supprimer votre post?") {
                                addClassHidden = document.querySelector("#showOnePost" + post.id_post)
                                addClassHidden.classList.add("hidden")
                            }
                            let xhr = new XMLHttpRequest();
                            xhr.open("POST", "api/controllers/deleteSignalerPost.php");
                            xhr.setRequestHeader("Content-Type", "text/plain");
                            xhr.responseType = "json";
                            xhr.send(JSON.stringify(data));
                        }


                    })

                })

                /* Ecrire un commentaire et le poster */
                textareaComment = document.querySelector(`#add-comment-textarea${post.id_post}`)
                textareaComment.addEventListener("keydown", function (e) {
                    if (e.keyCode == 13 && !e.shiftKey) {
                        e.preventDefault()
                        textValue = this.value

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
                                            A l'instant
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

                            /* Vidage du textarea après envoie du commentaire */
                            this.value = ''

                            let showHiddenComment = document.querySelector("#container-comment" + post.id_post)
                            if (!showHiddenComment.classList.contains("show")) {
                                showHiddenComment.classList.add("show")
                            }

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
                boutonCommenter.addEventListener("click", function (e) {
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
                BoutonNbCommentaires.addEventListener("click", function (e) {
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
                if (post.countComment > 0) {

                    postComments = post.comments
                    postComments.forEach(comment => {
                        /* Créer les liens des avatars des comments qui vont a ajouter amis */
                        avatarUserComment = document.querySelector("#user-photo-comment-showPost" + post.id_post + "-" + comment.id_comment_post)
                        avatarUserComment.addEventListener("click", function (e) {
                            document.location.href = "viewFriend.php?id_friend=" + post.id_user;
                        })

                        /* Apparition des 3 petits points au survol du commentaire */
                        survolComment = document.querySelector("#view-comment-showPost" + post.id_post + "-" + comment.id_comment_post)
                        survolComment.addEventListener("mouseover", function (e) {
                            points = document.querySelector("#option-comment" + post.id_post + "-" + comment.id_comment_post)
                            points.classList.add("show")
                        })
                        survolComment.addEventListener("mouseout", function (e) {
                            points = document.querySelector("#option-comment" + post.id_post + "-" + comment.id_comment_post)
                            points.classList.remove("show")
                        })

                        /* Au click sur les 3 petits points apparition du signaler */
                        points = document.querySelector("#option-comment" + post.id_post + "-" + comment.id_comment_post)
                        points.addEventListener("click", function (e) {
                            apparition = document.querySelector("#option-comment-click" + post.id_post + "-" + comment.id_comment_post)
                            apparition.classList.toggle("show")

                            function hiddenOptionClick() {
                                apparition.classList.remove("show")
                            }
                            setTimeout(hiddenOptionClick, 2500);

                            apparition.addEventListener("click", function (e) {

                                if (user == comment.id_user) {
                                    textConfirm = "Voulez-vous supprimer votre commentaire?"
                                    data = {
                                        supprimer: 'oui',
                                        id_comment: comment.id_comment_post
                                    }
                                } else {
                                    textConfirm = "Voulez-vous signaler ce commentaire?"
                                    data = {
                                        signaler: 'oui',
                                        id_comment: comment.id_comment_post
                                    }
                                }

                                if (confirm(textConfirm)) {
                                    if (textConfirm == "Voulez-vous supprimer votre commentaire?") {
                                        hiddenCommentaire = document.querySelector("#view-comment-showPost" + post.id_post + "-" + comment.id_comment_post)
                                        hiddenCommentaire.classList.add("hidden")
                                    }
                                    let xhr = new XMLHttpRequest();
                                    xhr.open("POST", "api/controllers/deleteSignalerComment.php");
                                    xhr.setRequestHeader("Content-Type", "text/plain");
                                    xhr.responseType = "json";
                                    xhr.send(JSON.stringify(data));
                                }


                            })
                        })

                    });
                }
            });
        }
    }

    // likeShowPost(like, dislike, post_id)

    // dislikeShowPost(like, dislike, post_id)

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

/* Hauteur du textarea 'ecrire un comment' */
function check(id_post) {
    let hauteur = document.querySelector("#add-comment-textarea" + id_post).scrollHeight
    let val = document.querySelector("#add-comment-textarea" + id_post).value

    if (val === "") {
        document.querySelector("#add-comment-textarea" + id_post).style.height = '38px';
    } else {
        document.querySelector("#add-comment-textarea" + id_post).style.height = hauteur + 'px';
    }
}

filButton = document.querySelector(".bi-camera-video")
filButton.addEventListener("click", function (e) {
    this.classList.add("active")
    showPostsMur = document.querySelector(".showPostsMur")
    showPostsMur.innerHTML = "";
    showPost()
})

showPost()

