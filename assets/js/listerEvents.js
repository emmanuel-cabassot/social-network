var listEvents = document.getElementById('listEvents');

document.addEventListener("DOMContentLoaded", function() {
    listerEvents();
    });

 function listerEvents(){	
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {
        
        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputE = '';
       
        for(var i =0; i<records.length; i++){				
            
            outputE +=  
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_event+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].title_event+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><a  href="groupe.php?id_group='+records[i].id_group+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
        }        
           
        listGroups.innerHTML = outputE;
               
        
    }else if(this.readyState === 4 && this.status === 404){
            listGroups.innerHTML = '<p>Pas de participation à un évènement.</p>';
        }
    });
    xhr.open("POST", 'api/controllers/listEvents');
    xhr.send();  
};


           
                    ' le: '+records[i].date_event+' - '+records[i].city_event+')</a>';
  
