
if(records[i].confirmed=='non'){
    outputz +=
'<div class="card w-50 mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/users/'+records[i].avatar+
'" class="card-img-thumb" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name+
' '+records[i].lastname+'</h5><p class="card-text">'+records[i].city+ ' - '+records[i].country+
'</p><button type="button" onclick="confirmFriend('+records[i].id_user_friend+
')" class="btn btn-primary">Confirmer</button></div></div></div></div><br>';
}else{
    outputz +=
    '<div class="card w-50 mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/users/'+records[i].avatar+
'" class="card-img-thumb" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name+
' '+records[i].lastname+'</h5><p class="card-text">'+records[i].city+ ' - '+records[i].country+
'</p><button type="button" onclick="forgetFriend('+records[i].id_user_friend+
    ')" class="btn btn-primary">Oublier</button></div></div></div></div><br>';   
}
