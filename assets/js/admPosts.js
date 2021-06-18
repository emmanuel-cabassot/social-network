const listPosts = document.querySelector('#listPosts');

document.addEventListener("DOMContentLoaded", function () {
    listerPosts();
});

function listerPosts() {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var response = JSON.parse(xhr.responseText);
            var outputPost = '';
            
            response.forEach(post => {
                outputPost += `
                <section class="showOnePost col-xl-3 col-sm-6 col-xs-1">
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
                            
                        </section>
                    </section>
                        <section class="text-showPost">
                            ${post.text_post}
                        </section>
                    `;

                if (post.image_post == "oui") {
                    images = post.images
                    images.forEach(image => {
                        outputPost += `
                    <section class="media-showPost">
                        <img src=${image.chemin}/${image.name_image_post} alt=""></img>
                    </section>`
                    });
                }

                if (post.video_post == "oui") {
                    outputPost += `
                    <section class="media-showPost">
                        <video src=${post.cheminVideo}/${post.nomVideo} type="video/mp4" controls/>
                    </section>`
                }

                outputPost += `
                <section class="adminOptionPost d-flex">
                    <section class="supprime-adminOption" id="supprime-adminOption${post.id_post}">
                        Supprimer post
                    </section>
                    <section class="deleteSignal-adminOption" id="deleteSignal-adminOption${post.id_post}">
                        Désignaler post
                    </section>
                </section>
                <section class="adminOptionUser">
                    <section class="titre-adminOptionUser d-flex">
                        <section class="titre-blocked">
                            Blocked
                        </section>
                        <section class="titre-period_block">
                            Période
                        </section>
                    </section>
                    <section class="input-adminOptionUser d-flex">
                        <section class="blocked-adminOption">
                            <input id="blocked${post.id_post}" type="text" value="${post.blocked}">
                        </section>
                        <section class="period-adminOption">
                            <input id="date${post.id_post}" type="date" value="${post.period_block}"
                        </section>
                    </section>
                </section>
                <section class="submit-adminOption">
                    <input id="submit${post.id_post}" type="submit" value="submit">
                </section>
                </section>
                </section>`

            });

            listPosts.innerHTML = outputPost;

            /* Au click sur le submit on envoie les valeurs des inputs */
            records.forEach(post => {
                 submit = document.querySelector("#submit" + post.id_user) 
                 submit.addEventListener("click", function (e) {
                     blocked = document.querySelector("#blocked" + post.id_user)
                     blocked = blocked.value
                     date = document.querySelector("#date" + post.id_user)
                     date = date.value
     
                     data = {
                         role: role,
                         blocked: blocked,
                         date: date,
                         user: user.id_user
                     }
     
                     let xhrr = new XMLHttpRequest();
                     xhrr.open("POST", "api/controllers/modifPost.php");
                     xhrr.setRequestHeader("Content-Type", "text/plain");
                     xhrr.responseType = "json";
                     xhrr.send(JSON.stringify(data));
     
                     xhrr.addEventListener("readystatechange", function() {
                     if (xhrr.readyState === 4 && xhrr.status == 200) {
                         window.location.reload()
                     }
                 })
                 })  
            }); 

        } else if (this.readyState === 4 && this.status === 404) {
            listPosts.innerHTML = '<p>Pas de posts signalés</p>';
        }
    });
    xhr.open("POST", 'api/controllers/admPosts.php');
    xhr.send();
};