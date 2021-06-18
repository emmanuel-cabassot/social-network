const tabs = document.querySelectorAll(".tabs-admin .tab");
const contents = document.querySelectorAll(".content");
let active = document.querySelector(".active")
let target = active.dataset.target

affiche()

function affiche(){
    tabs.forEach(tab => {
        if (tab !== active) {
            tab.addEventListener("click", function (e) {
                suppActive = document.querySelector(".tabs-admin .active")
                suppActive.classList.remove("active")
                contents.forEach(content => {
                    content.classList.add("hidden")
                });
                this.classList.add("active") 
                target = this.dataset.target
                console.log(target)
                document.querySelector(target).classList.remove("hidden");
            })
        }
    });    
}

