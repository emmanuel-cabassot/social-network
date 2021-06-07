
var viewFriend = document.getElementById('viewFriend');
var id_friend = $_GET('id_friend');
var id_friend = id_friend.trim();


document.addEventListener("DOMContentLoaded", function() {
    view_friend(id_friend);
      
});

 


function $_GET(param) {
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function( m, key, value ) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );
    if ( param ) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}

function view_friend(id_friend){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){
            var record = JSON.parse(xhr.responseText);
            var outputFR = '';
            var relation= '';
                    if(record.follow==null){
                        relation='<button type="button" onclick="invitFriend('+record.id_friend+
                    ')" class="btn btn-primary">Inviter</button>';
                    }else if(record.confirmed=='non' && record.id_follower == record.id_friend){relation = '<button type="button" onclick="confirmFriend('+record.id_follow+
                    ')" class="btn btn-primary">Confirmer</button>';}
                    else{relation='<button type="button" onclick="forgetFriend('+record.id_follow+
                    ')" class="btn btn-primary">Oublier</button>';}

                        outputFR +=
                    '<div class="card w-50 mb-3"><div class="row no-gutters"><div class="col-md-4"><a  href="viewFriend.php?id_friend='+record.id_friend+
                    '"><img src="assets/images/upload/users/'+record.avatar+
                    '" class="card-img-thumb" alt="..."></a></div><div class="col-md-8"><div class="card-body"><a  href="viewFriend.php?id_friend='+record.id_friend+
                    '"><h5 class="card-title">'+record.name+
                    ' '+record.lastname+'</h5></a><p class="card-text">'+record.city+ ' - '+record.country+
                    '</p>'+relation+'</div></div></div></div><br>';

            viewFriend.innerHTML = outputFR;
        }else  if(this.readyState === 4 && this.status === 404){
            outputFR.innerHTML = '<p>Pas  d\'ami</p>';
            }       
    });
    xhr.open("POST", 'api/controllers/viewFriend?id_friend='+id_friend);
    xhr.send();
}

function invitFriend(id_friend){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {           
            
            window.location="friends.php";          

        }
    });
   
    xhr.open("GET", 'api/controllers/invitFriend?id_friend='+id_friend);

    xhr.send();
}

function confirmFriend(id_follow){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {           
            
           
           window.location="friends.php";     

        }
    });
   
    xhr.open("GET", 'api/controllers/confirmFriend?id_follow='+id_follow);

    xhr.send();
}

function forgetFriend(id_follow){
		
    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200) {             
            window.location="friends.php";         
        }
    });
    xhr.open("POST", 'api/controllers/forgetFriend?id_follow='+id_follow);
    xhr.send();
}
           





