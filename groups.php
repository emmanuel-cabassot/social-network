<?php
session_start();
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
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/sendPost.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#"><img src="assets/images/logo.png" alt="logo" class="logo-img-thumb"></a>


            <div class="collapse navbar-collapse" id="navbarColor01">

                <input class="form-control mr-sm-2 w-25" type="text" name="main-search" id="main-search" placeholder="Nom du contact">

                <div id="search-show">
                    <div class="nav nav-pills navbar-light flex-column">
                        <div class="search-result"></div>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto display-5">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="bi bi-house mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-three-dots mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-camera-video mr-3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person-circle mr-3"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-5">
        <div class="row d-flex">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 col-sm-12">


                <section>
                    <div id="suggestGroupe"></div>    
                </section>
                <br>      
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
                                <form id="dropzone-form"  enctype="multipart/form-data" method="POST">
                                    <fieldset>
                                        <div class="form-group">               
                                            <input type="text" id="name_group" class="form-control w-75" placeholder="Nom" name="name_group" required />                
                                        </div>
                                        <div class="form-group">             
                                            <textarea class="form-control w-75" id="description" placeholder="Description" rows="" name="description" required></textarea>                    
                                        </div>
                                        <div class="form-group">
                                            <div class="dropzone" id="dropzone"></div>  
                                        </div>                                                   
                                        <div class="form-group">
                                            <input type="submit" name="submitDropzone" value="Ajouter" id="submit-dropzone" class="btn btn-primary w-75" />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer" id="footer"> 
                                
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div id="listGroups"></div>    
                </section>    
                      
            </div>            
          
            <div class="col-xl-3 col-sm-12 mt-5">                
            </div>            
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="groups.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>