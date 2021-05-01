var formL = document.getElementById("formSignIn"); 

document.addEventListener("DOMContentLoaded", function() {
    formL.addEventListener('submit', e => {
        e.preventDefault();
        login();
        });
    });

var serializeForm = function (form) {
    var obj = {};
    var formData = new FormData(form);
    for (var key of formData.keys()) {
        obj[key] = formData.get(key);
    }
    return obj;
};

function login(){
    var login_form = formL;
    var form_data=JSON.stringify(serializeForm(login_form));
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status == 200) {
        window.location="network.php";
        }else{
            setTimeout(function(){$("#resultat").html("<p>Erreur d'email ou de password.</p>")}, 1000); 
        }
    });

    xhr.open("POST", "http://localhost/social-network/api/controllers/login");
    xhr.setRequestHeader("Content-Type", "text/plain");

    xhr.send(form_data);
   }