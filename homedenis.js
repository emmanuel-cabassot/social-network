var suggestedEvent = document.getElementById('suggestedEvent');
var suggestedGroupe = document.getElementById('suggestedGroup');
var suggestedFriend = document.getElementById('suggestedFriend');
var listFriends = document.getElementById('listFriends');


document.addEventListener("DOMContentLoaded", function() {
    suggestEventList();
    suggestFriendList();
    listerFriends();
    suggestGroupList();
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

function suggestGroupList(){
		
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputG = '';

            for(var i =0; i<records.length; i++){				
                
                    outputG +=  
                    '<a href="" class="list-group-item list-group-item-action"><img src="assets/images/upload/groups/'+records[i].img_group+'" class="card-img-thumb" alt="...">'+records[i].name_group+
                    '</a>';
            }
  
            suggestedGroup.innerHTML = outputG;

        }else  if(this.readyState === 4 && this.status === 404){
            suggestedGroup.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion de groupe</p>';
           
            }  
    });
   
    xhr.open("POST", 'api/controllers/suggestGroup');
    xhr.send();
}

function listerFriends(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputLF = '';
            
            
            
        
            for(var i =0; i<records.length; i++){
                    var connect='';				
                    if(records[i].id_connected != null){connect='<i class="bi bi-person-circle mr-1" style="font-size: 2rem; color: green;"></i>'}else{connect='<i class="bi bi-person-circle mr-3"></i>'}
                    if(records[i].confirmed=="oui"){
                        outputLF += 
                        '<a href="#" class="list-group-item list-group-item-action">'+connect+
                        '<img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
                        ' '+records[i].city+ ' - '+records[i].country+'</a>';
                    }else{
                       
                        listFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'amis</p>';;
                    }
            }

             
            listFriends.innerHTML = outputLF;
            	
        

        }else  if(this.readyState === 4 && this.status === 404){
            listFriends.innerHTML = '<pclass="list-group-item list-group-item-action">Pas encore d\'amis?</p>';
            }
        
    });
   
    xhr.open("POST", 'api/controllers/listFriends');

    xhr.send();

}




