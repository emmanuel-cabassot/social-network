var vueEvent = document.getElementById('oneEvent');

document.addEventListener("DOMContentLoaded", function() {

	var id_event = $_GET('id_event');
    // trim to remove the whitespaces
    var id_event = id_event.trim();
    viewEvent(id_event);
	
});

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
                    '</p><p class="card-text">participants : <b>'+record.count+'</b></p>'+participer+'</div></div></div></div><br>';
                             
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