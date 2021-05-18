function addImgName(){
    var input = document.createElement("input");

    input.setAttribute("type", "hidden");

    input.setAttribute("name", "img_group");

    input.setAttribute("value", name);

    //append to form element that you want .
    document.getElementById("addGroup").appendChild(input);
}

$("#dropzone").dropzone({
    addRemoveLinks: true,
    uploadMultiple: false,
    maxFilesize:1, //MB
    acceptedFiles: ".png, .jpeg, .jpg, .gif",
    removedfile: function(file) {
    var name = file.name; 
 
    $.ajax({
        type: 'POST',
        url: 'upload.php',
        data: {name: name,request: 2},
        sucess: function(data){
            console.log('success: ' + data);
            addImgName();
        }
    });
    var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
    });

    
 

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