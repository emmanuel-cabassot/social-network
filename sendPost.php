<?php
session_start() .
    $_SESSION['user']['id'] = 4;
$prenom = 'emmanuel';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/sendPost.css">
</head>

<body>
    <header>header</header>
    <main>
        <section class="sendPost">
            <section class="text-sendPost mt-3 mb-3 " data-modale=<?= $_SESSION['user']['id'] ?>>
                <p class="ml-3"> Quoi de neuf <?= $prenom ?>?</p>
            </section>
            <div class="separation-sendPost"></div>
            <section class="media-sendPost">
                <section class="story-media-sendPost" data-modale=<?= $_SESSION['user']['id'] ?>>
                    <section class="bg-story-media-sendPost">
                    </section>
                    <section class="text-media-sendPost">
                        Story
                    </section>
                </section>
                <section class="img-media-sendPost" data-modale=<?= $_SESSION['user']['id'] ?>>
                    <section class="bg-img-media-sendPost">
                    </section>
                    <section class="text-media-sendPost">
                        Photo/Vidéo
                    </section>
                </section>
                <section class="humeur-media-sendPost" data-modale=<?= $_SESSION['user']['id'] ?>>
                    <section class="bg-humeur-media-sendPost">
                    </section>
                    <section class="text-media-sendPost">
                        Humeur
                    </section>
                </section>
            </section>

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
                    <section class="media-module-sendPost row d-flex justify-content-around align-items-center mb-3">
                        <section class="video-media-senPost" id="ajouterVideo-sendPost">
                            <section class="bg-video-media-sendPost">
                            </section>
                            <section class="text-media-sendPost ml-2">
                                Vidéo
                            </section>
                        </section>

                        <section class="img-media-sendPost" id="ajouterPhoto-sendPost">
                            <section class="bg-img-media-sendPost">
                            </section>
                            <section class="text-media-sendPost">
                                Photo
                            </section>
                        </section>

                        <section class="story-media-sendPost" id="ajouterStory-sendPost">
                            <section class="bg-story-media-sendPost">
                            </section>
                            <section class="text-media-sendPost">
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

    </main>

    <input type="hidden" id="idUser" value="1">
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="sendPost.js"></script>

    <!-- Cdn tiny(emoticons) -->
    <script src="https://cdn.tiny.cloud/1/ay5vy2ra44vfm2dcmlr503ovh79cv2773fro6qqs982e5o5t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#TextareaPostSend',
            plugins: "emoticons",
            toolbar: "emoticons",
            toolbar_location: "bottom",
            menubar: false,
            branding: false,
            statusbar: false,
            height: 120,
            language: 'fr_FR',
            content_style: "body { line-height: .4; }"
        });
    </script>
</body>

</html>