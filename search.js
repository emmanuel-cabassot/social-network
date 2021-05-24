$(document).on('keyup', 'input#main-search', function(){
    var searchText =$(this).val();
    if(searchText ==''){
        $('.search-result').html('');

    }else{
      searchName(searchText);
    }
})

function searchName(searchText){
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){

            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var output = '';

            for(var i=0; i<records.length; i++)
            output +=  
            '<a href="element.php?id='+records[i].id_user+'"><li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">'+records[i].name +" - "+records[i].lastname+
            "</li></a>";  
         }else{
        output =  
            '<li class="list-group-item d-flex justify-content-between btn-outline-warning mt-2">Pas de résultat</li>';
            }
            setTimeout(function(){ 
                $('.search-result').html(output);
            }, 1000);  
    });
   
    xhr.open("GET", "api/controllers/search?searchText="+searchText);

    xhr.send();
    }




 
    