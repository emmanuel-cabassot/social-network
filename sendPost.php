<?php
session_start().
$_SESSION['user']['id'] = 4;
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

    <section class="module-sendPost col-xl-6">

        <section class="textarea">
            <h2 class="mb-3 mt-3"><i class="fas fa-pen"></i> Créer un post</h2>
            <div class="form-group">
                <textarea class="form-control" name="textarea" id="TextareaPostSend" rows="3" placeholder="Ecrivez votre post..."></textarea>
            </div>
        </section>
        <section class="boutons-sendPost row d-flex justify-content-between align-items-center mb-3">
            <div class="media-postSend">
                <a class="ml-3 mr-3" href=""><i class="fas fa-image text-success"></i> Image</a>
                <a href=""><i class="fas fa-video text-danger "></i> Vidéo</a>
            </div>
            <div class="publier-sendPost d-flex align-items-center mr-3">
                <button type="button" class="btn btn-primary">Publier</button>
            </div>
        </section>
    </section>
    <form action="uploadTempPost.php" class="dropzone" id="dropzoneFrom">

    </form>
    <div align="center">
        <button type="button" class="btn btn-info" id="submit-all">Télécharger</button>
    </div>
    <br />
    <br />
    <div id="preview"></div>
    <br />




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