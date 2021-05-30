let user = document.querySelector('#idUser')
user = 1

data = {
    user: user
}

let xhr = new XMLHttpRequest();
xhr.open("POST", "api/controllers/postShow.php");
xhr.setRequestHeader("Content-Type", "text/plain");
xhr.responseType = "json";
xhr.send(JSON.stringify(data));
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
        let idPost = JSON.stringify(xhr.response)
        listIdPost = JSON.parse(idPost)

        listIdPost.forEach(id_post => {
            data = {
                id_post: id_post.id_post
            }

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "api/controllers/postShow.php");
            xhr.setRequestHeader("Content-Type", "text/plain");
            xhr.responseType = "json";
            xhr.send(JSON.stringify(data));
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 || xhr.status == 201) {
                    let post = JSON.stringify(xhr.response)
                    posts = JSON.parse(post)
                    console.log(posts)
                }
            }
        });

    }

}





