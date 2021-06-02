var listCommentGroup = document.getElementById('listCommentGroup');

var id_group = $_GET('id_group');
    // trim to remove the whitespaces
var id_group = id_group.trim();

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


document.addEventListener("DOMContentLoaded", function() {
   
        listCommentG(id_group);
    });


    function listCommentG(id_group){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
    
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputLCG = '';
    
            for(var i =0; i<records.length; i++){
    
                outputLCG +=
                '<p>'+records[i].name+' '+records[i].lastname+' a écrit le '+records[i].date_comment+
                '</p><p><i>'+records[i].text_comment+'</i></p><hr><br>';
            }
    
            listcommentGroup.innerHTML = outputLCG;
    
    
        }else if(this.readyState === 4 && this.status === 404){
                listGroups.innerHTML = '<p>Pas de commentaires</p>';
            }
        });
        xhr.open("POST", 'api/controllers/listGroupComment?id_group='+id_group);
        xhr.send();
    };
    
