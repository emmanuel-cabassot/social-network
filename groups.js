
 var suggestGroupe = document.getElementById('suggestGroupe');
 var viewGroupe = document.getElementById('viewGroupe');

function belong_group(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            refresh=' ';
            setTimeout(function(){ 
                viewGroupe.innerHTML = refresh;
            }, 500); 
            listGroup();
        }
    });
    xhr.open("POST", "api/controllers/belong?id_group="+id_group);

    xhr.send();
}

function noBelong(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            refresh=' ';
            setTimeout(function(){ 
                viewGroupe.innerHTML = refresh;
            }, 500); 
            listGroup(); 
        }
    });
    xhr.open("POST", "api/controllers/noBelong?id_group="+id_group);

    xhr.send();
}

 function view_group(id_group){    
   
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){

            var record = JSON.parse(xhr.responseText);
            var output = '';
            var appartenir='';

            if(record.belong==false){
                appartenir='<button type="button" onclick="belong_group('+record.id_group+
                ')" class="btn btn-primary">S\'inscrire</button>';   
            }else{appartenir='<p>Vous êtes membre de ce groupe</p><button type="button" onclick="noBelong('+record.id_group+
            ')" class="btn btn-primary">Se désinscrire</button>'}
            output += 
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+record.img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+record.name_group+
            '</h5><p class="card-text">'+record.description+
            '</p><p class="card-text">participants : <b>'+record.count+'</b></p>'+appartenir+'</div></div></div></div><br>';   
        }else{
            output =  
            '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Erreur système, veuillez essayer de nouveau.</li>';  
        } 
        
        setTimeout(function(){ 
            viewGroupe.innerHTML = output;
        }, 1000);  	
    });
    xhr.open("POST", "api/controllers/viewGroup?id_group="+id_group);

    xhr.send();
}

    function suggestGroup(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var output = '';
       
       
        for(var i =0; i<records.length; i++){				
            if(records[i].belong==false){
            output +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><button type="button" onclick="view_group('+records[i].id_group+
            ')" class="btn btn-primary">Voir</button></div></div></div></div><br>';
            }        
     
            setTimeout(function(){ 
                suggestGroupe.innerHTML = output;
            }, 1000);  	    

        };
    }else if(this.readyState === 4 && this.status === 404){
            suggestGroupe.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/suggestGroup');

    xhr.send();
   
};

document.addEventListener("DOMContentLoaded", function() {
suggestGroup();
});

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
var footer= document.getElementById("footer");

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



