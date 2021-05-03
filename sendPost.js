
const publier = document.querySelector('button')


publier.addEventListener("click", function(e) {
    var myContent = tinymce.get("TextareaPostSend").getContent();
    if (isset) {
        
    }

    data = {
        texte: myContent,
        photo: photo,
        video: video
    }
    data = JSON.stringify(data);
    console.log(data)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api/controllers/postSend.php");
    xhr.setRequestHeader("Content-Type", "text/plain");
    xhr.send(data);  
})