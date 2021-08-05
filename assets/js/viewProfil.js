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
            '" required></div><br><div class="form-group"> <button type="submit" class="btn btn-primary w-75">Modifier</button></div>';

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

var formP = document.getElementById("formProfil"); 

document.addEventListener("DOMContentLoaded", function() {
    formP.addEventListener('submit', e => {
        e.preventDefault();
       ModifyProfil();
        });
    });

var serializeForm = function (form) {
    var obj = {};
    var formData = new FormData(form);
    for (var key of formData.keys()) {
        obj[key] = formData.get(key);
    }
    return obj;
};

function ModifyProfil(){
    var modify_form = formP;
    var form_data=JSON.stringify(serializeForm(modify_form));
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status == 200) {
            window.location="viewProfil.php";
        }else if(this.readyState === 4 && this.status == 406){
           setTimeout(function(){$("#resultat").html("<p>Cet email existe déja.</p>")}, 1000); 
        }else{setTimeout(function(){$("#resultat").html("<p>Erreur système, veuillez recommencer</p>")}, 1000);}
    });

    xhr.open("POST", "api/controllers/modifyProfil.php");
    xhr.setRequestHeader("Content-Type", "text/plain");

    xhr.send(form_data);
   }

    // disable autodiscover
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#dropzone", {
    url: "api/controllers/modifyAvatar.php",
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
  
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "") {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    
    }else{
        footer.innerHTML= '<h4>Ajoutez une image si vous voulez la modifier</h4>'; 
    }

});

