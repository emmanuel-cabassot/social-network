var suggestFriend = document.getElementById('suggestFriends');


document.addEventListener("DOMContentLoaded", function() {
    suggestFriendListB();
    });

function suggestFriendListB(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputSF = '';
            for(var i =0; i<records.length; i++){
                    outputSF += 
                    '<div class="col-md-4"><div class="profile-card text-center"><a  href="viewFriend.php?id_friend='+records[i].id_friend+
                    '"><img src="assets/images/upload/users/'+records[i].avatar+
                    '" class="img img-responsive"><div class="profile-content"><h6>'+records[i].name+' '+records[i].lastname+
                    '</h6></a><div class="row d-flex justify-content-around pt-2"><div class="col-xs-4"><div class="profile-overview"><h6>'+records[i].city+' - '+records[i].country+
                    '</h6></div></div><div class="col-xs-4"><div class="profile-overview"><button type="button" onclick="invitFriend('+records[i].id_friend+
                    ')" class="btn btn-primary">Inviter</button><br></div></div></div></div></div></div>';
            
            }        
     
            setTimeout(function(){ 
                suggestFriend.innerHTML = outputSF;
            }, 1000);  	
                       
        }else  if(this.readyState === 4 && this.status === 404){
            suggestFriend.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'amis</p>';
            }
    });
    xhr.open("POST", 'api/controllers/suggestFriend.php');
    xhr.send();
}

function invitFriend(id_friend){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {           
            
            window.location="friends.php";          

        }
    });
   
    xhr.open("GET", 'api/controllers/invitFriend.php?id_friend='+id_friend);

    xhr.send();
}