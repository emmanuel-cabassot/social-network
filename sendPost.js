let user = document.querySelector('#idUser')
console.log(user)
user = 1

const publier = document.querySelector('button')

publier.addEventListener("click", function (e) {
    var myContent = tinymce.get("TextareaPostSend").getContent();
    console.log(user)
    data = {
        user: user,
        texte: myContent
    }
    data = JSON.stringify(data);
    console.log(data)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/postSend.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.send(data);
})


// Dropzone options
Dropzone.options.dropzoneFrom = {
    autoProcessQueue: false,
    dictDefaultMessage: 'Cliquez ici',
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
        url: "uploadPost.php",
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
        url: "uploadPost.php",
        method: "POST",
        data: { name: name },
        success: function (data) {
            list_image();
        }
    })
});

