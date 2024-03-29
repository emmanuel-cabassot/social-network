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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link href="assets/css/dropzone.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../assets/css/sendPost.css">
    <link rel="stylesheet" href="../assets/css/showPostsMur.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <a class="navbar-brand" href="home.php"><img src="../assets/images/logo.png" alt="logo" class="logo-img-thumb"></a>


            <div class="collapse navbar-collapse" id="navbarColor03">

                <input class="form-control mr-sm-2 w-25" type="text" name="main-search" id="main-search" placeholder="Nom du contact">

                <div id="search-show">
                    <div class="nav nav-pills navbar-light flex-column">
                        <div class="search-result"></div>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto display-5">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php"><i class="bi bi-house mr-3 blue"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-three-dots mr-3 blue"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-camera-video mr-3 blue"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><i class="bi bi-person-circle mr-3 blue"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-5">
        <div class="row d-flex">
            <div class="col-xl-3">
                <section class="alert alert-light">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="groups.php">Groupes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link alert alert-dismissible alert-primary" href="events.php">Evènements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="friends.php">Amis</a>
                        </li>
                    </ul>
                </section>
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Suggestion de groupes
                            <a href="groups.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                        </div>
                        <div id="suggestedGroup"></div>                        
                    </div>
                </section>
            </div>
            <div class="col-xl-6 col-sm-12">
                <section>
                    <div id="oneEvent"></div>    
                </section>
                <br>     

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commentEventModal">
                Ajouter commentaire
                </button>
                <section>
                    <div id="listCommentEvent"></div>    
                </section>
                <br>   

                <!-- Modal -->
                <div class="modal fade" id="commentEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un commentaire</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="comment-form" method="POST">
                                    <fieldset>
                                        <div class="form-group">             
                                            <textarea class="form-control w-75" id="comment" placeholder="Commentaire" rows="" name="text_comment" required></textarea>                    
                                        </div>
                                                                                   
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Commenter" id="submit-comment" class="btn btn-primary w-75" />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer" id="footerModal"> 
                                
                            </div>
                        </div>
                    </div>
                </div>
                        
            </div>            
          
            <div class="col-xl-3 col-sm-12 mt-5">
            <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Suggestion d'amis
                            <a href="friends.php" type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                        </div>
                        <div id="suggestedFriend"></div>                        
                    </div>                    
                </section>
                <section class="alert alert-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active">Amis
                            <a href="friends.php"type="button" class="btn btn-secondary btn-sm float-right">Voir ...</a>
                        </div>
                        <div id="listFriends"></div>                        
                    </div>
                </section>
                                
            </div>            
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
      <script src="../assets/js/search.js"></script>   
    <script src="../assets/js/suggestGroupAside.js"></script>
    <script src="../assets/js/suggestFriendAside.js"></script>
    <script src="../assets/js/listerFriendsAside.js"></script>
    <script src="../assets/js/viewEvent.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
