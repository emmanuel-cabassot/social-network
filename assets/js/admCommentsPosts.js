listComments = document.querySelector("#listComments")

document.addEventListener("DOMContentLoaded", function () {
    listerComments();
});

function listerComments() {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var response = JSON.parse(xhr.responseText);
            var output = '';


            response.forEach(comment => {
                output += `
                <section class="comment-admComment col-xl-3 col-sm-6 col-xs-1" id="comment-admComment${comment.id_comment_post}">
                    <section class="header-admComment w-100">
                        <section class="user-admComment" id="user_showPost${comment.id_comment_post}">               
                            <section class="avatar-user-admComment">
                                <img src="assets/images/upload/users/${comment.userAvatar}" alt="avatar">
                            </section>
                            <section class="nameDate-admComment">
                                <div class="name-admComment">${comment.userLastname} ${comment.userName}</div>
                                <div class="datePost-admComment">${comment.date_comment_post}</div>
                            </section>        
                        </section>
                    </section>
                    <section class="text-showPost">
                            ${comment.text_comment_post}
                    </section>
                    <section class="legend-adminOptionComment">
                        Commentaire
                    </section>
                    <section class="adminOptionComment d-flex">
                        <section class="supprime-adminOption" id="supprime-adminOption${comment.id_comment_post}">
                            <span>&#128504</span>Supprimer
                        </section>
                        <section class="deleteSignal-adminOption" id="deleteSignal-adminOption${comment.id_comment_post}">
                            <span>&#128504</span>Désignaler
                        </section>
                    </section>
                    <section class="legend-adminOptionUser">
                        Utilisateur
                    </section>
                    <section class="adminOptionUser">
                        <section class="titre-adminOptionUser">
                            <section class="titre-blocked">
                                Blocked
                            </section>
                            <section class="titre-period_block">
                                Période
                            </section>
                        </section>
                        <section class="input-adminOptionUser">
                            <section class="blocked-adminOption">
                                <input id="blocked${comment.id_comment_post}" type="text" value="${comment.blocked}">
                            </section>
                            <section class="period-adminOption">
                                <input id="date${comment.id_comment_post}" type="date" value="${comment.period_block}"
                            </section>
                        </section>
                    </section>
                    <section class="submit-adminOption">
                        <input id="submit${comment.id_comment_post}" type="submit" value="Valider">
                    </section>
                </section>
                    
                    </section>`

            });

            listComments.innerHTML = output;

            response.forEach(comment => {
                supprimePost = listComments.querySelector("#supprime-adminOption" + comment.id_comment_post)
                deleteSignalPost = listComments.querySelector("#deleteSignal-adminOption" + comment.id_comment_post)
                
                deleteSignalPost.addEventListener("click", function (e) {
                
                    this.classList.toggle("valide")
                    
                    supprime = listComments.querySelector("#supprime-adminOption" + comment.id_comment_post)
                    if (supprime.classList.contains("valide")) {
                        supprime.classList.remove("valide")
                    }
                })

                supprimePost.addEventListener("click", function (e) {
                    this.classList.toggle("valide")

                    signal = listComments.querySelector("#deleteSignal-adminOption" + comment.id_comment_post)
                    if (signal.classList.contains("valide")) {
                        signal.classList.remove("valide")
                    }
                })

        

                 submit = listComments.querySelector("#submit" + comment.id_comment_post) 
                 submit.addEventListener("click", function (e) {
                    supprimePost = listComments.querySelector("#supprime-adminOption" + comment.id_comment_post)
                     if (supprimePost.classList.contains("valide")) {
                         supprime = 'oui'
                     }else {
                         supprime = 'non'
                     }

                     deleteSignalPost = listComments.querySelector("#deleteSignal-adminOption" + comment.id_comment_post)
                     if (deleteSignalPost.classList.contains("valide")) {
                         deleteSignal = 'oui'
                     }else {
                         deleteSignal = 'non'
                     }

                     blocked = listComments.querySelector("#blocked" + comment.id_comment_post)
                     blocked = blocked.value
                     
                     date = listComments.querySelector("#date" + comment.id_comment_post)
                     date = date.value
                     
                     data = {
                         supprime: supprime,
                         deleteSignal: deleteSignal,
                         blocked: blocked,
                         date: date,
                         comment: comment.id_comment_post,
                         user: comment.id_user
                     }
                     
                     let xhrr = new XMLHttpRequest();
                     xhrr.open("POST", "api/controllers/modifCommentPost.php");
                     xhrr.setRequestHeader("Content-Type", "text/plain");
                     xhrr.responseType = "json";
                     xhrr.send(JSON.stringify(data));
     
                     xhrr.addEventListener("readystatechange", function() {
                     if (xhrr.readyState === 4 && xhrr.status == 200) {
                         listComments.innerHTML = ""
                         listerComments();

                     }
                 })
                 })   
            }); 

        }
    });
    xhr.open("POST", 'api/controllers/admCommentsPosts.php');
    xhr.send();
};