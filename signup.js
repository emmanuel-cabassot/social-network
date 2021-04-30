var formI = document.getElementById("formSignUp"); 

document.addEventListener("DOMContentLoaded", function() {
    formI.addEventListener('submit', e => {
        e.preventDefault();
        signUp();
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

function signUp(){
    var signUp_form = formI;
    var form_data=JSON.stringify(serializeForm(signUp_form));
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status == 200) {
        window.location="index.php";
        }else{
           $("#resultat").html("<p>Erreur système, veuillez recommencer.</p>"); 
        }
    });

    xhr.open("POST", "http://localhost/social-network/api/controllers/signUp");
    xhr.setRequestHeader("Content-Type", "text/plain");

    xhr.send(form_data);
   }