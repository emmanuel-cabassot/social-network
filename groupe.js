document.addEventListener("DOMContentLoaded", function() {

	var id_group = $_GET('id_group');
    // trim to remove the whitespaces
    var id_group = group.trim();

	
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