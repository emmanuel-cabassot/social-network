<?php
session_start();

if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
    // Ici, l'utilisateur est connecté
    ?>
    <p>Bonjour <?= $_SESSION['name'] ?> <a class="btn btn-danger" href="index.php">Déconnexion</a></p>
<?php
}else{
    // Ici l'utilisateur n'est pas connecté
    ?>
    <a class="btn btn-primary mr-2" href="index.php">Connexion</a> <a class="btn btn-primary" href="sign_up.php">Inscription</a>
<?php
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

<body class="bg-light min-vh-100">
    <main class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-xl-3"></div>
            <div class="col-xl-6 col-sm-12">
                <div class="toast show">
                    <div class="toast-header">
                        <strong class="me-auto">$_SESSION['name']</strong>
                        <small>$_SESSION['date']</small>
                    </div>
                    <div class="toast-body" id="discussion">
                        
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" id="texte" placeholder="Entrez votre texte">
                    <div class="input-group-append">
                        <span class="input-group-text" id="valid"><i class="la la-check"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3"></div>             
        </div>   
    </main>
    <footer id="footer">
          <div class="col-lg-12"> 
          </div>
      </footer>
    <script src="chat.js"></script>   
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
</body>
</html>


