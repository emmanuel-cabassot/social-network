var suggestEvent = document.getElementById('suggestEvent');
document.addEventListener("DOMContentLoaded", function() {
    suggestEventB()
});

function suggestEventB(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputSE = '';
       
       
        for(var i =0; i<records.length; i++){				
            if(records[i].belong==false){
            outputSE +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_event+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].title_event+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</p><p> le: '+records[i].date_event+' à '+records[i].city_event+
            '</b></p><a  href="event.php?id_event='+records[i].id_event+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
            }        
     
            setTimeout(function(){ 
                suggestEvent.innerHTML = outputSE;
            }, 1000);  	    

        };
    }else if(this.readyState === 4 && this.status === 404){
            suggestEvent.innerHTML = '<p>Pas de suggestion</p>';
        }
    });
    xhr.open("POST", 'api/controllers/suggestEvent');

    xhr.send();
   
};