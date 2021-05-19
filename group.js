
Dropzone.options.myDropzone = {
    url: "upload.php",
    autoProcessQueue: false,
    uploadMultiple: true,
    maxFilesize:1, //MB
    acceptedFiles: "image/*",

    init: function () {

        var submitButton = document.querySelector("#submit");
        var wrapperThis = this;

        submitButton.addEventListener("click", function () {
            wrapperThis.processQueue();
        });

        this.on("addedfile", function (file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

            // Listen to the click event
            removeButton.addEventListener("click", function (e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                // Remove the file preview.
                wrapperThis.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });

        this.on('sending', function (data, xhr, formData) {
            $('#addGroup input[type="text"],#addGroup textarea').each(function(){
                formData.append($(this).attr('name'),$(this).val());
            });
          

        });
    }
}
