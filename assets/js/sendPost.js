let user = document.querySelector('#idUser')
user = user.value

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
            let photo = document.querySelector('#preview').hasChildNodes()
            let video = document.querySelector('#preview-video').hasChildNodes()
            let myContent = $("#TextareaPostSend").data("emojioneArea").getText();
            console.log(myContent)

            if (photo === true || video === true || myContent != "") {
                if (confirm('Vous n’avez pas encore partagé votre publication. Voulez-vous vraiment quitter sans publier ?'))
                    if (myContent != "") {
                        $("#TextareaPostSend").data("emojioneArea").setText("")
                    }

                if (photo === true) {
                    data = 'oui'
                    $.ajax({
                        // Adresse du traitement pour supprimer l'image du dossier temporaire
                        url: "../api/controllers/uploadTempPost.php",
                        method: "POST",
                        data: { supprime: data },
                        success: function (data) {

                        }
                    })
                    // Suppression des images visibles dans preview
                    document.querySelector('#preview').innerHTML = "";
                }

                if (video === true) {
                    data = 'oui'
                    $.ajax({
                        // Adresse du traitement pour supprimer la video du dossier temporaire
                        url: "../api/controllers/uploadTempPostVideo.php",
                        method: "POST",
                        data: { supprime: data },
                        success: function (data) {

                        }
                    })
                    // Suppression de la video visible dans preview
                    document.querySelector('#preview-video').innerHTML = "";
                }

                iconeImage = document.querySelector('#ajouterPhoto-sendPost')
                if (iconeImage.classList.contains("hidden") == true) {
                    iconeImage.classList.remove("hidden")
                }
                iconeVideo = document.querySelector('#ajouterVideo-sendPost')
                if (iconeVideo.classList.contains("hidden") == true) {
                    iconeVideo.classList.remove('hidden')
                }
                modale.classList.remove("show");
            }
            else {
                modale.classList.remove("show");
            }

        });
        let exists = !!document.querySelector(".button-story-media-sendPost .validation-story");
        if (exists) {
            let deleteValidation = document.querySelector(".validation-story");
            deleteValidation.remove();
            buttonStory.classList.remove("validate")
        }
    })
})

// Fait apparaitre le drag and drop de l'image
let ajouterPhoto = document.querySelector('#ajouterPhoto-sendPost')
var uploadImages = document.querySelector('.upload-images')

// Au click sur l'icone story 
let buttonStory = document.querySelector(".button-story-media-sendPost")
buttonStory.addEventListener("click", function (e) {
    let exists = !!document.querySelector(".button-story-media-sendPost .validation-story");
    if (exists) {
        let deleteValidation = document.querySelector(".validation-story");
        deleteValidation.remove();
        buttonStory.classList.remove("validate")
    }
    else {
        referenceNode = document.querySelector(".button-text-media-sendPost")
        validationStory = document.createElement("section")
        validationStory.classList.add("validation-story")
        validationStory.innerHTML = "&#x2714"
        buttonStory.insertBefore(validationStory, referenceNode.nextSibling)
        buttonStory.classList.add("validate")
    }


})

// Au click sur l'icone photo on ajoute la classe hidden à l'icone de la vidéo
ajouterPhoto.addEventListener("click", function (e) {
    uploadImages.classList.toggle("show")
    document.querySelector('.preview-sendPost').classList.add('hidden')
})

submitPhoto = document.querySelector('#submit-photo')
submitPhoto.addEventListener("click", function (e) {
    uploadImages.classList.remove("show")
    document.querySelector('.preview-sendPost').classList.remove('hidden')
})

// Fait apparaitre le drag and drop de la vidéo
ajouterVideo = document.querySelector('#ajouterVideo-sendPost')
uploadVideo = document.querySelector('.upload-video')

// Au click sur l'icone video
ajouterVideo.addEventListener("click", function (e) {
    uploadVideo.classList.toggle("show")
    document.querySelector('.preview-sendPost').classList.add('hidden')
})

