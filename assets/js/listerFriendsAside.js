var listFriends = document.getElementById('listFriends');

document.addEventListener("DOMContentLoaded", function() {
    listerFriends();
    });

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
                        listFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore d\'amis? </p>';
                    }
            }
            listFriends.innerHTML = outputLF;
        }else  if(this.readyState === 4 && this.status === 404){
            listFriends.innerHTML = '<p class="list-group-item list-group-item-action">Pas encore d\'amis?</p>';
            }
    });
    xhr.open("POST", 'api/controllers/listFriends.php');
    xhr.send();
}

