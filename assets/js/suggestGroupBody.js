var suggestGroupe = document.getElementById('suggestGroupe');
document.addEventListener("DOMContentLoaded", function() {
    suggestGroupB()
});

function suggestGroupB(){
		
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputSG = '';
       
       
        for(var i =0; i<records.length; i++){				
           
            outputSG +=  
            
            '<div class="col-md-4"><div class="profile-card text-center"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="img-min img-responsive"><div class="profile-content"><h6>'+records[i].name_group+
            '</h6><div class="row d-flex justify-content-around pt-2"><div class="col-xs-4"><div class="profile-overview"><p>participants</p><h6>'+records[i].count+
            '</h6></div></div><div class="col-xs-4"><div class="profile-overview"><a href="groupe.php?id_group='+records[i].id_group+
            '" class="btn btn-primary float-right">Voir</a><br></div></div></div></div></div></div>';
                  
     
            setTimeout(function(){ 
                suggestGroupe.innerHTML = outputSG;
            }, 1000);  	    

        };
    }else if(this.readyState === 4 && this.status === 404){
            suggestGroupe.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/suggestGroup.php');

    xhr.send();
   
};