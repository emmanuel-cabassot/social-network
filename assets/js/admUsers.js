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


        records.forEach(user => {
            outputUs +=  
            '<tr><td>'+user.id_user+
            '</td><td>'+user.name+
            '</td><td>'+user.lastname+
            '</td><td>'+user.email+
            '</td><td><form id="form'+user.id_user+'"><input id="blocked'+user.id_user+'" type="text" value="'+user.blocked+'" name="blocked"></td><td><input id="date'+user.id_user+'" type="date" value="'+user.period_block+
            '"></td><td><input id="submit'+user.id_user+'" type="submit" value="Submit"></td></form></tr>';                     
        });
        
       
        listUsers.innerHTML = outputUs;

        /* Au click sur le submit on envoie les valeurs des inputs */
        records.forEach(user => {
            submit = document.querySelector("#submit" + user.id_user) 
            submit.addEventListener("click", function (e) {
                blocked = document.querySelector("#blocked" + user.id_user)
                blocked = blocked.value
                date = document.querySelector("#date" + user.id_user)
                date = date.value

                data = {
                    blocked: blocked,
                    date: date,
                    user: user.id_user
                }

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "api/controllers/modifUser.php");
                xhr.setRequestHeader("Content-Type", "text/plain");
                xhr.responseType = "json";
                xhr.send(JSON.stringify(data));

                if (xhr.readyState === 4 || xhr.status == 200) {
                    window.location="crudAdm.php";
                }

            }) 
        }); 

       }else if(this.readyState === 4 && this.status === 404){
            listUsers.innerHTML = '<p>Pas d\'inscrits</p>';
        }
    });
    xhr.open("POST", 'api/controllers/admUsers.php');
    xhr.send();
};