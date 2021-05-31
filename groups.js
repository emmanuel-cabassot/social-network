
 var suggestGroupe = document.getElementById('suggestGroupe');
 var listGroups = document.getElementById('listGroups');

 document.addEventListener("DOMContentLoaded", function() {
    suggestGroup();
    listerGroups();
    suggestEventList();
    suggestFriendList();
    listerFriends();
    listerGroups();
    });

 function listerGroups(){	
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputG = '';
       
        for(var i =0; i<records.length; i++){				
            
            outputG +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><a  href="groupe.php?id_group='+records[i].id_group+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
        }        
           
        listGroups.innerHTML = outputG;
               
        
    }else if(this.readyState === 4 && this.status === 404){
            listGroups.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/listGroups');
    xhr.send();  
};

    function suggestGroup(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputSG = '';
       
       
        for(var i =0; i<records.length; i++){				
            if(records[i].belong==false){
            outputSG +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><a  href="groupe.php?id_group='+records[i].id_group+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
            }        
     
            setTimeout(function(){ 
                suggestGroupe.innerHTML = outputSG;
            }, 1000);  	    

        };
    }else if(this.readyState === 4 && this.status === 404){
            suggestGroupe.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/suggestGroup');

    xhr.send();
   
};



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


function suggestEventList(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputSE = '';
            for(var i =0; i<records.length; i++){
                    outputSE +=
                    '<a href="#" class="list-group-item list-group-item-action"><img src="assets/images/upload/events/'+records[i].img_event+'" class="card-img-thumb" alt="...">'+records[i].title_event+
                    ' le: '+records[i].date_event+' - '+records[i].city_event+')</a>';
            }
            suggestedEvent.innerHTML = outputSE;
        }else  if(this.readyState === 4 && this.status === 404){
            suggestedEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'évènements</p>';
            }
    });
    xhr.open("POST", 'api/controllers/suggestEvent');
    xhr.send();
}

function suggestFriendList(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputF = '';
            for(var i =0; i<records.length; i++){
                    outputF +=
                    '<a href="#" class="list-group-item list-group-item-action"><img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
                    ' '+records[i].city+' - '+records[i].country+'</a>';
            }
            suggestedFriend.innerHTML = outputF;
        }else  if(this.readyState === 4 && this.status === 404){
            suggestedFriend.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'amis</p>';
            }
    });
    xhr.open("POST", 'api/controllers/suggestFriend');
    xhr.send();
}

function listerFriends(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {

            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputLF = '';

            for(var i =0; i<records.length; i++){
                    var connect='';
                    if(records[i].id_connected != null){connect='<i class="bi bi-person-circle mr-1" style="font-size: 2rem; color: green;"></i>'}else{connect='<i class="bi bi-person-circle mr-3"></i>'}
                    if(records[i].confirmed=="oui"){
                        outputLF +=
                        '<a href="#" class="list-group-item list-group-item-action">'+connect+
                        '<img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
                        ' '+records[i].city+ ' - '+records[i].country+'</a>';
                    }else{
                        listFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore d\'amis? </p>';
                    }
            }
            listFriends.innerHTML = outputLF;
        }else  if(this.readyState === 4 && this.status === 404){
            listFriends.innerHTML = '<pclass="list-group-item list-group-item-action">Pas encore d\'amis?</p>';
            }
    });
    xhr.open("POST", 'api/controllers/listFriends');
    xhr.send();
}




