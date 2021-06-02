

function validerForm(){
    
    var a= document.getElementById("name_group").value;
    var b= document.getElementById("description").value;
    
    if(a=="" || b=="" ){
        return false;
    }else{
       return true;
    }
};

// disable autodiscover
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#dropzone", {
    url: "api/controllers/addGroup.php",
    method: "POST",
    paramName: "file",
    autoProcessQueue : false,
    acceptedFiles: "image/*",
    maxFiles: 5,
    maxFilesize: 1, // MB
    uploadMultiple: false,
    parallelUploads: 100, // use it with uploadMultiple
    createImageThumbnails: true,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    addRemoveLinks: true,
    timeout: 180000,
    dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file
    // Language Strings
    dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
    dictInvalidFileType: "Invalid File Type",
    dictCancelUpload: "Cancel",
    dictRemoveFile: "Remove",
    dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
    dictDefaultMessage: "Drop files here to upload",
});

myDropzone.on("addedfile", function(file) {
    //console.log(file);
});

myDropzone.on("removedfile", function(file) {
    // console.log(file);
});

// Add mmore data to send along with the file as POST data. (optional)
myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("dropzone", "1"); // $_POST["dropzone"]
    formData.append("img_group",myDropzone.files[0].name ); 
    $('#dropzone-form input[type="text"],#dropzone-form textarea').each(function(){
        formData.append($(this).attr('name'),$(this).val());                    
    });
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("success", function(file, response) {
    window.location="groups.php"; 
});

 
// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
var footer= document.getElementById("modal_footer");

submitDropzone.addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    validerForm();
    e.preventDefault();
    e.stopPropagation();
    
    if (myDropzone.files != "" && validerForm()==true) {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
    footer.innerHTML= '<h4>Tous les champs doivent être remplis</h4>';
    }

});
