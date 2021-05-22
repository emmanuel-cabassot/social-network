
 var listeGroupe = document.getElementById('listeGroupe');

 function listGroup(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var output = '';
        
       
        for(var i =0; i<records.length; i++){				
          
            output +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">'+records[i].description+
            '</p><p class="card-text"><small class="text-muted">participants:</small></p><button type="button" class="btn btn-primary">Default button</button></div></div></div></div><br>';
        }        
            

    }else{
        output =  
            '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Pas de résultat</li>';
    }
    setTimeout(function(){ 
        listeGroupe.innerHTML = output;
    }, 1000);  	
    

    });
   
    xhr.open("POST", 'api/controllers/listGroups');

    xhr.send();
}


document.addEventListener("DOMContentLoaded", function() {
listGroup();
});


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
submitDropzone.addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "") {
        // console.log(myDropzone.files);
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
        document.getElementById("dropzone-form").submit();
    }

});



