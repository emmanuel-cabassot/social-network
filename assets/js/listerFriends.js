var listFriends = document.getElementById('listFriends');

function listerFriends(){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {
            
            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var relation= '';
            var outputz = '';

            for(var i =0; i<records.length; i++){				
                    
                    if(records[i].confirmed=='non'){relation = '<button type="button" onclick="confirmFriend('+records[i].id_friend+
                    ')" class="btn btn-primary">Confirmer</button>';}else{relation='<button type="button" onclick="forgetFriend('+records[i].id_friend+
                    ')" class="btn btn-primary">Oublier</button>';}

                        outputz +=
                    '<div class="card w-50 mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/users/'+records[i].avatar+
                    '" class="card-img-thumb" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name+
                    ' '+records[i].lastname+'</h5><p class="card-text">'+records[i].city+ ' - '+records[i].country+
                    '</p>'+relation+'</div></div></div></div><br>';
                
                    }
            
            listFriends.innerHTML = outputz;
        }else  if(this.readyState === 4 && this.status === 404){
            listFriends.innerHTML = '<p>Pas  d\'ami</p>';
            }       
    });
    xhr.open("POST", 'api/controllers/listFriends');
    xhr.send();
}
