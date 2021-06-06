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
            
            '<div class="card"><div class="row d-flex justify-content-between"><div class="col-sm-3"><img class="d-block img-min" src="assets/images/upload/events/'+records[i].img_event+
            '" alt="..."></div><div class="col-sm-3 mt-3"><span class="badge bg-warning mt-1">'+records[i].date_event+
            '</span><p class="card-text mt-3"><b>'+records[i].city_event+
            '</b></p></span><div class="col-sm-3 mt-3"><h4 class="card-title">'+records[i].title_event+
            '</h4><p class="card-text">participants : <span class="badge rounded-pill bg-primary">'+records[i].count+
            '</span></p></div><div class="col-sm-3 mt-4"><a href="event.php?id_event='+records[i].id_event+
            '" class="btn btn-primary">Voir</a></div></div></div>';
        }

        listEvents.innerHTML = outputE;


    }else if(this.readyState === 4 && this.status === 404){
            listEvents.innerHTML = '<p>Pas de participation à un évènement.</p>';
        }
    });
    xhr.open("POST", 'api/controllers/listEvents');
    xhr.send();
};
