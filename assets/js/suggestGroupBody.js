var suggestGroupe = document.getElementById('suggestGroupe');
document.addEventListener("DOMContentLoaded", function() {
    suggestGroup()
});

function suggestGroup(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputSG = '';
       
       
        for(var i =0; i<records.length; i++){				
            if(records[i].belong==false){
            outputSG +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><a  href="groupe.php?id_group='+records[i].id_group+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
            }        
     
            setTimeout(function(){ 
                suggestGroupe.innerHTML = outputSG;
            }, 1000);  	    

        };
    }else if(this.readyState === 4 && this.status === 404){
            suggestGroupe.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/suggestGroup');

    xhr.send();
   
};