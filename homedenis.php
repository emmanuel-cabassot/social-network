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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/dropzone.min.js" ></script>
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
            <div class="col-xl-3">
                <section class="alert alert-primary">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="groups.php">Groupes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="events.php">Evènements</a>
                        </li>
                    </ul>
                </section>
                <section class="alert alert-info">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion Évènements</div>
                    <div id="suggestedEvent"></div>
                    <div class="list-group-item list-group-item-action"><button type="button" class="btn btn-info btn-sm float-right">Voir ...</button></div>
                </div>
                
                </section>
            </div>
            <div class="col-xl-6 col-sm-12"></div>


            <div class="col-xl-3 col-sm-12">
                <section class=" alert-primary mb-5">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion d'amis</div>
                    <div id="suggestedFriend"></div>
                    <div class="list-group-item list-group-item-action">
                        <button type="button" class="btn btn-primary btn-sm float-right">Voir ...</button>
                    </div>
                </div>
                </section>
                <section class="alert alert-info mb-5">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Amis</div>
                    <div id="listFriends"></div>
                    <div class="list-group-item list-group-item-action">
                        <button type="button" class="btn btn-primary btn-sm float-right">Voir ...</button>
                    </div>
                </div>
                </section>
                <section class="alert alert-primary mb-5">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action active">Suggestion de groupes</div>
                    <div id="suggestedGroup"></div>
                    <div class="list-group-item list-group-item-action">
                        <button type="button" class="btn btn-primary btn-sm float-right">Voir ...</button>
                    </div>
                </div>
               
                </section>
            </div>
        </div>
    </main>
    <footer id="footer">
          <div class="col-lg-12">
          </div>
      </footer>
    <script src="assets/js/bootstrap.bundle.min.js"></script>  
    <script src="search.js"></script>
    <script src="homedenis.js"></script>


    
</body>
</html>
