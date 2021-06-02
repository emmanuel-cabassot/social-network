var suggestedEvent = document.getElementById('suggestedEvent');

document.addEventListener("DOMContentLoaded", function() {
    suggestEventList();
    });

function suggestEventList(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputSE = '';
            for(var i =0; i<records.length; i++){
                    outputSE +=
                    '<a href="#" class="list-group-item list-group-item-action"><img src="assets/images/upload/events/'+records[i].img_event+'" class="card-img-thumb" alt="...">'+records[i].title_event+
                    ' le: '+records[i].date_event+' - '+records[i].city_event+')</a>';
            }
           
                suggestedEvent.innerHTML = outputSE;
           	
           

        }else  if(this.readyState === 4 && this.status === 404){
            suggestedEvent.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'évènements</p>';
            }
    });
    xhr.open("POST", 'api/controllers/suggestEvent');
    xhr.send();
}

