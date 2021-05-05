const modButton =document.getElementById("modButton");

modButton.addEventListener("click", modifyProfil);

function modifyProfil(){

    var xhr = new XMLHttpRequest();
    
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status == 200) {
            
        }
    });

}