let user = document.querySelector('#idUser')
console.log(user)
user = 1

const publier = document.querySelector('button')

publier.addEventListener("click", function(e) {
    var myContent = tinymce.get("TextareaPostSend").getContent();
    console.log(user)
    data = {
        user: user,
        texte: myContent
    }
    data = JSON.stringify(data);
    console.log(data)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/postSend.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.send(data);  
})