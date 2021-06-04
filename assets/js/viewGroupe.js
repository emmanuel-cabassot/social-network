var viewGroupe = document.getElementById('viewGroupe');
var listCommentGroup = document.getElementById('listCommentGroup');
var id_group = $_GET('id_group');
var id_group = id_group.trim();
var submitComment= document.getElementById('submitComment');
var footerModal= document.getElementById('footerModal');
var commentForm= document.getElementById('comment-form');


var serializeForm = function (form) {
            var obj = {};
            var formData = new FormData(form);
            for (var key of formData.keys()) {
                obj[key] = formData.get(key);
            }
            return obj;
        };


document.addEventListener("DOMContentLoaded", function() {
    view_group(id_group);
    listerCommentG(id_group);     
});

 commentForm.addEventListener('submit', e => {
        e.preventDefault();
        sendComment(id_group);
        });

function sendComment(id_group){
    if (validerForm()==true) {
        
        var form_data=JSON.stringify(serializeForm(commentForm));
        
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status == 200) {
               window.location="groupe.php?id_group="+id_group;
            }
        });

        xhr.open("POST", "api/controllers/addGroupComment?id_group="+id_group);
        xhr.setRequestHeader("Content-Type", "text/plain");

        xhr.send(form_data);   
    
    } else {
    // if no file submit the form    
    footerModal.innerHTML= '<h4>Tous les champs doivent être remplis</h4>';
    }
}
    

function validerForm(){

    var a= document.getElementById("comment").value;

    if(a==""){
        return false;
    }else{
    return true;
    }
};

function $_GET(param) {
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function( m, key, value ) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );
    if ( param ) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}

function view_group(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            var record = JSON.parse(xhr.responseText);
            var outputGE = '';
            var appartenir='';
            if(record.belong==false){
                appartenir='<button type="button" onclick="belong_group('+record.id_group+
                ')" class="btn btn-primary">S\'inscrire</button>';
            }else{appartenir='<p>Vous êtes membre de ce groupe</p><button type="button" onclick="noBelong('+record.id_group+
            ')" class="btn btn-primary">Se désinscrire</button>'}
            outputGE +=
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+record.img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+record.name_group+
            '</h5><p class="card-text">'+record.description+
            '</p><p class="card-text">participants : <b>'+record.count+
            '</b></p><p class="card-text">Créé par : <b><img src="assets/images/upload/users/'+record.avatar_create+
            '" class="card-img-thumb" alt="...">'+record.name_create+' '+record.lastname_create+
            '</b></p>'+appartenir+'</div></div></div></div>';
        }else{
            outputGE =
            '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Erreur système, veuillez essayer de nouveau.</li>';
        }
        setTimeout(function(){
            viewGroupe.innerHTML = outputGE;
        }, 1000);
    });
    xhr.open("POST", "api/controllers/viewGroup?id_group="+id_group);
    xhr.send();
}

function noBelong(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            view_group(id_group);
           
        }
    });
    xhr.open("POST", "api/controllers/noBelong?id_group="+id_group);
    xhr.send();
}

function belong_group(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            view_group(id_group);  
        }
    });
    xhr.open("POST", "api/controllers/belong?id_group="+id_group);
    xhr.send();
}

function part_group(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
         return true;
        }else{
           return false;
        }
        
    });
    xhr.open("POST", "api/controllers/part_group?id_group="+id_group);
    xhr.send();
}

function  listerCommentG(id_group){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {

            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputLC = '';

            for(var i =0; i<records.length; i++){
                    
                    if(records[i].belong == true){
                        outputLC += 
                        '<img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
                        '<p class="card-text">'+records[i].text_comment+
                        '</p><p>date : '+records[i].date_comment+'</p>';

                    }else{
                        outputLC = '<p class="list-group-item list-group-item-action">Pas encore de commentaires? </p>';
                    }
            }
             listCommentGroup.innerHTML = outputLC;
           
        }else  if(this.readyState === 4 && this.status === 404){
            listCommentGroup.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore de commentaires</p>';
            }
    });
    xhr.open("POST", 'api/controllers/listGroupComment?id_group='+id_group);
    xhr.send();
    }


