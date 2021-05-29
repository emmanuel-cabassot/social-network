var listEvent = document.getElementById('listEvent');
var suggestEvent = document.getElementById('suggestEvent');
var suggestGroupe = document.getElementById('suggestGroupe');
var viewGroupe = document.getElementById('viewGroupe');



 function suggestEventList(){
		
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var output = '';

            for(var i =0; i<records.length; i++){				
                
                    output +=  
                    '<a href="#" class="list-group-item list-group-item-action"><img src="assets/images/upload/users/'+records[i].img_event+'" class="card-img-thumb" alt="...">'+records[i].name+
                    ' '+records[i].title_event+' ('+records[i].date_event+ ' - '+records[i].city_event+')</a>'
            }
  
            suggestedFriends.innerHTML = output;

        }else  if(this.readyState === 4 && this.status === 404){
            suggestedFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'ami</p>';
            listerFriends();
            }  
    });
   
    xhr.open("POST", 'api/controllers/suggestFriend');
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function() {
    suggestFriendList();
    });

