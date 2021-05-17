lienModale = document.querySelectorAll('[data-modale]')
lienModale.forEach(ouvertureModale => {
    ouvertureModale.addEventListener("click", function () {
        
    })
})

let user = document.querySelector('#idUser')
console.log(user)
user = 1

// Dropzone options
Dropzone.options.dropzoneFrom = {
    autoProcessQueue: false,
    dictDefaultMessage: 'Cliquez ou déposez ici',
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init: function () {
        // Le bouton de téléchargement des images
        var submitButton = document.querySelector('#submit-all');
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

// Fonction qui affiche les photos sous dans la div #preview
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

const publier = document.querySelector('button')

publier.addEventListener("click", function (e) {
    // Valeur du textarea
    let myContent = tinymce.get("TextareaPostSend").getContent();

    // Il y a t'il une photo d'enregistréé
    let photo = document.querySelector('#preview').value
    if (photo == '') {
        photo = 'non'
    }
    else {
        photo = 'oui'
    }
    data = {
        user: user,
        texte: myContent,
        photo: photo
    }
    data = JSON.stringify(data);
    console.log(data)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/postSend.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.send(data);
})
