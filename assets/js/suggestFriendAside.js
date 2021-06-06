var suggestedFriend = document.getElementById('suggestedFriend');

document.addEventListener("DOMContentLoaded", function() {
    suggestFriendList();
    });

function suggestFriendList(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var outputF = '';
            for(var i =0; i<records.length; i++){
                    outputF +=
                    '<a href="viewFriend.php?id_friend='+records[i].id_friend+'" class="list-group-item list-group-item-action"><img src="assets/images/upload/users/'+records[i].avatar+'" class="card-img-thumb" alt="...">'+records[i].name+' '+records[i].lastname+
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