submitVideo = document.querySelector('#submit-video')
submitVideo.addEventListener("click", function (e) {
    uploadVideo.classList.remove("show")
    document.querySelector('.preview-sendPost').classList.remove('hidden')
})


/* CYCLE D'UNE IMAGE */
// Dropzone options pour les images
Dropzone.options.dropzoneFromImages = {
    autoProcessQueue: false,
    dictDefaultMessage: 'Cliquez ou déposez votre photo',
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
        url: "../api/controllers/uploadTempPost.php",
        success: function (data) {
            $('#preview').html(data);
            document.querySelector(".video-media-senPost").classList.add("hidden")
            uploadImages.classList.remove("show")
            if (document.querySelector('#preview .container-preview').innerHTML == "") {
                document.querySelector(".video-media-senPost").classList.remove("hidden")
            }
        }
    });
}

// Bouton de suppression de l'image déjà téléchargé
$(document).on('click', '.remove_image', function () {

    var name = $(this).attr('id');
    $.ajax({
        // Adresse du traitement de l'image
        url: "../api/controllers/uploadTempPost.php",
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

// Fonction qui affiche la video dans la div preview
function list_video() {
    $.ajax({
        url: "../api/controllers/uploadTempPostVideo.php",
        success: function (data) {
            $('#preview-video').html(data);
            document.querySelector(".image-media-sendPost").classList.add("hidden")
            uploadVideo.classList.remove("show")

            if (document.querySelector('#preview-video .container-preview').innerHTML == "") {
                document.querySelector(".image-media-sendPost").classList.remove("hidden")
            }
        }
    });
}

// Bouton de suppression de la vidéo déjà téléchargé
$(document).on('click', '.remove_video', function () {
    var name = $(this).attr('id');
    $.ajax({
        // Adresse du traitement de l'image
        url: "../api/controllers/uploadTempPostVideo.php",
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
    if (confirm('Voulez-vous publier?')) {
        // Valeur du textarea
        let myContent = $("#TextareaPostSend").data("emojioneArea").getText();
        console.log()
        // Est ce une story?
        let exists = !!document.querySelector(".button-story-media-sendPost .validation-story");
        if (exists) {
            var story = "oui"
        }
        else {
            var story = "non"
        }

        // Il y a t'il une photo d'enregistréé et ou une video
        let photo = document.querySelector('#preview').hasChildNodes()
        let video = document.querySelector('#preview-video').hasChildNodes()

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
            video: video,
            story: story
        }
        data = JSON.stringify(data);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../api/controllers/postSend.php");
        xhr.setRequestHeader("Content-Type", "text/plain");
        xhr.send(data);

        let photoPreview = document.querySelector('#preview').hasChildNodes()
        let videoPreview = document.querySelector('#preview-video').hasChildNodes()
        let myText = $("#TextareaPostSend").data("emojioneArea").getText();

        if (photoPreview === true || videoPreview === true || myText != "") {

            if (myText != "") {
                $("#TextareaPostSend").data("emojioneArea").setText("")
            }

            if (photoPreview === true) {       
                // Suppression des images visibles dans preview
                document.querySelector('#preview').innerHTML = "";
            }

            if (videoPreview === true) {
                 // Suppression de la video visible dans preview
                 document.querySelector('#preview-video').innerHTML = "";
            }
            
                
            iconeImage = document.querySelector('#ajouterPhoto-sendPost')
            if (iconeImage.classList.contains("hidden") == true) {
                iconeImage.classList.remove("hidden")
            }
            iconeVideo = document.querySelector('#ajouterVideo-sendPost')
            if (iconeVideo.classList.contains("hidden") == true) {
                iconeVideo.classList.remove('hidden')
            }
            modale.classList.remove("show");
        }

        let exist = !!document.querySelector(".button-story-media-sendPost .validation-story");
        if (exist) {
            let deleteValidation = document.querySelector(".validation-story");
            deleteValidation.remove();
            buttonStory.classList.remove("validate")
        }

        window.location.reload();
    }
})

