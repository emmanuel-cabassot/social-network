var suggestFriend = document.getElementById('suggestFriend');

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
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/users/'+records[i].avatar+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name+' '+records[i].lastname+
            '</h5><p>'+records[i].city+' - '+records[i].country+
            '</p><p class="card-text">amis : <b>'+records[i].count+
            '</b></p><a  href="friend.php?id_user='+records[i].id_user+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
            }        
     
            setTimeout(function(){ 
                suggestFriend.innerHTML = outputSF;
            }, 1000);  	
                       
        }else  if(this.readyState === 4 && this.status === 404){
            suggestFriend.innerHTML = '<p class="list-group-item list-group-item-action">Pas de suggestion d\'amis</p>';
            }
    });
    xhr.open("POST", 'api/controllers/suggestFriend');
    xhr.send();
}