$(document).on('keyup', 'input#main-search', function(){
    var searchText =$(this).val();
    var onlyLetters =/[a-zA-Z\-_ ’'‘ÆÐƎƏƐƔĲŊŒẞÞǷȜæðǝəɛɣĳŋœĸſßþƿȝĄƁÇĐƊĘĦĮƘŁØƠŞȘŢȚŦŲƯY̨Ƴąɓçđɗęħįƙłøơşșţțŧųưy̨ƴÁÀÂÄǍĂĀÃÅǺĄÆǼǢƁĆĊĈČÇĎḌĐƊÐÉÈĖÊËĚĔĒĘẸƎƏƐĠĜǦĞĢƔáàâäǎăāãåǻąæǽǣɓćċĉčçďḍđɗðéèėêëěĕēęẹǝəɛġĝǧğģɣĤḤĦIÍÌİÎÏǏĬĪĨĮỊĲĴĶƘĹĻŁĽĿʼNŃN̈ŇÑŅŊÓÒÔÖǑŎŌÕŐỌØǾƠŒĥḥħıíìiîïǐĭīĩįịĳĵķƙĸĺļłľŀŉńn̈ňñņŋóòôöǒŏōõőọøǿơœŔŘŖŚŜŠŞȘṢẞŤŢṬŦÞÚÙÛÜǓŬŪŨŰŮŲỤƯẂẀŴẄǷÝỲŶŸȲỸƳŹŻŽẒŕřŗſśŝšşșṣßťţṭŧþúùûüǔŭūũűůųụưẃẁŵẅƿýỳŷÿȳỹƴźżžẓ]$/.test(searchText);
    if(onlyLetters ==false || searchText===' '){
        $('.search-result').html('');
    }else if(onlyLetters==true){
      searchName(searchText);
    };
})

function searchName(searchText){
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4 && this.status === 200){

            var response = JSON.parse(xhr.responseText);
            var records = response.records;
            var output = '';

            for(var i=0; i<records.length; i++)
            output +=  
            '<li class="nav-item bg-light"><a class="nav-link" href="viewFriend.php?id_friend='+records[i].id_user+'">'+records[i].name +" - "+records[i].lastname+
            '</a></li>';  
         }else{
        output =  
            '<li class="nav-item active"><a href="" class="nav-link">Pas de résultat</a></li>';
            }
            setTimeout(function(){ 
                $('.search-result').html(output);
            }, 1000);  
    });
   
    xhr.open("GET", "api/controllers/search.php?searchText="+searchText);

    xhr.send();
    }




 
    