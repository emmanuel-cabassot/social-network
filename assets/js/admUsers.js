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
            outputUs += `
        <tr>
            <td>${user.id_user}</td>
            <td>${user.name}</td>
            <td>${user.lastname}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td><form id="form${user.id_user}">
                <select name="role" id="role${user.id_user}">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </td>
            <td>
                <input id="blocked${user.id_user}" type="text" value="${user.blocked}" name="blocked">
            </td>
            <td>
                <input id="date${user.id_user}" type="date" value="${user.period_block}">
            </td>
            <td>
                <input id="submit${user.id_user}" type="submit" value="Submit">
            </td></form>
        </tr>`
        
        });

        
       
        listUsers.innerHTML = outputUs;

        /* Au click sur le submit on envoie les valeurs des inputs */
        records.forEach(user => {
            submit = document.querySelector("#submit" + user.id_user) 
            submit.addEventListener("click", function (e) {
                role = document.querySelector("#role" + user.id_user)
                role = role.value
                blocked = document.querySelector("#blocked" + user.id_user)
                blocked = blocked.value
                date = document.querySelector("#date" + user.id_user)
                date = date.value

                data = {
                    role: role,
                    blocked: blocked,
                    date: date,
                    user: user.id_user
                }

                let xhrr = new XMLHttpRequest();
                xhrr.open("POST", "api/controllers/modifUser.php");
                xhrr.setRequestHeader("Content-Type", "text/plain");
                xhrr.responseType = "json";
                xhrr.send(JSON.stringify(data));

                xhrr.addEventListener("readystatechange", function() {
                if (xhrr.readyState === 4 && xhrr.status == 200) {
                    window.location.reload()
                }
            })
            }) 
        }); 

       }else if(this.readyState === 4 && this.status === 404){
            listUsers.innerHTML = '<p>Pas d\'inscrits</p>';
        }
    });
    xhr.open("POST", 'api/controllers/admUsers.php');
    xhr.send();
};