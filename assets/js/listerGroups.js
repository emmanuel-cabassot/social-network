var listGroups = document.getElementById('listGroups');

document.addEventListener("DOMContentLoaded", function() {
    listerGroups();
    });

 function listerGroups(){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4 && this.status === 200) {

        var response = JSON.parse(xhr.responseText);
        var records = response.records;
        var outputG = '';

        for(var i =0; i<records.length; i++){

            outputG +=
            
            '<div class="card"><div class="row d-flex justify-content-between"><div class="col-sm-4"><img class="d-block img-min" src="assets/images/upload/groups/'+records[i].img_group+
            '" alt="..."></div><div class="col-sm-4 mt-3"><h4 class="card-title">'+records[i].name_group+
            '</h4><p class="card-text">participants : <span class="badge-primary rounded-pill">'+records[i].count+
            '</span></p></div><div class="col-sm-4 mt-4"><a href="groupe.php?id_group='+records[i].id_group+
            '" class="btn btn-primary">Voir</a></div></div></div>';

        }

        listGroups.innerHTML = outputG;


    }else if(this.readyState === 4 && this.status === 404){
            listGroups.innerHTML = '<p>Pas de participation à un groupe</p>';
        }
    });
    xhr.open("POST", 'api/controllers/listGroups');
    xhr.send();
};
