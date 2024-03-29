<?php require("../includes/header.php") ?>

<main class="container-fluid mt-5">
    <div class="row d-flex">
        <!-- aside left -->
        <div class="col-xl-3" id="asideLeft">
            <section class="alert alert-light" id="asideLeftTop">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="groups.php">Groupes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events.php">Evènements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="friends.php">Amis</a>
                    </li>
                </ul>
            </section>
            <section class="alert alert-light" id="asideLeftBottom">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion Evènements

                        <a href="events.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                    </div>
                    <div id="suggestedEvent"></div>
                </div>
            </section>
        </div>
        <!-- End aside left -->
        <!-- send post -->
        <div class="col-xl-6 col-sm-12 ">
            <section class="sendPost">
                <section class="text-sendPost mt-3 mb-3 " data-modale=<?= $_SESSION['id_user'] ?>>
                    <p class="ml-3"> Quoi de neuf <?php echo $_SESSION['name'] ?>?</p>
                </section>
                <div class="separation-sendPost"></div>
                <section class="media-sendPost">
                    <section class="story-media-sendPost" data-modale=<?= $_SESSION['id_user'] ?>>
                        <section class="bg-story-media-sendPost">
                        </section>
                        <section class="text-media-sendPost">
                            Story
                        </section>
                    </section>
                    <section class="img-media-sendPost" data-modale=<?= $_SESSION['id_user'] ?>>
                        <section class="bg-img-media-sendPost">
                        </section>
                        <section class="text-media-sendPost">
                            Photo/Vidéo
                        </section>
                    </section>
                    <section class="humeur-media-sendPost" data-modale=<?= $_SESSION['id_user'] ?>>
                        <section class="bg-humeur-media-sendPost">
                        </section>
                        <section class="text-media-sendPost">
                            Humeur
                        </section>
                    </section>
                </section>
            </section>
            <!-- End send post -->
            <!-- modale send post -->
            <section class="container-modale-sendPost">
                <section class="modale-sendPost">
                    <header class="header-modale-sendPost">
                        <h1> Créer une publication</h2>
                            <div class="fermeture-modal-close" data-dismiss="dialog">&#10006</div>
                    </header>
                    <main class="main-modale-sendPost">
                        <section class="textarea">
                            <div class="form-group">
                                <textarea name="textarea" id="TextareaPostSend" placeholder="Ecrivez votre post..."></textarea>
                            </div>
                            <section class="preview-sendPost">
                                <div id="preview"></div>
                                <div id="preview-video"></div>
                            </section>
                            <section class="upload-images w-100">
                                <form action="../api/controllers/uploadTempPost.php" class="dropzone" id="dropzoneFromImages"></form>
                                <button type="button" class="btn btn-primary w-100" id="submit-photo">Importer vos images</button>
                            </section>
                            <section class="upload-video w-100">
                                <form action="../uploadTempPostVideo.php" class="dropzone" id="dropzoneFromVideo"></form>
                                <button type="button" class="btn btn-primary w-100" id="submit-video">Importer votre vidéo</button>
                            </section>
                        </section>
                        <section class="media-module-sendPost row d-flex justify-content-around align-items-center mb-2 mt-2">
                            <section class="video-media-senPost" id="ajouterVideo-sendPost">
                                <section class="bg-video-media-sendPost">
                                </section>
                                <section class="text-media-sendPost ml-2">
                                    Vidéo
                                </section>
                            </section>

                            <section class="image-media-sendPost" id="ajouterPhoto-sendPost">
                                <section class="bg-image-media-sendPost">
                                </section>
                                <section class="text-media-sendPost">
                                    Photo
                                </section>
                            </section>

                            <section class="button-story-media-sendPost" id="ajouterStory-sendPost">
                                <section class="bg-button-story-media-sendPost">
                                </section>
                                <section class="button-text-media-sendPost">
                                    Story
                                </section>
                            </section>
                        </section>
                        <section class="publier-sendPost w-100">
                            <button type="button" class="btn btn-primary w-100">Publier</button>
                        </section>
                    </main>
                </section>
            </section>
            <!-- end modale send post -->
            <!-- show posts -->
            <section class="showPostsMur">
            </section>
            <!-- End show posts -->
        </div>
        <!-- aside right -->
        <div class="col-xl-3 col-sm-12" id="asideRight">
            <section class="alert alert-light">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion d'amis
                        <a href="friends.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                    </div>
                    <div id="suggestedFriend"></div>
                </div>
            </section>
            <section class="alert alert-light">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Amis
                        <a href="friends.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                    </div>
                    <div id="listFriends"></div>
                </div>
            </section>
            <section class="alert alert-light">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion de groupes
                        <a href="groups.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                    </div>
                    <div id="suggestedGroup"></div>
                </div>
            </section>
        </div>
        <!-- End aside right -->
    </div>
</main>
<footer id="footer">
    <div class="col-lg-12">
    </div>
</footer>
<input type="hidden" id="idUser" value="<?= $_SESSION['id_user'] ?>">
<input type="hidden" id="filActualite" value="non">
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $('#TextareaPostSend').emojioneArea({
        pickerPosition: 'right',
    })
</script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/search.js"></script>
<script src="../assets/js/suggestGroupAside.js"></script>
<script src="../assets/js/suggestEventAside.js"></script>
<script src="../assets/js/suggestFriendAside.js"></script>
<script src="../assets/js/listerFriendsAside.js"></script>
<script src="../assets/js/sendPost.js"></script>
<script src="../assets/js/murPost.js"></script>

</body>

</html>