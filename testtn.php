<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Plateforme_ Network</title>
    <meta name="description" content="Reseau Social pour La Plateforme_." />
    <meta name="keywords" content="stories, posts, social network, followers, réseau social, La Plateforme_, plateformeurs" />
    <meta name="author" content="Denis Farkas Emmanuel Cabassot Thuc-nhi Wiedenhofer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/sendPost.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <a class="navbar-brand" href="#"><img src="assets/images/logo.png" alt="logo" class="logo-img-thumb"></a>


            <div class="collapse navbar-collapse" id="navbarColor03">

                <input class="form-control mr-sm-2 w-25" type="text" name="main-search" id="main-search" placeholder="Nom du contact">

                <div id="search-show">
                    <div class="nav nav-pills navbar-light flex-column">
                        <div class="search-result"></div>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto display-5">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="bi bi-house mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-three-dots mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-camera-video mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person-circle mr-3"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-5">
        <div class="row d-flex">
            <div class="col-xl-3">
                <section class="alert alert-light">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link alert alert-dismissible alert-primary" href="groups.php">Groupes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link alert alert-dismissible alert-primary" href="events.php">Evènements</a>
                        </li>
                    </ul>
                </section>
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Suggestion Évènements<button type="button" class="btn btn-secondary btn-sm float-right">Voir ...</button></div>
                        <div id="suggestedEvent"></div>
                    </div>
                </section>
            </div>
            <div class="col-xl-6 col-sm-12">
                <section class="sendPost">

                    <section class="text-sendPost mt-3 mb-3 " data-modale=<?= $_SESSION['id_user'] ?>>
                        <p class="ml-3"> Quoi de neuf emmanuel ?</p>
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
            </div>


            <div class="col-xl-3 col-sm-12">
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Suggestion d'amis<button type="button" class="btn btn-secondary btn-sm float-right">Voir ...</button></div>
                        <div id="suggestedFriend"></div>                        
                    </div>                    
                </section>
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Amis<button type="button" class="btn btn-secondary btn-sm float-right">Voir ...</button></div>
                        <div id="listFriends"></div>                        
                    </div>
                </section>
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Suggestion de groupes<button type="button" class="btn btn-secondary btn-sm float-right">Voir ...</button></div>
                        <div id="suggestedGroup"></div>                        
                    </div>
                </section>


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
                                    <form action="uploadTempPost.php" class="dropzone" id="dropzoneFromImages"></form>
                                    <button type="button" class="btn btn-primary w-100" id="submit-photo">Importer vos images</button>
                                </section>
                                <section class="upload-video w-100">
                                    <form action="uploadTempPostVideo.php" class="dropzone" id="dropzoneFromVideo"></form>
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
            </div>
        
    </main>
    <footer id="footer">
        <div class="col-lg-12">
        </div>
    </footer>
    <input type="hidden" id="idUser" value="1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('#TextareaPostSend').emojioneArea({
            pickerPosition: 'right',
        })
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="search.js"></script>
    <script src="homedenis.js"></script>
    <script src="sendPost.js"></script>



</body>

</html>
