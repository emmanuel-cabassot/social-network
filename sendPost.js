let user = document.querySelector('#idUser')
user = 1
                    /* APPARATION ET DISPARITION DE LA MODALE */
lienModale = document.querySelectorAll('.sendPost [data-modale]')

lienModale.forEach(ouvertureModale => {
    ouvertureModale.addEventListener("click", function (e) {
        // On empêche la navigation
        e.preventDefault();
        modale = document.querySelector(".container-modale-sendPost")
        modale.classList.add("show");

        // On récupère le bouton de fermeture
        const modalClose = document.querySelector("[data-dismiss=dialog]");
        modalClose.addEventListener("click", function (e) {
            e.preventDefault();
            // attention ici il faudra supprimer les images ou videos dans le dossier temporaire
            modale.classList.remove("show");          
        });       
    })
})

// Fait apparaitre le drag and drop de l'image
let ajouterPhoto = document.querySelector('#ajouterPhoto-sendPost')
var uploadImages = document.querySelector('.upload-images')

ajouterPhoto.addEventListener("click", function(e) {   
    uploadImages.classList.toggle("show")
})

submitPhoto = document.querySelector('#submit-photo')
submitPhoto.addEventListener("click", function(e) {
    uploadImages.classList.remove("show")
})

// Fait apparaitre le drag and drop de la vidéo
ajouterVideo = document.querySelector('#ajouterVideo-sendPost')
uploadVideo = document.querySelector('.upload-video')

ajouterVideo.addEventListener("click", function(e) {
    uploadVideo.classList.toggle("show")
})

submitVideo = document.querySelector('#submit-video')
submitVideo.addEventListener("click", function(e) {
    uploadVideo.classList.remove("show")
})


                    /* CYCLE D'UNE IMAGE */
// Dropzone options pour les images
Dropzone.options.dropzoneFromImages = {
    autoProcessQueue: false,
    dictDefaultMessage: 'Cliquez ou déposez vos images(max 5)',
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init: function () {
        // Le bouton de téléchargement des images
        var submitButton = document.querySelector('#submit-photo');
        myDropzone = this;
        submitButton.addEventListener("click", function () {
            myDropzone.processQueue();
        });
        this.on("complete", function () {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                _this.removeAllFiles();
            }
            list_image();
        });
    },
};

// Fonction qui affiche les photos dans la div #preview
function list_image() {
    $.ajax({
        url: "uploadTempPost.php",
        success: function (data) {
            $('#preview').html(data);
        }
    });
}

// Bouton de suppression de l'image déjà téléchargé
$(document).on('click', '.remove_image', function () {
    console.log("ca marche")
    var name = $(this).attr('id');
    $.ajax({
        // Adresse du traitement de l'image
        url: "uploadTempPost.php",
        method: "POST",
        data: { name: name },
        success: function (data) {
            list_image();
        }
    })
});

                        /* CYCLE D'UNE VIDEO */
// Dropzone options pour la vidéo
Dropzone.options.dropzoneFromVideo = {
    autoProcessQueue: false,
    dictDefaultMessage: 'Cliquez ou déposez votre vidéo',
    acceptedFiles: ".mp4",
    init: function () {
        // Le bouton de téléchargement des images
        var submitButtonVideo = document.querySelector('#submit-video');
        myDropzoneVideo = this;
        submitButtonVideo.addEventListener("click", function () {
            myDropzoneVideo.processQueue();
        });
        this.on("complete", function () {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                _this.removeAllFiles();
            }
            list_video();
        });
    },
};

// Fonction qui affiche la video
function list_video() {
    $.ajax({
        url: "uploadTempPostVideo.php",
        success: function (data) {
            $('#preview-video').html(data);
        }
    });
}

// Bouton de suppression de la vidéo déjà téléchargé
$(document).on('click', '.remove_video', function () {
    var name = $(this).attr('id');
    $.ajax({
        // Adresse du traitement de l'image
        url: "uploadTempPostVideo.php",
        method: "POST",
        data: { name: name },
        success: function (data) {
            list_video();
        }
    })
});


                        /* PUBLICATION D'UN POST */
const publier = document.querySelector('.publier-sendPost button')

publier.addEventListener("click", function (e) {
    // Valeur du textarea
    let myContent = tinymce.get("TextareaPostSend").getContent();

    // Il y a t'il une photo d'enregistréé et ou une video
    let photo = document.querySelector('#preview').hasChildNodes()
    console.log(photo)
    let video = document.querySelector('#preview-video').hasChildNodes()
    console.log(video)
    if (photo == false) {
        photo = 'non'
    }
    else {
        photo = 'oui'
    }
    if (video == false) {
        video = 'non'
    }
    else {
        video = 'oui'
    }
    data = {
        user: user,
        texte: myContent,
        photo: photo,
        video: video
    }
    data = JSON.stringify(data);
    console.log(data)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/postSend.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.send(data);
})


// Ceci sera pour afficher les posts d'un user
data = {
    user: user,
}
data = JSON.stringify(data);

var xhr = new XMLHttpRequest();
xhr.open("POST", "api/controllers/affichePostUser.php");
xhr.setRequestHeader("Content-Type", "text/plain");
xhr.send(data);
