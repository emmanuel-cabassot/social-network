var form = document.getElementById("formSignUp");
var passwordCo = document.getElementById('passwordCo');
var emailCo= document.getElementById('emailCo');



function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}


var serializeForm = function (form) {
	var obj = {};
	var formData = new FormData(form);
	for (var key of formData.keys()) {
		obj[key] = formData.get(key);
	}
	return obj;
};

function login(){
    var login_form = form;
    var form_data=JSON.stringify(serializeForm(login_form));
    var xhr = new XMLHttpRequest();
    

    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status == 200) {
        window.location="network.php";
        }else if(this.readyState === 4 && this.status == 404){
            setErrorFor(passwordCo, "Erreur de password");
        }else if(this.readyState === 4 && this.status == 401){
            setErrorFor(emailCo, "Cet email n'existe pas");
        }
    });

    xhr.open("POST", "http://localhost/social-network/api/controllers/login");
    xhr.setRequestHeader("Content-Type", "text/plain");

    xhr.send(form_data);
   }