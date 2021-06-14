var suggestedGroup = document.getElementById('suggestedGroup');

document.addEventListener("DOMContentLoaded", function() {
    suggestGroupList();
    });
function suggestGroupList(){
		
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputG = '';

            for(var i =0; i<records.length; i++){				
                
                    outputG +=  
                    '<a href="groupe.php?id_group='+records[i].id_group+'" class="list-group-item list-group-item-action"><img src="assets/images/upload/groups/'+records[i].img_group+'" class="card-img-thumb" alt="...">   '+records[i].name_group+
                    '</a>';
            }
  
            suggestedGroup.innerHTML = outputG;

        }else  if(this.readyState === 4 && this.status === 404){
            suggestedGroup.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion de groupe</p>';
           
            }  
    });
   
    xhr.open("POST", 'api/controllers/suggestGroup.php');
    xhr.send();
}