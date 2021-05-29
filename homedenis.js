var suggestedEvent = document.getElementById('suggestedEvent');
var suggestedGroupe = document.getElementById('suggestedGroupe');
var suggestedFriend = document.getElementById('suggestedFriend');


document.addEventListener("DOMContentLoaded", function() {
    suggestEventList();
    suggestFriendList();
    });

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



