var listeEvents = document.getElementById('listeEvents');
var oneEvent = document.getElementById('oneEvent');

function part_event(id_event){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            refresh=' ';
            setTimeout(function(){
                oneEvent.innerHTML = refresh;
            }, 500);
            listEvent();

        }
    });
    xhr.open("POST", "api/controllers/partEvent?id_event="+id_event);

    xhr.send();
}

function no_particip(id_event){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            refresh=' ';
            setTimeout(function(){
                oneEvent.innerHTML = refresh;
            }, 500);
            listEvent();
        }
    });
    xhr.open("POST", "api/controllers/noPartEvent?id_event="+id_event);

    xhr.send();
}

function viewEvent(id_event){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){

            var record = JSON.parse(xhr.responseText);
            var output = '';
            var participer='';

                if(record.part==false){
                    participer='<button type="button" onclick="part_event('+record.id_event+
                    ')" class="btn btn-primary">Participer</button>';
                }else{participer='<p>Vous participez à cet événement.</p><button type="button" onclick="no_particip('+record.id_event+
                ')" class="btn btn-primary">Se désinscrire</button>'}

                output +=
                '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/events/'+record.img_event+
                '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+record.title_event+
                '</h5><p class="card-text">Description : '+record.text_event+
                '<p class="card-text">Date: '+record.date_event+
                '<p class="card-text">Ville: '+record.city_event+
                '</p><p class="card-text">participants : <b>'+record.count+'</b></p>'+participer+'</div></div></div></div><br>';


            }else{
                output =
                    '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Erreur système, veuillez essayer de nouveau.</li>';
            }
        setTimeout(function(){
            oneEvent.innerHTML = output;
        }, 1000);


        });

        xhr.open("POST", 'api/controllers/viewEvent?id_event='+id_event);

        xhr.send();
}


function suggestEventList(){

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
                     '</h5><p class="card-text">participants : <b>'+records[i].count+
                     '</b></p><button type="button" onclick="view_group('+records[i].id_group+
                     ')" class="btn btn-primary">Voir</button></div></div></div></div><br>';
                     }
                    '<a href="#" class="list-group-item list-group-item-action"><img src="assets/images/upload/events/'+records[i].img_event+'" class="card-img-thumb" alt="...">'+records[i].title_event+
                    ' le: '+records[i].date_event+' - '+records[i].city_event+')</a>';
            }

            suggestedEvent.innerHTML = output;

        }else  if(this.readyState === 4 && this.status === 404){
            suggestedEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'évènements</p>';

            }
    });

    xhr.open("POST", 'api/controllers/suggestEvent');
    xhr.send();
}


 function listEvent(){

    var xhr = new XMLHttpRequest();

    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {

        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var output = '';
        var participer ='';


        for(var i =0; i<records.length; i++){
            if(records[i].part==false){
                participer='<p>Vous ne participez pas à cet événement</p>';
            }else{participer='<p>Vous participez à cet événement.</p>'}
            output +=
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/events/'+records[i].img_event+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].title_event+
            '</h5><p class="card-text">Description : '+records[i].text_event+
            '<p class="card-text">Date: '+records[i].date_event+
            '<p class="card-text">Ville: '+records[i].city_event+
            '</p><p class="card-text">participants : <b>'+records[i].count+'</b></p>'+participer+'<button type="button" onclick="viewEvent('+records[i].id_event+
            ')" class="btn btn-primary">Voir</button></div></div></div></div><br>';
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
var footer= document.getElementById("modal_footer");

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
