var listUsers = document.getElementById('listUsers');

document.addEventListener("DOMContentLoaded", function() {
    listerUsers();
    });

function listerUsers(){
  var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {

        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputUs = '';

        for(var i =0; i<records.length; i++){
            var formId='form'+records[i].id_user;

            outputUs +=  
            '<tr><td>'+records[i].id_user+
            '</td><td>'+records[i].name+
            '</td><td>'+records[i].lastname+
            '</td><td>'+records[i].email+
            '</td><td><form id="'+formId+'"><input type="text" value="'+records[i].blocked+'" name="blocked"></td><td><input type="date" value="'+records[i].period_block+
            '"></td><td><input type="submit" value="Submit"></td></form></tr>';              
                                
        }

        listUsers.innerHTML = outputUs;

       

       }else if(this.readyState === 4 && this.status === 404){
            listUsers.innerHTML = '<p>Pas d\'inscrits</p>';
        }
    });
    xhr.open("POST", 'api/controllers/admUsers.php');
    xhr.send();
};



function modifUser(id_user){
   
    var form_data=JSON.stringify(serializeForm(formId));
        
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener("readystatechange", function() {
            if(this.readyState === 4 && this.status == 200) {
                window.location="crudAdm.php";
            }
        });

        xhr.open("POST", "api/controllers/modifUser.php?id_user="+id_user);
        xhr.setRequestHeader("Content-Type", "text/plain");

        xhr.send(form_data);   
    
};


var serializeForm = function (form) {
    var obj = {};
    var formData = new FormData(form);
    for (var key of formData.keys()) {
        obj[key] = formData.get(key);
    }
    return obj;
};

