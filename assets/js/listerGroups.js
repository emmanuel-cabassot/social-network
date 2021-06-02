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
            '<div class="card mb-3"><div class="row no-gutters"><div class="col-md-4"><img src="assets/images/upload/groups/'+records[i].img_group+
            '" class="card-img" alt="..."></div><div class="col-md-8"><div class="card-body"><h5 class="card-title">'+records[i].name_group+
            '</h5><p class="card-text">participants : <b>'+records[i].count+
            '</b></p><a  href="groupe.php?id_group='+records[i].id_group+
            '"><button type="button" class="btn btn-primary">Voir</button></a></div></div></div></div><br>';
        }

        listGroups.innerHTML = outputG;


    }else if(this.readyState === 4 && this.status === 404){
            listGroups.innerHTML = '<p>Pas de participation à un groupe</p>';
        }
    });
    xhr.open("POST", 'api/controllers/listGroups');
    xhr.send();
};
