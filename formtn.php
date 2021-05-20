<?php if(isset($_POST["submitDropzone"])){
    print_r($_POST);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Plateforme_ Network</title>
	<meta name="description" content="Reseau Social pour La Plateforme_." />
	<meta name="keywords" content="stories, posts, social network, followers, réseau social, La Plateforme_, plateformeurs" />
	<meta name="author" content="Denis Farkas Emmanuel Cabassot Thuc-nhi Wiedenhofer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js" ></script>
</head>
<body>
    <main class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 col-sm-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#groupModal">
                Add group
                </button>

                <!-- Modal -->
                <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un groupe</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <form id="dropzone-form" action="./tnUpload.php" method="POST" enctype= "multipart/form-data">
                                <fieldset>
                                    <div class="form-group">               
                                        <input type="text" class="form-control w-75" placeholder="Nom" name="name_group" required>                
                                    </div>
                                    <div class="form-group">             
                                        <textarea class="form-control w-75" placeholder="Description" rows="" name="description" required></textarea>                    
                                    </div>                                                        
                                                                      
                                    <div id="dropzone" class="dropzone"></div>
                                </fieldset>                         
                            
                        </div>
                        <div class="modal-footer">
                            <input id="submit-dropzone" type="submit" class="btn btn-primary w-25" name="submitDropzone" value="Ajouter">
                            </form> 
                        </div>
                        </div>
                    </div>
                </div>             
            </div>            
          
            <div class="col-xl-3 col-sm-12 mt-5">                
            </div>            
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="tnDropzone.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>

