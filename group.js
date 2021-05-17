var formG = document.getElementById("addGroup"); 

document.addEventListener("DOMContentLoaded", function() {
    formG.addEventListener('submit', e => {
        e.preventDefault();
        addGroup();
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

    function addGroup(){
        var group_form = formG;
        var form_data=JSON.stringify(serializeForm(group_form));
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status == 200) {
                window.location="groups.php";
            }else if(this.readyState === 4 && this.status == 406){
               setTimeout(function(){$("#resultat").html("<p>Veuillez vous connecter</p>")}, 1000); 
            }else{setTimeout(function(){$("#resultat").html("<p>Erreur système, veuillez recommencer</p>")}, 1000);}
        });
    
        xhr.open("POST", "http://localhost/social-network/api/controllers/addGroup");
        xhr.setRequestHeader("Content-Type", "text/plain");
    
        xhr.send(form_data);
       }