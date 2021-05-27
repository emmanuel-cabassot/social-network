var suggestedFriends = document.getElementById('suggestedFriends');
var suggest = document.getElementById("suggest");


suggest.addEventListener("click", function(e) {
    e.preventDefault();
    suggestFriend();
});

function suggestFriend(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var output = '';
            
            
        
            for(var i =0; i<records.length; i++){				
                
                    output +=  
                    '<div class="card w-50 mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name+
                    ' '+records[i].lastname+'</h5><p class="card-text">'+records[i].city+ ' - '+records[i].country+
                    '</p><button type="button" onclick="invitFriend('+records[i].id_user_friend+
                    ')" class="btn btn-primary">Inviter</button></div></div></div></div><br>';
            }

            setTimeout(function(){ 
            suggestedFriends.innerHTML = output;
        }, 1000);  	
        

        }
    });
   
    xhr.open("POST", 'api/controllers/suggestFriend');

    xhr.send();
}

function invitFriend(id_user_friend){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {           
            
            setTimeout(function(){ 
            suggestFriend();
        }, 1000);  	        

        }
    });
   
    xhr.open("GET", 'api/controllers/invitFriend?id_user_friend='+id_user_friend);

    xhr.send();
}