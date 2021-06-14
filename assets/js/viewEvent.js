var vueEvent = document.getElementById('oneEvent');
var listCommentEvent = document.getElementById('listCommentEvent');
var id_event = $_GET('id_event');   
var id_event = id_event.trim();
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
    listerCommentE(id_event);           
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
                window.location="event.php?id_event="+id_event;
            }
        });

        xhr.open("POST", "api/controllers/addEventComment.php?id_event="+id_event);
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

    function viewEvent(id_event){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200){
    
                var record = JSON.parse(xhr.responseText);
                var outputVE = '';
                var participer='';
                          
                    if(record.part==false){
                        participer='<button type="button" onclick="particip_event('+record.id_event+
                        ')" class="btn btn-primary">Participer</button>'; 
                    }else{participer='<p>Vous participez à cet événement.</p><button type="button" onclick="no_particip('+record.id_event+
                    ')" class="btn btn-primary">Se désinscrire</button>'}
    
                    outputVE =  
                    '<div class="card w-75 mb-3"><div class="row no-gutters"><div class="col-lg-4 col-md-4 align-item-center"><img src="assets/images/upload/events/'+record.img_event+
                    '" class="img-min" alt="..."></a></div><div class="col-lg-8 col-md-8"><div class="card-body"><h5 class="card-title">'+record.title_event+
                    '</h5></a><span class="badge bg-warning mt-1">'+record.date_event+'</span><p class="card-text">'+record.city_event+'<p class="card-text">Description : '+record.text_event+
                    '</p><div class="row d-flex justify-content-around text-center pt-2"><div class="col-lg-4 col-md-4 align-item-center"><p>participants</p><span class="badge rounded-pill bg-primary">'+record.count+
                    '</span></div><div class="col-lg-8 col-md-8 align-item-center"><p class="card-text ">Créé par :<img src="assets/images/upload/users/'+record.avatar+
                    '" class="card-img-thumb" alt="..."><h6>'+record.name+' '+record.lastname+
                    '</h6></p></div></div></div>'+participer+'</div><br>';

                             
                    }else{
                    outputVE =  
                        '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Erreur système, veuillez essayer de nouveau.</li>';
                }
            setTimeout(function(){ 
                vueEvent.innerHTML = outputVE;
            }, 1000);  	
                    
            });
           
            xhr.open("GET", 'api/controllers/viewEvent.php?id_event='+id_event);
        
            xhr.send();
    }

    function particip_event(id_event){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200){
               viewEvent(id_event);
            }
        });
        xhr.open("POST", "api/controllers/partEvent.php?id_event="+id_event);
    
        xhr.send();
    }
    
    function no_particip(id_event){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status === 200){
                viewEvent(id_event);
            }
        });
        xhr.open("POST", "api/controllers/noPartEvent.php?id_event="+id_event);    
        xhr.send();
    }

    function part_event(id_event){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
         return true;
        }else{
           return false;
        }
        
    });
    xhr.open("POST", "api/controllers/part_event.php?id_event="+id_event);
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
                            '<p class="mt-3"><img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">  '+records[i].name+' '+records[i].lastname+
                            '  a écrit le '+records[i].date_comment+'</p><p class="list-group-item list-group-item-action"><i>'+records[i].text_comment+
                            '</i></p><br>';
                        }else{
                           ouputLC = '<p class="list-group-item list-group-item-action mt-5">Pas encore de commentaires</p>';  
                        }
                
                }
                listCommentEvent.innerHTML = outputLC;
                }else  if(this.readyState === 4 && this.status === 404){
            listCommentEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore de commentaires</p>';
            }
            
            
        });
        xhr.open("GET", 'api/controllers/listEventComment.php?id_event='+id_event);
        xhr.send();
        }
        
    