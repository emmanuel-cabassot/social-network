document.addEventListener("DOMContentLoaded", function() {

var id_group = $_GET('id_group');
    // trim to remove the whitespaces
var id_group = group.trim();
suggestEventList();
suggestFriendList();
listerFriends();
view_group(id_group);

});

var viewGroupe = document.getElementById('viewGroupe');

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

function suggestEventList(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var output = '';
            for(var i =0; i<records.length; i++){
                    output +=
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
                        listFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore d\'amis?</p>';
                    }
            }
            listFriends.innerHTML = outputLF;
        }else  if(this.readyState === 4 && this.status === 404){
            listFriends.innerHTML = '<pclass="list-group-item list-group-item-action">Pas encore d\'amis?/p>';
            }
    });
    xhr.open("POST", 'api/controllers/listFriends');
    xhr.send();
}
