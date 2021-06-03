var vueEvent = document.getElementById('oneEvent');
var listCommentEvent = document.getElementById('listCommentEvent');
var id_event = $_GET('id_event');   
var id_event = id_event.trim();
var participe = part_event(id_event);
var submitComment= document.getElementById('submit-comment');
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
    viewEvent(id_event);
    if(participe==true)	{
        listerCommentE();           
    }
});
commentForm.addEventListener('submit', e => {
    e.preventDefault();
    sendComment(id_event);
    });   
  
function sendComment(id_event){
    if (validerForm()==true) {
       
        var form_data=JSON.stringify(serializeForm(commentForm));
        
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status == 200) {
                listerCommentE(id_event);
            }else{setTimeout(function(){$("#footerModal").html("<p>Erreur système, veuillez recommencer</p>")}, 1000);}
        });

        xhr.open("POST", "api/controllers/addEventComment?id_event="+id_event);
        xhr.setRequestHeader("Content-Type", "text/plain");

        xhr.send(formData);   
    
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

    function viewEvent(id_event){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200){
    
                var record = JSON.parse(xhr.responseText);
                var outputVE = '';
                var participer='';
                          
                    if(record.part==false){
                        participer='<button type="button" onclick="part_event('+record.id_event+
                        ')" class="btn btn-primary">Participer</button>'; 
                    }else{participer='<p>Vous participez à cet événement.</p><button type="button" onclick="no_particip('+record.id_event+
                    ')" class="btn btn-primary">Se désinscrire</button>'}
    
                    outputVE =  
                    '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/events/'+record.img_event+
                    '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+record.title_event+
                    '</h5><p class="card-text">Description : '+record.text_event+
                    '<p class="card-text">Date: '+record.date_event+
                    '<p class="card-text">Ville: '+record.city_event+
                    '</p><p class="card-text">participants : <b>'+record.count+
                    '</b></p><p class="card-text">Créé par : <b><img src="assets/images/upload/users/'+record.avatar+
                    '" class="card-img-thumb" alt="...">'+record.name+' '+record.lastname+
                    '</b></p>'+participer+'</div></div></div></div>';
                             
                    }else{
                    outputVE =  
                        '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Erreur système, veuillez essayer de nouveau.</li>';
                }
            setTimeout(function(){ 
                vueEvent.innerHTML = outputVE;
            }, 1000);  	
                    
            });
           
            xhr.open("GET", 'api/controllers/viewEvent?id_event='+id_event);
        
            xhr.send();
    }

    function part_event(id_event){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200){
                refresh=' ';
                setTimeout(function(){ 
                    oneEvent.innerHTML = refresh;
                }, 500); 
               viewEvent(id_event);
    
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
                viewEvent(id_event);
            }
        });
        xhr.open("POST", "api/controllers/noPartEvent?id_event="+id_event);    
        xhr.send();
    }

    function listerCommentE(id_event){       
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200) {
    
                var response = JSON.parse(xhr.responseText);
                var records = response.records;
                var outputLC = '';
    
                for(var i =0; i<records.length; i++){
                        
                        if(records[i].participe == true){
                            outputLC += 
                            '<img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
                            '<p class="card-text">'+records[i].text_comment+
                            '</p><p>date : '+records[i].date_comment+'</p>';
                        }else{
                            listCommentEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore de commentaires </p>';
                        }
                }
                listCommentEvent.innerHTML = outputLC;
            }else  if(this.readyState === 4 && this.status === 404){
                listCommentEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore de commentaires</p>';
                }
        });
        xhr.open("POST", 'api/controllers/listEventComment?id_event='+id_event);
        xhr.send();
        }
        
    