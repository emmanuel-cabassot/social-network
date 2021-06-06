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
            
            '<div class="col-md-4"><div class="profile-card text-center"><img src="assets/images/upload/events/'+records[i].img_event+
            '" class="img img-responsive"><div class="profile-content"><h6>'+records[i].title_event+
            '</h6><div class="row d-flex justify-content-around pt-2"><div class="col-xs-4"><div class="profile-overview"><span class="badge bg-warning mt-1"> '+records[i].date_event+
            '</span><p class="card-text mt-2"><b>'+records[i].city_event+
            '</b></p></div></div><div class="col-xs-4"><div class="profile-overview"><p class="m-2">participants</p><span class="badge rounded-pill bg-primary">'+records[i].count+
            '</span></div></div></div><a href="#" class="btn btn-primary mt-3">Voir</a><br></div></div></div>';
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