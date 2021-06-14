var viewProfil = document.getElementById('viewProfil');
var avatarProfil= document.getElementById('img-avatar');

document.addEventListener("DOMContentLoaded", function() {
    view_profil();
   
});

function view_profil(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            var record = JSON.parse(xhr.responseText);
            var outputPR = '';
            var outputAvatar='';

            outputPR +=
            '<div class="form-group"><input type="email" class="form-control w-75" id="email" name="email" value="'+record.email+
            '" required></div><div class="form-group"><input type="text" class="form-control w-75" placeholder="password" id="password" name="password" required></div><div class="form-group"><input type="text" class="form-control w-75" id="name" name="name" value="'+record.name+
            '" required></div><div class="form-group"><input type="text" class="form-control w-75" id="lastname" name="lastname" value="'+record.lastname+
            '" required></div><div class="form-group"><input type="text" class="form-control w-75" id="city" name="city" value="'+record.city+
            '" required></div><div class="form-group"><input type="text" class="form-control w-75" id="country" name="country" value="'+record.country+
            '" required></div><div class="form-group"><label for="birth" >Date de Naissance</label><input type="date" class="form-control w-75"  id="birth" name="birth" value="'+record.birth+
            '" required></div><br>';

            outputAvatar='<img class="d-block img-min" src="assets/images/upload/users/'+record.avatar+'" alt="avatar">';


            viewProfil.innerHTML = outputPR;
            avatarProfil.innerHTML = outputAvatar;
        }else  if(this.readyState === 4 && this.status === 404){
            viewProfil.innerHTML = '<p>Erreur système</p>';
            }
    });
    xhr.open("POST", 'api/controllers/viewProfil.php');
    xhr.send();
}



    // disable autodiscover
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#dropzone", {
    url: "api/controllers/modifyProfil.php",
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
    formData.append("avatar",myDropzone.files[0].name );
    $('#dropzone-form input[type="text"],#dropzone-form input[type="email"],#dropzone-form input[type="date"]').each(function(){
        formData.append($(this).attr('name'),$(this).val());
    });
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("success", function(file, response) {
    window.location="profil.php";
});


// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
var footer= document.getElementById("resultat");

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





function validerForm(){

    var a= document.getElementById("email").value;
    var b= document.getElementById("password").value;
    var c= document.getElementById("name").value;
    var d= document.getElementById("lastname").value;
    var e= document.getElementById("city").value;
    var f= document.getElementById("country").value;
    var g= document.getElementById("birth").value;
    if(a=="" || b=="" || c=="" || d=="" || e=="" || f=="" || g==""){
        return false;
    }else{
       return true;
    }
};
