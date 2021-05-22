var listeEvents = document.getElementById('listeEvents');



 function listEvent(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var output = '';
        
       
        for(var i =0; i<records.length; i++){				
          
            output +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/events/'+records[i].img_event+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].title_event+
            '</h5><p class="card-text">Description : '+records[i].text_event+
            '<p class="card-text">Date: '+records[i].date_event+
            '<p class="card-text">Ville: '+records[i].city_event+
            '</p><p class="card-text"><small class="text-muted">participants:</small></p><button type="button" class="btn btn-primary">Default button</button></div></div></div></div><br>';
        }        
            

    }else{
        output =  
            '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Pas de résultat</li>';
    }
    setTimeout(function(){ 
        listeEvents.innerHTML = output;
    }, 1000);  	
    

    });
   
    xhr.open("POST", 'api/controllers/listEvents');

    xhr.send();
}


document.addEventListener("DOMContentLoaded", function() {
listEvent();
});

function validerFormul(){
   
    var a= document.getElementById("title_event").value;
    var b= document.getElementById("text_event").value;
    var c= document.getElementById("date_event").value;
    var d= document.getElementById("city_event").value;
    var z= document.getElementById("public_event").value;
    if(a=="" || b=="" || c=="" || d=="" || z==""){
        return false;
    }else{
       return true;
    }
};

// disable autodiscover
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#dropzone", {
    url: "api/controllers/addEvent.php",
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

myDropzone.on("addedfile", function() {
    
});

myDropzone.on("removedfile", function(file) {
    // console.log(file);
});

// Add mmore data to send along with the file as POST data. (optional)
myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("dropzone", "1"); // $_POST["dropzone"]
    formData.append("img_event",myDropzone.files[0].name ); 
    $('#dropzone-form input[type="text"],#dropzone-form textarea,#dropzone-form input[type="hidden"], #dropzone-form input[type="datetime-local"]').each(function(){
        formData.append($(this).attr('name'),$(this).val());                    
    });
});

myDropzone.on("error", function(file, response) {
    console.log(response);
});

// on success
myDropzone.on("success", function(file, response) {
    window.location="events.php"; 
});

 
// button trigger for processingQueue
var submitDropzone = document.getElementById("submit-dropzone");
var footer= document.getElementById("footer");

submitDropzone.addEventListener("click", function(e) {
    validerFormul();
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.files != "" && validerFormul()==true ) {
       
        myDropzone.processQueue();
    } else {
	// if no file submit the form    
    
    footer.innerHTML= '<h4>Tous les champs doivent être remplis</h4>';
    }

});



