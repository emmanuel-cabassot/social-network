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
    <link rel="stylesheet" href="assets/css/showPostsMur.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light">
            <a class="navbar-brand" href="#"><img src="assets/images/logo.png" alt="logo" class="logo-img-thumb"></a>


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
                        <a class="nav-link" href="#"><i class="bi bi-person-circle mr-3 blue"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-1">
        <div class="row d-flex">
            <section class="tabs-admin">
                <ul class="list">
                    <li class="tab active" data-target="#user">
                        Membres
                    </li>
                    <li class="tab" data-target="#listPosts">
                        Posts
                    </li>
                    <li class="tab" data-target="#listComments">
                        Commentaires Posts
                    </li>
                </ul>
            </section>
            <div class="col-xl-12 col-sm-12">
                <section class="user content" id="user">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">ID</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Change</th>
                                <th scope="col">Blocked</th>
                                <th scope="col">Until Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="listUsers">
                        </tbody>
                    </table>
                </section>
            </div>
            <section id="listPosts" class="listPosts content hidden col-xl-12 col-sm-12 ">
            </section>

            <section id="listComments" class="listComments content hidden col-xl-12 col-sm-12 ">

            </section>

        </div>
    </main>
    <footer id="footer">
        <div class="col-lg-12">
        </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/admUsers.js"></script>
    <script src="assets/js/admPosts.js"></script>
    <script src="assets/js/admCommentsPosts.js"></script>
    <script src="assets/js/adm.js"></script>



</body>

</html>